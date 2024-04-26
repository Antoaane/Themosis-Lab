<?php

namespace App\Hooks\CustomPosts;

use Themosis\Support\Facades\Field;
use Themosis\Support\Facades\Metabox;
use Themosis\Support\Facades\PostType;

// class Domaine extends \Themosis\Hook\Hookable
// {
//     public function register(): void
//     {
//         PostType::make('domaine', 'Domaines', 'Domaine')
//             ->setArguments([
//                 'label'=>'Domaine',
//                 'public'=> false,
//                 'exclude_from_search'=>true,
//                 'show_ui'=>true,
//                 'show_in_menu'=> true,
//                 'menu_position'=>25,
//                 'menu_icon'=> 'dashicons-book-alt',
//                 'has_archive'=>false,
//                 'labels'       	=> [
//                     'name' => __('Domaines', APP_TD),
//                     'singular_name' => __('Domaine', APP_TD),
//                     'add_new' => __('Ajouter un domaine', APP_TD),
//                     'add_new_item' => __('Ajouter un domaine', APP_TD),
//                     'new_item' => __('Nouveau', APP_TD),
//                     'edit_item' => __('Editer', APP_TD),
//                     'view_item' => __('Voir', APP_TD),
//                     'all_items' => __('Tous les domaines', APP_TD)
//                 ],
//                 'supports' => ['title','thumbnail'],
//             ])
//             ->set();

//         Metabox::make('domaine_cp', 'domaine')
//             ->add(Field::media('domaine_image', ['label' => 'Image', 'type'=> 'image']))
//             ->add(Field::text('domaine_job', ['label' => 'Nom du domaine d\'expertise']))
//             ->add(Field::text('domaine_desc', ['label' => 'Description']))
//             ->setTitle('Informations')
//             ->addTranslation('done', 'Sauvegarde réussie')
//             ->addTranslation('error', 'Une erreur s\'est produite pendant la sauvegarde')
//             ->addTranslation('saving', 'Sauvegarde en cours')
//             ->addTranslation('submit', 'Sauvegarder')
//             ->set();
//     }
// }