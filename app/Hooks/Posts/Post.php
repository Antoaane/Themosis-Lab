<?php

namespace App\Hooks\Posts;

use Themosis\Support\Facades\Field;
use Themosis\Support\Facades\Metabox;
use Themosis\Support\Facades\PostType;
use Themosis\Support\Facades\Taxonomy;

class Post extends \Themosis\Hook\Hookable
{
    public function register(): void
    {
        Metabox::make('article_content', 'post')
        ->add(Field::choice('post_cover', [
            'label' => 'Taille de la couverture',
            'choices' => [
                'Couvrir (l\'image est redimensionnée pour couvrir toute la zone)' => 'cover',
                'Contenir (l\'image est entièrement visible)' => 'contain'
            ],
            'data' => 'contain'
        ]))
        ->add(Field::choice('post_color', [
            'label' => 'Couleur',
            'choices' => [
                'Jaune' => 'yellow',
                'Bleu' => 'blue',
                'Blanc' => 'white'
            ],
            'data' => 'yellow'
        ]))
        ->setPriority('high')
        ->setTemplate('posts')
        ->setTitle('Contenu de la page')
        ->addTranslation('done', 'Sauvegarde réussie')
        ->addTranslation('error', 'Une erreur s\'est produite pendant la sauvegarde')
        ->addTranslation('saving', 'Sauvegarde en cours')
        ->addTranslation('submit', 'Sauvegarder')
        ->set();
    }
}