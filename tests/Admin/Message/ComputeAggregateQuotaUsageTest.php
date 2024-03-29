<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\ComputeAggregateQuotaUsageBody;
use Zimbra\Admin\Message\ComputeAggregateQuotaUsageEnvelope;
use Zimbra\Admin\Message\ComputeAggregateQuotaUsageRequest;
use Zimbra\Admin\Message\ComputeAggregateQuotaUsageResponse;
use Zimbra\Admin\Struct\DomainAggregateQuotaInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ComputeAggregateQuotaUsage.
 */
class ComputeAggregateQuotaUsageTest extends ZimbraTestCase
{
    public function testComputeAggregateQuotaUsage()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $quotaUsed = $this->faker->randomNumber;
        $domain = new DomainAggregateQuotaInfo($name, $id, $quotaUsed);

        $request = new ComputeAggregateQuotaUsageRequest();
        $response = new ComputeAggregateQuotaUsageResponse([$domain]);
        $this->assertSame([$domain], $response->getDomainQuotas());

        $response = new ComputeAggregateQuotaUsageResponse();
        $response->setDomainQuotas([$domain]);
        $this->assertSame([$domain], $response->getDomainQuotas());

        $body = new ComputeAggregateQuotaUsageBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new ComputeAggregateQuotaUsageBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ComputeAggregateQuotaUsageEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new ComputeAggregateQuotaUsageEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ComputeAggregateQuotaUsageRequest />
        <urn:ComputeAggregateQuotaUsageResponse>
            <urn:domain name="$name" id="$id" used="$quotaUsed" />
        </urn:ComputeAggregateQuotaUsageResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ComputeAggregateQuotaUsageEnvelope::class, 'xml'));
    }
}
