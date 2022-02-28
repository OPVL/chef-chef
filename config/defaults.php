<?php

return [
    'cuisines' => [
        'English',
        'Thai',
        'South East Asian',
        'American',
        'Indian',
        'Italian',
        'French',
        'Mexican',
        'Spanish',
        'Turkish',
        'Middle Eastern',
        'African',
    ],
    'units' => [
        'item' => 's',
        'lb' => 'pound',
        'l' => 'litre',
        'ml' => 'millilitre',
        'g' => 'gram',
        'kg' => 'kilogram',
        'can' => 'can',
        'tsp' => 'teaspoon',
        'tbsp' => 'tablespoon',
        'unspecified' => 'unspecified',
    ],
    'storagelocations' => [
        'spices',
        'cupboard',
        'fridge',
        'freezer',
        'unspecified',
    ],
    'ingredients' => [
        [
            'name' => 'cumin',
            'location' => 'spices',
            'unit' => 'tsp',
        ],
        [
            'name' => 'tinned tomatoes',
            'location' => 'cupboard',
            'unit' => 'can',
        ],
        [
            'name' => 'lettuce',
            'location' => 'fridge',
            'unit' => 'item',
        ],
        [
            'name' => 'lemon',
            'location' => 'fridge',
            'unit' => 'item',
        ],
        [
            'name' => 'sausage',
            'location' => 'fridge',
            'unit' => 'g',
        ],
        [
            'name' => 'petit pois',
            'location' => 'freezer',
            'unit' => 'g',
        ],
        [
            'name' => 'kidney beans',
            'location' => 'cupboard',
            'unit' => 'can',
        ],
    ],
];
