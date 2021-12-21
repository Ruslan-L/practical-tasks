<?php

use PHPUnit\Framework\TestCase;
use App\Models\Fibonacci;

class FibonacciTest extends TestCase
{
    private Fibonacci $fibonacci;

    protected function setUp(): void
    {
        $this->fibonacci = new Fibonacci();
    }

    public function testFibonacci(): void
    {
        $this->assertEquals(
            '1344719667586153181419716641724567886890850696275767987106294472017884974410332069524504824747437757',
            $this->fibonacci->get()
        );
    }
}