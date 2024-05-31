<?php

namespace Tests\Unit;

class SampleObjectFactory
{
    public static function create(array $attributes = [])
    {
        return [
            'name' => $attributes['name'] ?? 'Sample Object ' . rand(1, 10),
            'value' => $attributes['value'] ?? rand(100, 1000),
        ];
    }
}
