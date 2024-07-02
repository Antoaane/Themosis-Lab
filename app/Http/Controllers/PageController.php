<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use WP_Query;


class PageController extends Controller
{
    public array $pageContent;
    private string $imgSize;

    public function __construct(string $imgSize = 'full')
    {
        $this->imgSize = $imgSize;
        $this->pageContent['global'] = $this->getGlobalInfo('infos-globales');
    }
    

// --------------------------------- PUBLIC FUNCTIONS --------------------------------- //

    public function render(string $template, string $slug , string $post_type, array $linked_posts = [], $imgSize = 'full') : View
    {
        $this->imgSize = $imgSize;

        $content = $this->getPost(
            new WP_Query([
                'name' => $slug,
                'post_type' =>  $post_type,
                'posts_per_page' => -1,
            ])
        );

        $linked_posts_content = [];

        if ($linked_posts) {
            foreach($linked_posts as $linked_post_type){
                $linked_posts_content[$linked_post_type] = $this->getPosts($linked_post_type);
            }
        }

        $pageContent = $this->pageContent + $content + $linked_posts_content;

        foreach($pageContent as $key => $item){
            if(is_serialized($item)){
                $pageContent[$key] = unserialize($item);
            }
        }

        $this->pageContent = $pageContent;

        return view('pages.' . $template, $this->pageContent);
    }

    public function getGlobalInfo($settings_page_id)
    {
        $settings_fields = rwmb_get_object_fields($settings_page_id, 'setting');

        $fields = [];

        foreach ($settings_fields as $field_slug) {
            $fields[$field_slug['id']] = rwmb_meta($field_slug['id'], ['object_type' => 'setting'], $settings_page_id);
        }

        return $fields;
    }

    public function getPosts(string $post_type) : array
    {
        $query = new WP_Query([
            'post_type' => $post_type,
            'posts_per_page' => -1,
        ]);

        $posts = $query->posts;
        $formatedPosts = [];

        foreach ($posts as $post) {
            $formatedPosts[] = $this->getPost($post);
        }

        $posts = $formatedPosts;

        return $posts;
    }

    private function getPost(object $post) : array
    {
        if ($post->posts) {
            $post = get_object_vars(get_object_vars($post)['posts'][0]);
        } else {
            $post = get_object_vars($post);
        }

        $post_content = $this->getContent($post);
        
        $relations = $this->getRelations($post);
        $post_content = $post_content + $relations;

        return $post_content;
    }

    private function getContent(array $post)
    {
        $id = $post['ID'] ?? get_the_ID();
        $meta = get_post_meta($id);

        foreach ($meta as $key => $values) {
            foreach ($values as $value) {
                if (is_numeric($value) && wp_attachment_is_image($value) && strpos($key, 'img')) {
                    if ($img_src = wp_get_attachment_image_src($value, $this->imgSize)) {
                        $post[$key] = $img_src[0];
                    }
                } else {
                    $post[$key] = $value;
                }
            }
        }

        return $post;
    }

    private function getRelations(array $post) : array
    {
        $relations = $post;
        $taxonomies = get_object_taxonomies($post['post_type']);

        if ($taxonomies && $post){
            foreach($taxonomies as $taxonomy){

                $sub_posts = $this->getRelatedPosts($post['ID'], $taxonomy) ?? [];
                
                if ($sub_posts) {
                    foreach ($sub_posts as $key => $sub_post) {
                        $sub_relations = $this->getRelations($sub_post) ?? [];
                        
                        if ($sub_relations) {
                            $relations[str_replace('-', '_', $taxonomy)][] = $sub_relations;
                        } else {
                            $relations[str_replace('-', '_', $taxonomy)][] = $sub_post;
                        }
                    }
                }
            }
        } else {
            $relations = [];
        }

        return $relations;
    }

    private function getRelatedPosts(string $postId, string $relation) : array
    {
        $postTerms = wp_get_post_terms($postId, $relation);

        $relatedPosts = [];

        foreach($postTerms as $term){
            $relatedPosts[] = $this->getSinglePost($relation, $term->slug);
        }

        return $relatedPosts;
    }

    private function getSinglePost(string $postType, string $slug): array
    {
        $query = new WP_Query([
            'name' => $slug,
            'post_type' => $postType,
        ]);

        $post = get_object_vars($query->post);
        $post = $this->getContent($post);

        $postTerms = wp_get_post_terms($post['ID'], $postType) ?? [];

        $thumbnail_url = get_the_post_thumbnail_url($post['ID']) ?? '';

        $post = $post + [
            'terms' => $postTerms,
            'thumbnail_url' => $thumbnail_url
        ];

        return $post;
    }
}
