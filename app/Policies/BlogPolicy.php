<?php

namespace App\Policies;

use App\Models\BlogPost;
use App\Models\User;

class BlogPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user != null;
    }

    public function file_upload(User $user) {
        return $user->role == "admin";
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, BlogPost $blog): bool
    {
        return $user->login == $blog->author || $user->role == "admin";
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function destroy(User $user, BlogPost $blog): bool
    {
        return $user->login == $blog->author || $user->role == "admin";
    }
}
