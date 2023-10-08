<?php

declare(strict_types=1);

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * This is a good place to put logic commonly used through tests.
 */
abstract class TestBase extends WebTestCase
{
    protected function setPropertyValue($instance, string $property, $value): mixed
    {
        $reflection = new \ReflectionClass($instance);
        $property = $reflection->getProperty($property);
        $property->setAccessible(true);
        $property->setValue($instance, $value);

        return $instance;
    }

    protected function getPropertyValue($instance, string $property): mixed
    {
        $reflection = new \ReflectionClass($instance);
        $property = $reflection->getProperty($property);
        $property->setAccessible(true);

        return $property->getValue($instance);
    }
}
