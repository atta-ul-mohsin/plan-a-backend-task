<?php

declare(strict_types=1);

namespace App\TemplateGenerator;

interface TemplateGeneratorInterface
{
    public function generate(array $params): string;
}
