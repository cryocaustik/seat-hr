<?php

return [
    [
        'name' => 'Applications',
        'permission' => 'character.sheet',
        'highlight_view' => 'applications',
        'route' => 'seat-hr.profile.applications',
    ],
    [
        'name' => 'Blacklist',
        'permission' => 'seat-hr.officer',
        'highlight_view' => 'blacklist',
        'route' => 'seat-hr.profile.blacklist',
    ],
    [
        'name' => 'Intel',
        'permission' => 'seat-hr.officer',
        'highlight_view' => 'intel',
        'route' => 'seat-hr.profile.intel',
    ],
    [
        'name' => 'Kick History',
        'permission' => 'seat-hr.officer',
        'highlight_view' => 'kickhistory',
        'route' => 'seat-hr.profile.kickhistory',
    ],
    [
        'name' => 'Notes',
        'permission' => 'seat-hr.officer',
        'highlight_view' => 'note',
        'route' => 'seat-hr.profile.note',
    ],
    [
        'name' => 'Sheet',
        'permission' => 'character.sheet',
        'highlight_view' => 'sheet',
        'route' => 'seat-hr.profile.sheet',
    ],
    [
        'name'           => 'SeAT Profile',
        'permission'     => 'character.sheet',
        'highlight_view' => 'SeAT Profile',
        'route'          => 'character.view.sheet',
    ],
];
