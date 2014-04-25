<?php

namespace Zimbra\Tests\Soap;

use Zimbra\Tests\ZimbraTestCase;
use Zimbra\Soap\Request;
use Zimbra\Soap\Request\Attr;

/**
 * Testcase class for soap client.
 */
class RequestTest extends ZimbraTestCase
{
    public function testRequest()
    {
        $stub = $this->getMockForAbstractClass('\Zimbra\Soap\Request');
        $this->assertStringEndsWith('Request', $stub->requestName());
        $this->assertStringEndsWith('Response', $stub->responseName());
        $this->assertEquals(array($stub->requestName() => array()), $stub->toArray());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<'.$stub->requestName().' />';
        $this->assertXmlStringEqualsXmlString($xml, $stub->toXml()->asXml());
    }

    public function testRequestAttr()
    {
        $stub = $this->getMockForAbstractClass('\Zimbra\Soap\Request\Attr');

        $attr1 = new \Zimbra\Struct\KeyValuePair('key1', 'value1');
        $attr2 = new \Zimbra\Struct\KeyValuePair('key2', 'value2');
        $attr3 = new \Zimbra\Struct\KeyValuePair('key3', 'value3');
        $stub->addAttr($attr1)->attr()->addAll(array($attr2, $attr3));
        $this->assertEquals(array($attr1, $attr2, $attr3), $stub->attr()->all());

        $stub->expects($this->any())
             ->method('toArray');
        $arr = array($stub->requestName() => array(
            'a' => array(
                array(
                    'n' => 'key1',
                    '_' => 'value1',
                ),
                array(
                    'n' => 'key2',
                    '_' => 'value2',
                ),
                array(
                    'n' => 'key3',
                    '_' => 'value3',
                ),
            )
        ));
        $this->assertEquals($arr, $stub->toArray());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<'.$stub->requestName().'>'
                .'<a n="key1">value1</a>'
                .'<a n="key2">value2</a>'
                .'<a n="key3">value3</a>'
            .'</'.$stub->requestName().'>';
        $this->assertXmlStringEqualsXmlString($xml, $stub->toXml()->asXml());
    }
}