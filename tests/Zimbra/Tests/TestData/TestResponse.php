<?php

namespace Zimbra\Tests\TestData;

/**
 * Test class.
 */
class TestResponse
{
    /**
     * foo
     *
     * @var string
     */
    public $foo;

    /**
     * bar
     *
     * @var string
     */
    public $bar;

    /**
     * TestResponse constructor
     *
     * @param  string $foo
     * @param  string $bar
     * @return TestResponse
     */
    public function __construct($foo, $bar)
    {
        $this->foo = $foo;
        $this->bar = $bar;
    }
}
