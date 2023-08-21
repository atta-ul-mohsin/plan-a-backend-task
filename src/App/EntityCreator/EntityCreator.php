<?php

declare(strict_types=1);

namespace App\EntityCreator;

use App\Filesystem\FilesystemInterface;
use App\TemplateGenerator\TemplateGeneratorInterface;
use App\Utils\StringUtil;

/**
 * Class EntityCreator.
 *
 * This class is responsible for creating entity files based on provided parameters.
 */
class EntityCreator
{
    /**
     * @var TemplateGeneratorInterface the template generator
     */
    private $templateGenerator;

    /**
     * @var FilesystemInterface the filesystem handler
     */
    private $filesystem;

    /**
     * EntityCreator constructor.
     *
     * @param TemplateGeneratorInterface $templateGenerator the template generator
     * @param FilesystemInterface        $filesystem        the filesystem handler
     */
    public function __construct(TemplateGeneratorInterface $templateGenerator, FilesystemInterface $filesystem)
    {
        $this->templateGenerator = $templateGenerator;
        $this->filesystem = $filesystem;
    }

    /**
     * Create an entity file.
     */
    public function createEntity(array $params): void
    {
        $template = $this->templateGenerator->generate($params);
        $scope = array_map([StringUtil::class, 'convertToValidName'], $params['scope']);
        $directory = 'Models/'.implode('/', $scope);
        $name = StringUtil::convertToValidName($params['name']);
        $filePath = "$directory/$name.php";

        try {
            $this->filesystem->createDirectory($directory);
            $this->filesystem->writeFile($filePath, $template);
        } catch (\Throwable $e) {
            throw new \RuntimeException('Failed to create entity: '.$e->getMessage(), $e->getCode(), $e);
        }
    }
}
