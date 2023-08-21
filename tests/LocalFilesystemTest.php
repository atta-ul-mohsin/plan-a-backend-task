<?php

declare(strict_types=1);

use App\Filesystem\LocalFilesystem;
use PHPUnit\Framework\TestCase;

/**
 * Test class for LocalFilesystem.
 *
 * @internal
 */
class LocalFilesystemTest extends TestCase
{
    /**
     * Test writing content to a file.
     */
    public function testWriteFile(): void
    {
        $filesystem = new LocalFilesystem();

        $filePath = __DIR__.'/testfile.txt';
        $content = 'This is a test content.';

        // Write content to a file
        $filesystem->writeFile($filePath, $content);

        // Check if the file exists and contains the expected content
        $this->assertTrue(file_exists($filePath));
        $this->assertEquals($content, file_get_contents($filePath));

        // Clean up: delete the test file
        unlink($filePath);
    }

    /**
     * Test creating a directory.
     */
    public function testCreateDirectory(): void
    {
        $filesystem = new LocalFilesystem();

        $directoryPath = __DIR__.'/testdir';

        // Create a directory
        $filesystem->createDirectory($directoryPath);

        // Check if the directory exists
        $this->assertTrue(is_dir($directoryPath));

        // Clean up: remove the test directory
        rmdir($directoryPath);
    }

    /**
     * Test creating a directory that already exists.
     */
    public function testCreateExistingDirectory(): void
    {
        $filesystem = new LocalFilesystem();

        $directoryPath = __DIR__.'/testdir';

        // Create the directory
        mkdir($directoryPath);

        // Attempt to create the directory again (should not throw an exception)
        $filesystem->createDirectory($directoryPath);

        // Assert that the directory still exists
        $this->assertDirectoryExists($directoryPath);

        // Assert that it is indeed a directory
        $this->assertDirectoryIsReadable($directoryPath);

        // Clean up: remove the test directory
        rmdir($directoryPath);
    }

    /**
     * Test creating a directory with insufficient permissions.
     */
    public function testCreateDirectoryWithPermissionsError(): void
    {
        $filesystem = new LocalFilesystem();

        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            // On Windows, use a system directory or a directory with restricted access
            $restrictedPath = 'C:\\Windows\\some%}{dir';
        } else {
            // On Unix-like systems, use a system directory or a directory with restricted access
            $restrictedPath = '/usr/some%}{dir';
        }

        // Expect a \RuntimeException to be thrown when creating the directory
        $this->expectException(\RuntimeException::class);

        // Try to create the directory using the LocalFilesystem's createDirectory method
        $filesystem->createDirectory($restrictedPath);
    }
}
