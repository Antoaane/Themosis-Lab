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

    public function filterMembre(array $post) : array
    {
        $filteredMembres = [];

        foreach ($post as $membre){
            $filteredMembres[] = [
                'title' => $membre->post_title ??"",
                'photo' => wp_get_attachment_image_src(get_post_meta($membre->ID, 'membre_photo', true),'full')[0]??"",
                'nom' => get_post_meta($membre->ID, 'membre_nom', true)??"",
                'prenom' => get_post_meta($membre->ID, 'membre_prenom', true)??"",
                'poste' => get_post_meta($membre->ID, 'membre_poste', true)??"",
                'expertises' => $this->getExpertiseRelations($membre->ID),
            ];
        }

        
        return $filteredMembres;
    }

    private function getPosts()
    {
        $args = array(
            'posts_per_page' => -1,
            'post_type' => 'membre',
        );
        $wp_query = new WP_Query($args);
        $posts = $wp_query->posts;
        // dd($posts);
        return $posts;
    }

    private function getExpertiseRelations(int $id)
    {
        $args = array(
            'relationship' => [
                'id' => 'membre-to-expertise',
                'from' => $id,
            ],
            'nopaging'     => true,
        );
        $wp_query = new WP_Query($args);
        $relation = $wp_query;

        dd($relation);
    
        $expertises[] = [
            'id' => $relation->ID,
            'title' => $relation->post_title,
        ];
    }
}
