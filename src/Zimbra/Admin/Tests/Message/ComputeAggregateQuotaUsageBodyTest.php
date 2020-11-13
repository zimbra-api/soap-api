<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\ComputeAggregateQuotaUsageBody;
use Zimbra\Admin\Message\ComputeAggregateQuotaUsageRequest;
use Zimbra\Admin\Message\ComputeAggregateQuotaUsageResponse;
use Zimbra\Admin\Struct\DomainAggregateQuotaInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ComputeAggregateQuotaUsageBody.
 */
class ComputeAggregateQuotaUsageBodyTest extends ZimbraStructTestCase
{
    public function testComputeAggregateQuotaUsageBody()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $quotaUsed = mt_rand(1, 100);
        $domain = new DomainAggregateQuotaInfo($name, $id, $quotaUsed);

        $request = new ComputeAggregateQuotaUsageRequest();
        $response = new ComputeAggregateQuotaUsageResponse([$domain]);

        $body = new ComputeAggregateQuotaUsageBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new ComputeAggregateQuotaUsageBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:ComputeAggregateQuotaUsageRequest />'
                . '<urn:ComputeAggregateQuotaUsageResponse>'
                    . '<domain name="' . $name . '" id="' . $id . '" used="' . $quotaUsed . '" />'
                . '</urn:ComputeAggregateQuotaUsageResponse>'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, ComputeAggregateQuotaUsageBody::class, 'xml'));

        $json = json_encode([
            'ComputeAggregateQuotaUsageRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
            'ComputeAggregateQuotaUsageResponse' => [
                'domain' => [
                    [
                        'name' => $name,
                        'id' => $id,
                        'used' => $quotaUsed,
                    ],
                ],
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, ComputeAggregateQuotaUsageBody::class, 'json'));
    }
}
