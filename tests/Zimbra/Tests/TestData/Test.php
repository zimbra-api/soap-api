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
        $this->_foo = $foo;
        $this->_bar = $bar;
    }

    public function foo($foo = NULL)
    {
        if(NULL === $foo)
        {
            return $this->_foo;
        }
        $this->_foo = trim($foo);
        return $this;
    }

    public function bar($bar = NULL)
    {
        if(NULL === $bar)
        {
            return $this->_bar;
        }
        $this->_bar = trim($bar);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = array(
            'foo' => $this->_foo,
            'bar' => $this->_bar,
        );
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        if(!empty($this->_foo))
        {
            $this->xml->addChild('foo', $this->_foo);
        }
        if(!empty($this->_foo))
        {
            $this->xml->addChild('bar', $this->_bar);
        }
        return parent::toXml();
    }
}