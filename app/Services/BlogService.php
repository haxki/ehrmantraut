<?php
    namespace App\Services;

use App\Models\BlogPost;
use Illuminate\Support\Facades\Storage;

    class BlogService {
        public static function create(array $newPost) {
            if (isset($newPost['image'])) {
                $filename = $newPost['image']->hashName();
                Storage::putFileAs('/public/img/blog', $newPost['image'], $filename);
                $newPost['image'] = $filename;
            } else {
                $newPost['image'] = NULL;
            }
            BlogPost::create($newPost);
        }
        public static function update(array $updateData, $id) {
            $currentData = BlogPost::find($id);
            $somethingNew = false;

            if (isset($updateData['delete_image'])) {
                Storage::delete('/public/img/blog/' . $currentData['image']);
                $updateData['image'] = NULL;
                unset($updateData['delete_image']);
                $somethingNew = true;
            } else if (isset($updateData['image'])) {
                Storage::delete('/public/img/blog/' . $currentData['image']);
                $imagename = $updateData['image']->hashName();
                Storage::putFileAs('/public/img/blog', $updateData['image'], $imagename);
                $updateData['image'] = $imagename;
                $somethingNew = true;
            }

            if ($currentData['title'] === $updateData['title']) {
                unset($updateData['title']);
            } else $somethingNew = true;

            if ($currentData['content'] === $updateData['content']) {
                unset($updateData['content']);
            } else $somethingNew = true;

            if ($somethingNew) 
                BlogPost::find($id)->update($updateData);
        }
        public static function delete($id) {
            $model = BlogPost::find($id);
            Storage::delete('/public/img/blog/' . $model['image']);
            $model->delete();
        }
    }