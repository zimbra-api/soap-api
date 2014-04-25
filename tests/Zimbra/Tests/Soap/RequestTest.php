<?php

namespace Zimbra\Tests\Soap;

use Zimbra\Tests\ZimbraTestCase;
use Zimbra\Soap\Request;
use Zimbra\Soap\Request\Attr;
use Zimbra\Soap\Request\Batch;

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

    public function testAttrRequest()
    {
        $stub = $this->getMockForAbstractClass('\Zimbra\Soap\Request\Attr');

        $attr1 = new \Zimbra\Struct\KeyValuePair('key1', 'value1');
        $attr2 = new \Zimbra\Struct\KeyValuePair('key2', 'value2');
        $attr3 = new \Zimbra\Struct\KeyValuePair('key3', 'value3');
        $stub->addAttr($attr1)->attr()->addAll(array($attr2, $attr3));
        $this->assertEquals(array($attr1, $attr2, $attr3), $stub->attr()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<'.$stub->requestName().'>'
                .'<a n="key1">value1</a>'
                .'<a n="key2">value2</a>'
                .'<a n="key3">value3</a>'
            .'</'.$stub->requestName().'>';
        $this->assertXmlStringEqualsXmlString($xml, $stub->toXml()->asXml());
    }

    public function testBatchRequest()
    {
        $req1 = $this->getMockForAbstractClass('\Zimbra\Soap\Request');
        $req1->xmlNamespace('urn:zimbraMail');

        $req2 = $this->getMockForAbstractClass('\Zimbra\Soap\Request');
        $req2->xmlNamespace('urn:zimbraAdmin');

        $batch = new Batch(array($req1, $req2));
        $this->assertEquals(array($req1, $req2), $batch->requests()->all());
 
         $xml = '<?xml version="1.0"?>'."\n"
                .'<BatchRequest>'
                    .'<'.$req1->requestName().' xmlns="urn:zimbraMail" requestId="0" />'
                    .'<'.$req2->requestName().' xmlns="urn:zimbraAdmin" requestId="1" />'
                .'</BatchRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $batch->toXml()->asXml());
    }
}