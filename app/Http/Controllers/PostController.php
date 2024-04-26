<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use WP_Query;

class PostController extends Controller
{
    public function getPosts():array
    {
        $args = [
            'posts_per_page' => -1,
            'post_type' => 'post',
        ];
        $query = new WP_Query($args);
        return $query->posts;
    }
}
