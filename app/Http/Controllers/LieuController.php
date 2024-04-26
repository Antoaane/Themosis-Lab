<?php

namespace App\Http\Controllers;

use WP_Query;

class LieuController extends Controller
{
    public function getAllLocations() : array
    {
        $post = $this->getPosts();
        // dd($this->filterAdresse($post));
        return $this->filterAdresse($post);
    }

    private function getPosts()
    {
        $args = array(
            'posts_per_page' => -1,
            'post_type' => 'lieu',
        );
        $wp_query = new WP_Query($args);
        $posts = $wp_query->posts;
        return $posts;
    }

    private function filterAdresse(array $post) : array
    {
        $filteredLocations = [];

        foreach ($post as $location){
            $filteredLocations[] = [
                'title' => $location->post_title ??"",
                'thumbnail' => get_the_post_thumbnail_url($location->ID, 'full')??"",
                //'image' => wp_get_attachment_image_src(get_post_meta($location->ID, 'th_achievement_image', true),'full')[0]??"",
                'adresse' => get_post_meta($location->ID, 'lieu_adresse', true)??"",
                'description' => get_post_meta($location->ID, 'lieu_desc', true)??"",
                'editor' => get_post_meta($location->ID, 'lieu_editor', true)??"",
            ];
        }

        
        return $filteredLocations;
    }
}
