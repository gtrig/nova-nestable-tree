<?php

return [
    'sortable_resources' => [
        'category' => [
            'model' => 'App\\Models\\Category',
            'resource' => 'App\\Http\\Resources\\SortableCategoryResource',
            'collection' => 'App\\Http\\Resources\\SortableCategoryCollection',
            'link' => 'category',
            'label' => 'Categories',
        ],
        // Add more resources as needed
    ]
];