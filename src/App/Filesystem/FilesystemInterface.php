<?php

declare(strict_types=1);

namespace App\Filesystem;

interface FilesystemInterface
{
    public function writeFile(string $filePath, string $content): void;

    public function createDirectory(string $directoryPath): void;
}
