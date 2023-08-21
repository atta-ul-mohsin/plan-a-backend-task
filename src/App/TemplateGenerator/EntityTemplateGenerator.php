<?php

declare(strict_types=1);

namespace App\TemplateGenerator;

use App\Utils\StringUtil;

/**
 * Class EntityTemplateGenerator.
 *
 * This class is responsible for generating template from the data provided.
 */
class EntityTemplateGenerator implements TemplateGeneratorInterface
{
    /**
     * Generate an entity template.
     *
     * @throws \InvalidArgumentException if required data is missing
     */
    public function generate(array $data): string
    {
        try {
            // Check if required data exists in the input array
            if (!isset($data['scope'], $data['name'])) {
                throw new \InvalidArgumentException('Required data is missing.');
            }

            $scope = $data['scope'];
            $name = $data['name'];

            $className = StringUtil::convertToValidName($name);
            $namespace = 'App\\Models\\'.StringUtil::convertToValidName($scope[0]).'\\'.StringUtil::convertToValidName($scope[1]);
            $tableName = strtolower($name);

            // Generate the class template
            $template = "<?php\n";
            $template .= "namespace $namespace;\n\n";
            $template .= "use Illuminate\\Database\\Eloquent\\Model;\n\n";
            $template .= "class $className extends Model\n";
            $template .= "{\n";
            $template .= "    protected const TABLE_NAME = '$tableName';\n";
            $template .= "    public function getTableName(): string\n";
            $template .= "    {\n";
            $template .= "        return self::TABLE_NAME;\n";
            $template .= "    }\n";
            $template .= "}\n";

            return $template;
        } catch (\Throwable $e) {
            // Handle the exception, you can log it, rethrow it, or take other appropriate actions.
            // In this example, we'll rethrow it.
            throw $e;
        }
    }
}
