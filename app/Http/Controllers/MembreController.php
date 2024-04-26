<?php

namespace App\Http\Controllers;

use WP_Query;

class MembreController extends Controller
{
    public function getAllMembres() : array
    {
        $post = $this->getPosts();
        dd($this->filterMembre($post));
        return $this->filterMembre($post);
    }

    private function getPosts()
    {
        $args = array(
            'posts_per_page' => -1,
            'post_type' => 'membre',
        );
        $wp_query = new WP_Query($args);
        $posts = $wp_query->posts;
        return $posts;
    }

    private function filterMembre(array $post) : array
    {
        $filteredMembres = [];

        foreach ($post as $membre){
            $filteredMembres[] = [
                'title' => $membre->post_title ??"",
                'photo' => wp_get_attachment_image_src(get_post_meta($membre->ID, 'membre_photo', true),'full')[0]??"",
                'nom' => get_post_meta($membre->ID, 'membre_nom', true)??"",
                'prenom' => get_post_meta($membre->ID, 'membre_prenom', true)??"",
                'poste' => get_post_meta($membre->ID, 'membre_poste', true)??"",
            ];
        }

        
        return $filteredMembres;
    }
}
