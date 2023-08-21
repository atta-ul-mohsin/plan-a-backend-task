<?php

declare(strict_types=1);

require_once 'vendor/autoload.php'; // Include Composer's autoloader

use App\EntityCreator\EntityCreator;
use App\Filesystem\LocalFilesystem;
use App\TemplateGenerator\EntityTemplateGenerator;

$params = [
    'scope' => [
        'indirect-emissions-owned',
        'electricity',
    ],
    'name' => 'meeting-rooms',
];

// Create instances of the required classes
$filesystem = new LocalFilesystem();
$templateGenerator = new EntityTemplateGenerator();
$entityCreator = new EntityCreator($templateGenerator, $filesystem);

// Call the createEntity method to generate the entity
$entityCreator->createEntity($params);

echo "Entity created successfully!\n";
