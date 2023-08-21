<?php

declare(strict_types=1);
use App\EntityCreator\EntityCreator;
use App\Filesystem\FilesystemInterface;
use App\TemplateGenerator\TemplateGeneratorInterface;
use PHPUnit\Framework\TestCase;

/**
 * Test class for EntityCreator.
 *
 * @internal
 */
class EntityCreatorTest extends TestCase
{
    public function testCreateEntityWithValidParams(): void
    {
        // Create a mock for TemplateGeneratorInterface
        $templateGenerator = $this->createMock(TemplateGeneratorInterface::class);
        // Configure the mock to return the provided template
        $template = '<?php 
namespace {namespace}; 
use Illuminate\Database\Eloquent\Model; 
class {class_name} extends Model 
{ 
  const TABLE_NAME = {table_name}; 
  public function getTableName(): string 
  { 
      return self::TABLE_NAME; 
  } 
}';
        $templateGenerator->method('generate')->willReturn($template);

        // Create a mock for FilesystemInterface
        $filesystem = $this->createMock(FilesystemInterface::class);
        // Expect createDirectory and writeFile to be called with the correct paths
        $expectedDirectory = 'Models/IndirectEmissionsOwned/Electricity';
        $expectedFilePath = 'Models/IndirectEmissionsOwned/Electricity/MeetingRooms.php';
        $filesystem->expects($this->once())->method('createDirectory')->with($expectedDirectory);
        $filesystem->expects($this->once())->method('writeFile')->with($expectedFilePath, $template);

        // Create an instance of EntityCreator with the mock objects
        $entityCreator = new EntityCreator($templateGenerator, $filesystem);

        // Define valid parameters
        $params = [
            'scope' => [
                'indirect-emissions-owned', // Use hyphen-minus here
                'electricity',
            ],
            'name' => 'meeting-rooms',
        ];

        // Call the createEntity method
        $entityCreator->createEntity($params);
    }

    /**
     * Test creating an entity with template generation failure.
     */
    public function testCreateEntityWithTemplateGenerationFailure(): void
    {
        // Mocks for the template generator and filesystem
        $templateGenerator = $this->createMock(TemplateGeneratorInterface::class);
        $filesystem = $this->createMock(FilesystemInterface::class);

        // Example parameters
        $params = [
            'scope' => ['InvalidScope'],
            'name' => 'InvalidName',
        ];

        // Set up a mock exception for template generation
        $templateGenerator->expects($this->once())
            ->method('generate')
            ->with($params)
            ->willThrowException(new \RuntimeException('Failed to create entity: Template generation failed'));

        // Create the EntityCreator instance
        $entityCreator = new EntityCreator($templateGenerator, $filesystem);

        // Expect a \RuntimeException to be thrown with the specified message
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Failed to create entity: Template generation failed');

        // Attempt to create the entity (should throw an exception)
        $entityCreator->createEntity($params);
    }
}
