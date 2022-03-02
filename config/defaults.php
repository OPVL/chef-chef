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
        's' => [
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
        'spice',
        'sauce',
        'produce',
        'non-perishable',
        'frozen',
        'unspecified',
        'protein',
    ],
    'ingredients' => [
        [
            'name' => 'cumin',
            'type' => 'spice',
            'unit' => 'tsp',
        ],
        [
            'name' => 'salt',
            'type' => 'spice',
            'unit' => 'tsp',
        ],
        [
            'name' => 'black pepper',
            'type' => 'spice',
            'unit' => 'tsp',
        ],
        [
            'name' => 'tinned tomatoes',
            'type' => 'non-perishable',
            'unit' => 'can',
        ],
        [
            'name' => 'lettuce',
            'type' => 'produce',
            'unit' => 'item',
        ],
        [
            'name' => 'lemon',
            'type' => 'produce',
            'unit' => 'item',
        ],
        [
            'name' => 'sausage',
            'type' => 'protein',
            'unit' => 'g',
        ],
        [
            'name' => 'petit pois',
            'type' => 'frozen',
            'unit' => 'g',
        ],
        [
            'name' => 'kidney beans',
            'type' => 'non-perishable',
            'unit' => 'can',
        ],
        [
            'name' => 'brown onion',
            'type' => 'produce',
            'unit' => 'item',
        ],
    ],
];
