<?php

declare(strict_types=1);

use App\TemplateGenerator\EntityTemplateGenerator;
use PHPUnit\Framework\TestCase;

/**
 * Test class for EntityTemplateGenerator.
 *
 * @internal
 */
class EntityTemplateGeneratorTest extends TestCase
{
    /**
     * Test generating a template with valid data.
     *
     * This test ensures that the generate method produces the expected template
     * when provided with valid input data.
     */
    public function testGenerateTemplateWithValidData(): void
    {
        // Input parameters representing valid data
        $params = [
            'scope' => [
                'indirect-emissions-owned',
                'electricity',
            ],
            'name' => 'meeting-rooms',
        ];

        // Instantiate the EntityTemplateGenerator
        $generator = new EntityTemplateGenerator();

        // Generate the template
        $template = $generator->generate($params);

        // Expected parts of the generated template
        $expectedNamespace = 'namespace App\\Models\\IndirectEmissionsOwned\\Electricity;';
        $expectedClassName = 'class MeetingRooms';
        $expectedTableName = "const TABLE_NAME = 'meeting-rooms';";

        // Assertions to check if the expected parts are present in the template
        $this->assertStringContainsString($expectedNamespace, $template);
        $this->assertStringContainsString($expectedClassName, $template);
        $this->assertStringContainsString($expectedTableName, $template);
    }

    /**
     * Test generating a template with missing data.
     *
     * This test checks if the generate method throws an InvalidArgumentException
     * when required data is missing from the input parameters.
     */
    public function testGenerateTemplateWithMissingData(): void
    {
        // Input parameters with missing 'scope' and 'name'
        $params = [
            // 'scope' and 'name' are missing intentionally
        ];

        // Instantiate the EntityTemplateGenerator
        $generator = new EntityTemplateGenerator();

        // Expect an InvalidArgumentException to be thrown
        $this->expectException(\InvalidArgumentException::class);

        // Generate the template (should throw an exception)
        $generator->generate($params);
    }
}
