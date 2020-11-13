<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\ComputeAggregateQuotaUsageResponse;
use Zimbra\Admin\Struct\DomainAggregateQuotaInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ComputeAggregateQuotaUsageResponse.
 */
class ComputeAggregateQuotaUsageResponseTest extends ZimbraStructTestCase
{
    public function testComputeAggregateQuotaUsageResponse()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $quotaUsed = mt_rand(1, 100);
        $domain = new DomainAggregateQuotaInfo($name, $id, $quotaUsed);

        $res = new ComputeAggregateQuotaUsageResponse([$domain]);
        $this->assertSame([$domain], $res->getDomainQuotas());

        $res = new ComputeAggregateQuotaUsageResponse();
        $res->setDomainQuotas([$domain])
            ->addDomainQuota($domain);
        $this->assertSame([$domain, $domain], $res->getDomainQuotas());

        $res = new ComputeAggregateQuotaUsageResponse([$domain]);
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ComputeAggregateQuotaUsageResponse>'
                . '<domain name="' . $name . '" id="' . $id . '" used="' . $quotaUsed . '" />'
            . '</ComputeAggregateQuotaUsageResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, ComputeAggregateQuotaUsageResponse::class, 'xml'));

        $json = json_encode([
            'domain' => [
                [
                    'name' => $name,
                    'id' => $id,
                    'used' => $quotaUsed,
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, ComputeAggregateQuotaUsageResponse::class, 'json'));
    }
}
