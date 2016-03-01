<?php

namespace Zimbra\Soap\Tests;

use Zimbra\Soap\Request;
use Zimbra\Soap\Request\Attr;
use Zimbra\Soap\Request\Batch;

/**
 * Testcase class for soap request.
 */
class RequestTest extends ZimbraSoapTestCase
{
    public function testRequest()
    {
        $stub = $this->getMockForAbstractClass('\Zimbra\Soap\Request');
        $this->assertStringEndsWith('Request', $stub->requestName());
        $this->assertStringEndsWith('Response', $stub->responseName());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<'.$stub->requestName().' />';
        $this->assertXmlStringEqualsXmlString($xml, $stub->toXml()->asXml());
    }

    public function testAttrRequest()
    {
        $stub = $this->getMockForAbstractClass('\Zimbra\Soap\Request\Attr');

        $attr1 = new \Zimbra\Struct\KeyValuePair('key1', 'value1');
        $attr2 = new \Zimbra\Struct\KeyValuePair('key2', 'value2');
        $attr3 = new \Zimbra\Struct\KeyValuePair('key3', 'value3');
        $stub->addAttr($attr1)->getAttrs()->addAll([$attr2, $attr3]);
        $this->assertEquals([$attr1, $attr2, $attr3], $stub->getAttrs()->all());

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
        $req1->setXmlNamespace('urn:zimbraMail');

        $req2 = $this->getMockForAbstractClass('\Zimbra\Soap\Request');
        $req2->setXmlNamespace('urn:zimbraAdmin');

        $batch = new Batch([$req1, $req2]);
        $this->assertEquals([$req1, $req2], $batch->getRequests()->all());
 
         $xml = '<?xml version="1.0"?>'."\n"
                .'<BatchRequest>'
                    .'<'.$req1->requestName().' xmlns="urn:zimbraMail" requestId="0" />'
                    .'<'.$req2->requestName().' xmlns="urn:zimbraAdmin" requestId="1" />'
                .'</BatchRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $batch->toXml()->asXml());
    }
}
