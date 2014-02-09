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

        $stub->requestNamespace('urn:zimbraMail');
        $this->assertEquals('urn:zimbraMail', $stub->requestNamespace());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<'.$stub->requestName().' />';
        $this->assertXmlStringEqualsXmlString($xml, $stub->toXml()->asXml());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope">'
                .'<soap:Header>'
                    .'<context xmlns="urn:zimbra">'
                        .'<change token="13696"/>'
                    .'</context>'
                .'</soap:Header>'
                .'<soap:Body>'
                    .'<'.$stub->responseName().' xmlns="urn:zimbraAccount">'
                        .'<authToken>104cd8b8592b911f6a9c6705f560f3d698c51be2</authToken>'
                        .'<lifetime>172800000</lifetime>'
                        .'<skin>serenity</skin>'
                    .'</'.$stub->responseName().'>'
                .'</soap:Body>'
            .'</soap:Envelope>';
        $response = $stub->processResponse($xml);
        $this->assertObjectHasAttribute('authToken', $response);
        $this->assertSame('104cd8b8592b911f6a9c6705f560f3d698c51be2', $response->authToken);
        $this->assertObjectHasAttribute('lifetime', $response);
        $this->assertSame('172800000', $response->lifetime);
        $this->assertObjectHasAttribute('skin', $response);
        $this->assertSame('serenity', $response->skin);
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