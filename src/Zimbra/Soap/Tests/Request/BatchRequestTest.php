<?php declare(strict_types=1);

namespace Zimbra\Soap\Tests\Request;

use JMS\Serializer\Annotation\{SerializedName, Type, XmlRoot, XmlValue};
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
        $foo = new FooRequest;
        $bar = new BarRequest;

        $batch = new Batch([$foo]);
        $this->assertEquals([$foo], $batch->getRequests());

        $batch = new Batch;
        $batch->setOnError('continue');
        $batch->setRequests([$foo])->addRequest($bar);
        $this->assertEquals([$foo, $bar], $batch->getRequests());
        $this->assertEquals('continue', $batch->getOnError());

         $xml = '<?xml version="1.0"?>'."\n"
                .'<BatchRequest xmlns="urn:zimbra" onerror="continue">'
                    .'<FooRequest xmlns="urn:zimbraFoo" requestId="0">foo</FooRequest>'
                    .'<BarRequest xmlns="urn:zimbraBar" requestId="1">bar</BarRequest>'
                .'</BatchRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($batch, 'xml'));

        $json = json_encode([
            '_jsns' => 'urn:zimbra',
            'onerror' => 'continue',
            'FooRequest' => [
                '_content' => 'foo',
                'requestId' => '0',
                '_jsns' => 'urn:zimbraFoo',
            ],
            'BarRequest' => [
                '_content' => 'bar',
                'requestId' => '1',
                '_jsns' => 'urn:zimbraBar',
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($batch, 'json'));
    }
}

/**
 * @XmlRoot(name="FooRequest", namespace="urn:zimbraFoo")
 */
class FooRequest extends Request
{
    /**
     * @Type("string")
     * @SerializedName("_content")
     * @XmlValue(cdata=false)
     */
    private $value = 'foo';

    protected function envelopeInit(): void
    {
    }
}

/**
 * @XmlRoot(name="BarRequest", namespace="urn:zimbraBar")
 */
class BarRequest extends Request
{
    /**
     * @Type("string")
     * @SerializedName("_content")
     * @XmlValue(cdata=false)
     */
    private $value = 'bar';

    protected function envelopeInit(): void
    {
    }
}
