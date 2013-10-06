<?php

namespace Zimbra\Tests\TestData;

/**
 * Test class.
 */
class TestRequestServer
{
    /**
     * Test request
     *
     * @param  string $foo
     * @param  string $bar
     * @return Zimbra\Tests\TestData\TestResponse
     */
    public function testRequest($foo, $bar)
    {
        return new TestResponse($foo, $bar);
    }
}
