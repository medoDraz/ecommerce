<?php

return [

    'roles_structure' => [
        'super_admin' => [
            'admins' => 'c,r,u,d,a',
            'languages' => 'c,r,u,d,a',
            'vendors' => 'c,r,u,d,a',
            'main_categories' => 'c,r,u,d,a',

        ],
        'admin' => [
        ],

    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
        'a' => 'active'
    ]
];
