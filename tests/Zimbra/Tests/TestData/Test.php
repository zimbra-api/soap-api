<?php

namespace Zimbra\Tests\TestData;

use Zimbra\Soap\Request;

/**
 * Test class.
 */
class Test extends Request
{
    private $foo;
    private $bar;

    public function __construct($foo, $bar)
    {
        parent::__construct();
        $this->child('foo', trim($foo));
        $this->child('bar', trim($bar));
    }

    public function foo($foo = NULL)
    {
        if(NULL === $foo)
        {
            return $this->child('foo');
        }
        return $this->child('foo', trim($foo));
    }

    public function bar($bar = NULL)
    {
        if(NULL === $bar)
        {
            return $this->child('bar');
        }
        return $this->child('bar', trim($bar));
    }
}