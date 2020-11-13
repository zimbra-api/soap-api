<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\ComputeAggregateQuotaUsageRequest;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ComputeAggregateQuotaUsageRequest.
 */
class ComputeAggregateQuotaUsageRequestTest extends ZimbraStructTestCase
{
    public function testComputeAggregateQuotaUsageRequest()
    {
        $res = new ComputeAggregateQuotaUsageRequest();

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ComputeAggregateQuotaUsageRequest />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, ComputeAggregateQuotaUsageRequest::class, 'xml'));

        $json = '{}';
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, ComputeAggregateQuotaUsageRequest::class, 'json'));
    }
}
