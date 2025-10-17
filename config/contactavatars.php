<?php

return [
    'image_type' => 'jpg',
    'sizes' => [
        'small' => ['width' => '300', 'height' => '300'],
        'medium' => ['width' => '600', 'height' => '600'],
        'large' => ['width' => '900', 'height' => '900'],
        'xlarge' => ['width' => '1200', 'height' => '1200'],
    ],
    'jpeg_compression' => 80,
    'original_path' => 'images/contacts/originals',
    'variant_pattern' => 'images/contacts/variants/%sx%s'
];
