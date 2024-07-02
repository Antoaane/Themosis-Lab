<?php

namespace App\Hooks\Metaboxes;

use Themosis\Support\Facades\Field;
use Themosis\Support\Facades\Metabox;

class Home extends \Themosis\Hook\Hookable
{
    public function register():void
    {
        Metabox::make('home-content', 'page')
            ->add(Field::text('title_home',['label'=>'Titre']))
            

            ->setPriority('high')
            ->setTemplate('home')
            ->setTitle('Contenu de la page')
            ->addTranslation('done', 'Sauvegarde réussie')
            ->addTranslation('error', 'Une erreur s\'est produite pendant la sauvegarde')
            ->addTranslation('saving', 'Sauvegarde en cours')
            ->addTranslation('submit', 'Sauvegarder')
            ->set();
    }
}