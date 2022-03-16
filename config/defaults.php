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
        'rashers' => [
            'name' => 'rashers',
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
        'nuts',
        'confectionary',
        'beverages',
        'supplements',
        'dairy',
        'meat',
        'fish',
        'grains',
        'sweeteners',
        'plant based',
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
            'name' => 'cumberland sausage',
            'type' => 'meat',
            'unit' => 'g',
        ],
        [
            'name' => 'meat free sausages',
            'type' => 'plant based',
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
        [
            'name' => 'plain flour',
            'type' => 'baking',
            'unit' => 'g',
            'allergens' => ['gluten'],
        ],
        [
            'name' => 'plain flour (gluten free)',
            'type' => 'baking',
            'unit' => 'g',
        ],
        [
            'name' => 'celery',
            'type' => 'vegetable',
            'unit' => 'stick',
            'allergens' => ['celery'],
        ],
        [
            'name' => 'king prawn',
            'type' => 'fish',
            'unit' => 'g',
            'allergens' => ['crustaceans'],
        ],
        [
            'name' => 'egg',
            'type' => 'protein',
            'unit' => 'item',
            'allergens' => ['eggs'],
        ],
        [
            'name' => 'mackerel',
            'type' => 'fish',
            'unit' => 'item',
            'allergens' => ['fish'],
        ],
        [
            'name' => 'lamb mince',
            'type' => 'meat',
            'unit' => 'g',
            'allergens' => ['meat'],
        ],
        [
            'name' => 'lupin flour',
            'type' => 'baking',
            'unit' => 'g',
            'allergens' => ['lupin'],
        ],
        [
            'name' => 'greek yoghurt',
            'type' => 'dairy',
            'unit' => 'g',
            'allergens' => ['milk'],
        ],
        [
            'name' => 'mussel',
            'type' => 'fish',
            'unit' => 'g',
            'allergens' => ['molluscs'],
        ],
        [
            'name' => 'dijon mustard',
            'type' => 'condiments',
            'unit' => 'tsp',
            'allergens' => ['mustard'],
        ],
        [
            'name' => 'dry roasted peanuts',
            'type' => 'nuts',
            'unit' => 'g',
            'allergens' => ['peanuts'],
        ],
        [
            'name' => 'tahini',
            'type' => 'condiments',
            'unit' => 'tsp',
            'allergens' => ['sesame'],
        ],
        [
            'name' => 'extra firm tofu',
            'type' => 'protein',
            'unit' => 'g',
            'allergens' => ['soybeans'],
        ],
        [
            'name' => 'extra firm tofu',
            'type' => 'protein',
            'unit' => 'g',
            'allergens' => ['soybeans'],
        ],
        [
            'name' => 'banana',
            'type' => 'fruit',
            'unit' => 'item',
            'allergens' => ['sulfur dioxide and sulphites'],
        ],
        [
            'name' => 'cashew',
            'type' => 'nuts',
            'unit' => 'g',
            'allergens' => ['tree nuts'],
        ],
    ],
    'allergens' => [
        'celery',
        'gluten', // (such as barley and oats)
        'crustaceans' => [
            'is_animal_product' => true,
        ], // (such as prawns, crabs and lobsters)
        'eggs' => [
            'is_animal_product' => true,
        ],
        'fish' => [
            'is_animal_product' => true,
        ],
        'meat' => [
            'is_animal_product' => true,
        ],
        'lupin',
        'milk' => [
            'is_animal_product' => true,
        ],
        'molluscs' => [
            'is_animal_product' => true,
        ], // (such as mussels and oysters)
        'mustard',
        'peanuts',
        'sesame',
        'soybeans',
        'sulphur dioxide and sulphites', // (at a concentration of more than ten parts per million)
        'tree nuts', // (such as almonds, hazelnuts, walnuts, brazil nuts, cashews, pecans, pistachios and macadamia nuts)
    ],
];
