<?php

namespace Zimbra\Soap\Tests\Request;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlRoot;
use JMS\Serializer\Annotation\XmlValue;

use Zimbra\Soap\ClientInterface;
use Zimbra\Soap\Request;
use Zimbra\Soap\Request\Batch;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for BatchRequest.
 */
class BatchRequestTest extends ZimbraStructTestCase
{
    public function testBatchRequest()
    {
        $foo = new FooRequest();
        $bar = new BarRequest();

        $batch = new Batch([$foo]);
        $this->assertEquals([$foo], $batch->getRequests());

        $batch = new Batch([]);
        $batch->setOnError('continue');
        $batch->setRequests([$foo])->addRequest($bar);
        $this->assertEquals([$foo, $bar], $batch->getRequests());
        $this->assertEquals('continue', $batch->getOnError());

         $xml = '<?xml version="1.0"?>'."\n"
                .'<BatchRequest onerror="continue">'
                    .'<FooRequest requestId="0">foo</FooRequest>'
                    .'<BarRequest requestId="1">bar</BarRequest>'
                .'</BatchRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($batch, 'xml'));
    }
}

/**
 * @XmlRoot(name="FooRequest")
 */
class FooRequest extends Request
{
    /**
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $_value = 'foo';

    public function execute(ClientInterface $client) {}
}

/**
 * @XmlRoot(name="BarRequest")
 */
class BarRequest extends Request
{
    /**
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $_value = 'bar';

    public function execute(ClientInterface $client) {}
}
