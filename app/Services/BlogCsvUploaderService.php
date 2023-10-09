<?php
namespace App\Services;

use App\Services\FileDatabaseService;
use Illuminate\Support\Facades\Storage;
use PDO;

class BlogCsvUploaderService extends FileDatabaseService {
    public function __construct($csv) {
        $this->columnOrder = ['title', 'content', 'author', 'created_at'];
        $this->filename = 'blog.csv';
        Storage::putFileAs('public', $csv, $this->filename);
    }

    public function file_upload() {
        $posts = $this->extractAll();
        $pdo = new PDO("mysql:dbname=labdb;host=127.0.0.1", 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        $statement = $pdo->prepare('INSERT INTO `blog_posts`(`image`, `author`, `title`, `content`, `created_at`, `updated_at`)
            VALUES(NULL, :author, :title, :content, :created_at, :updated_at)');
        foreach ($posts as $post) {
            $statement->bindParam(':author', $post['author']);
            $statement->bindParam(':title', $post['title']);
            $statement->bindParam(':content', $post['content']);
            $statement->bindParam(':created_at', $post['created_at']);
            $statement->bindParam(':updated_at', $post['created_at']);
            $statement->execute();
        }
        $pdo = null;
        Storage::delete('/public/'.$this->filename);
    }
}