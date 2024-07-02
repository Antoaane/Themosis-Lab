<?php

add_filter('rwmb_meta_boxes', 'membre_meta_boxes');

function membre_meta_boxes($meta_boxes) {

    $meta_boxes[] = [
        'title'      => esc_html__('Contenu', 'textdomain'),
        'id'         => 'membre_contenu',
        'post_types' => ['page'],
        'include'    => [
            'template' => 'ratatest',
        ],
        'context'    => 'normal',
        'priority'   => 'high',
        'tab_style'  => 'left',
        'tabs'       => [
            'banner_tab'       => [
                'label' => esc_html__('Bannière', 'textdomain'),
                'icon'  => 'dashicons-format-image',
            ],
            'card_tab'      => [
                'label' => esc_html__('Fiche', 'textdomain'),
                'icon'  => 'dashicons-id',
            ],
            'features_tab'      => [
                'label' => esc_html__('Caractéristiques', 'textdomain'),
                'icon'  => 'dashicons-admin-generic',
            ]
        ],

        'fields'     => [
            [
                'name' => esc_html__('Titre', 'textdomain'),
                'id'   => 'banner_title',
                'tab'  => 'banner_tab',
                'type' => 'wysiwyg',
            ],
            [
                'name' => esc_html__('Image', 'textdomain'),
                'id'   => 'banner_img',
                'tab'  => 'banner_tab',
                'type' => 'single_image',
            ],
            [
                'name' => esc_html__('Infinite', 'textdomain'),
                'id'   => 'infinite',
                'tab'  => 'card_tab',
                'type' => 'group',
                'clone' => true,
                'collapsible' => true,
                'fields' => [
                    [
                        'name' => esc_html__('Titre', 'textdomain'),
                        'id'   => 'card_title',
                        'type' => 'text',
                    ],
                    [
                        'name' => esc_html__('Description', 'textdomain'),
                        'id'   => 'card_desc',
                        'type' => 'textarea',
                    ],
                    [
                        'name' => esc_html__('Image', 'textdomain'),
                        'id'   => 'card_img',
                        'type' => 'single_image',
                    ],
                ]
            ]
        ]
    ];

    return $meta_boxes;
}