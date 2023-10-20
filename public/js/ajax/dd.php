<?php
namespace App\Http\Controllers;

use App\Models\BlogPost;

echo "<script>alert('im here')</script>";

$post_id = $_REQUEST['post_id'];


$model = BlogPost::get($post_id);

echo "<img id='image' src='{$model->image}' alt='post image'>";
