<?php

declare(strict_types=1);

namespace App\Filesystem;

/**
 * Class LocalFilesystem.
 *
 * This class is responsible for writing file to the filesystem with provided content.
 */
class LocalFilesystem implements FilesystemInterface
{
    /**
     * Write content to a file.
     *
     * @param string $filePath the path to the file
     * @param string $content  the content to write to the file
     *
     * @throws \RuntimeException if the file cannot be written
     */
    public function writeFile(string $filePath, string $content): void
    {
        // Try to write the content to the file.
        // Throw a \RuntimeException if writing fails.
        if (file_put_contents($filePath, $content) === false) {
            throw new \RuntimeException("Unable to write to the file: $filePath");
        }
    }

    /**
     * Create a directory if it doesn't exist.
     *
     * @param string $directoryPath the path to the directory to create
     *
     * @throws \RuntimeException if the directory cannot be created
     */
    public function createDirectory(string $directoryPath): void
    {
        // Check if the directory already exists.
        if (!is_dir($directoryPath)) {
            // Attempt to create the directory recursively with full permissions.
            if (!@mkdir($directoryPath, 0777, true)) {
                throw new \RuntimeException("Unable to create the directory: $directoryPath");
            }
        }
    }
}
