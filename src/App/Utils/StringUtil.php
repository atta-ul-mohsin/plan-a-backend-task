<?php

declare(strict_types=1);

namespace App\Utils;

class StringUtil
{
    /**
     * Convert strings to valid class names and namespaces.
     */
    public static function convertToValidName(string $string): string
    {
        $words = array_map('ucfirst', explode('-', $string));

        return implode('', $words);
    }
}
