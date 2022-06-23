<?php

return [
    'seat-hr' => [
        'name' => 'Human Resources',
        'icon' => 'fas fa-handshake',
        'route_segment' => 'seat-hr',
        'entries' => [
            [
                'name' => 'Profile',
                'icon' => 'fas fa-id-badge',
                'route' => 'seat-hr.profile',
            ],
            [
                'name' => 'Review',
                'icon' => 'fab fa-black-tie',
                'route' => 'seat-hr.review.index',
                'permission' => [
                    'seat-hr.admin',
                    'seat-hr.officer',
                ],
            ],
            [
                'name' => 'setup',
                'label' => 'Setup',
                'icon' => 'fas fa-cog',
                'plural' => true,
                'route' => 'seat-hr.config.corp.view',
                'permission' => 'seat-hr.admin',
                'entries' => [
                    [
                        'name' => 'Corporation',
                        'icon' => 'fas fa-building',
                        'permission' => 'superuser',
                        'route' => 'seat-hr.config.corp.view'
                    ],
                    [
                        'name' => 'Questions',
                        'icon' => 'fas fa-cog',
                        'route' => 'seat-hr.config.question.view'
                    ],
                ]
            ],
            [
                'name' => 'About',
                'icon' => 'fas fa-info',
                'route' => 'seat-hr.about'
            ],
        ],
    ],
];
