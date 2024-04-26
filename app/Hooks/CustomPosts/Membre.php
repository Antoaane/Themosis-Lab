<?php

namespace App\Hooks\CustomPosts;

use Themosis\Support\Facades\Field;
use Themosis\Support\Facades\Metabox;
use Themosis\Support\Facades\PostType;

// class Membre extends \Themosis\Hook\Hookable
// {
//     public function register(): void
//     {
//         PostType::make('membre', 'Membres', 'Membre')
//             ->setArguments([
//                 'label'=>'Membre',
//                 'public'=> false,
//                 'exclude_from_search'=>true,
//                 'show_ui'=>true,
//                 'show_in_menu'=> true,
//                 'menu_position'=>25,
//                 'menu_icon'=> 'dashicons-admin-users',
//                 'has_archive'=>false,
//                 'labels'       	=> [
//                     'name' => __('Membres', APP_TD),
//                     'singular_name' => __('Membre', APP_TD),
//                     'add_new' => __('Ajouter un membre', APP_TD),
//                     'add_new_item' => __('Ajouter un membre', APP_TD),
//                     'new_item' => __('Nouveau', APP_TD),
//                     'edit_item' => __('Editer', APP_TD),
//                     'view_item' => __('Voir', APP_TD),
//                     'all_items' => __('Tous les membres', APP_TD)
//                 ],
//                 'supports' => ['title','thumbnail'],
//             ])
//             ->set();

//         Metabox::make('membre_cp', 'membre')
//             ->add(Field::media('membre_image', ['label' => 'Image', 'type'=> 'image']))
//             ->add(Field::text('membre_job', ['label' => 'Poste']))
//             ->add(Field::text('membre_desc', ['label' => 'Description']))
//             ->setTitle('Informations')
//             ->addTranslation('done', 'Sauvegarde réussie')
//             ->addTranslation('error', 'Une erreur s\'est produite pendant la sauvegarde')
//             ->addTranslation('saving', 'Sauvegarde en cours')
//             ->addTranslation('submit', 'Sauvegarder')
//             ->set();
//     }
// }