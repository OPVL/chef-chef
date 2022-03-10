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
        'item' => [
            'name' => 'item',
            'measurable' => false,
        ],
        'oz' => 'ounce',
        'lb' => 'pound',
        'l' => 'litre',
        'ml' => 'millilitre',
        'g' => 'gram',
        'kg' => 'kilogram',
        'can' => [
            'name' => 'can',
            'should_space' => true,
        ],
        'cup' => [
            'name' => 'cup',
            'should_space' => true,
        ],
        'tsp' => [
            'name' => 'teaspoon',
            'should_space' => true,
        ],
        'tbsp' => [
            'name' => 'tablespoon',
            'should_space' => true,
        ],
        'unspecified' => [
            'name' => 'unspecified',
            'measurable' => false,
        ],
    ],
    'types' => [
        'herbs & spices',
        'condiments',
        'vegetables',
        'non-perishables',
        'frozen',
        'unspecified',
        'protein',
        'fruits',
        'confectionary',
        'beverages',
        'supplements',
        'dairy',
        'meat',
        'fish',
        'grains',
        'sweeteners',
    ],
    'ingredients' => [
        [
            'name' => 'cumin',
            'type' => 'herbs & spices',
            'unit' => 'tsp',
        ],
        [
            'name' => 'salt',
            'type' => 'herbs & spices',
            'unit' => 'tsp',
        ],
        [
            'name' => 'black pepper',
            'type' => 'herbs & spices',
            'unit' => 'tsp',
        ],
        [
            'name' => 'tinned tomatoes',
            'type' => 'non-perishables',
            'unit' => 'can',
        ],
        [
            'name' => 'lettuce',
            'type' => 'vegetables',
            'unit' => 'item',
        ],
        [
            'name' => 'lemon',
            'type' => 'fruits',
            'unit' => 'item',
        ],
        [
            'name' => 'sausage',
            'type' => 'protein',
            'unit' => 'g',
        ],
        [
            'name' => 'petit pois peas',
            'type' => 'frozen',
            'unit' => 'g',
        ],
        [
            'name' => 'kidney beans',
            'type' => 'non-perishables',
            'unit' => 'can',
        ],
        [
            'name' => 'brown onion',
            'type' => 'vegetables',
            'unit' => 'item',
        ],
    ],
];
