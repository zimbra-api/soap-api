<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetAggregateQuotaUsageOnServerBody;
use Zimbra\Admin\Message\GetAggregateQuotaUsageOnServerEnvelope;
use Zimbra\Admin\Message\GetAggregateQuotaUsageOnServerRequest;
use Zimbra\Admin\Message\GetAggregateQuotaUsageOnServerResponse;
use Zimbra\Admin\Struct\DomainAggregateQuotaInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetAggregateQuotaUsageOnServerTest.
 */
class GetAggregateQuotaUsageOnServerTest extends ZimbraTestCase
{
    public function testGetAggregateQuotaUsageOnServer()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $quotaUsed = mt_rand(1, 100);
        $domain = new DomainAggregateQuotaInfo($name, $id, $quotaUsed);

        $request = new GetAggregateQuotaUsageOnServerRequest();

        $response = new GetAggregateQuotaUsageOnServerResponse([$domain]);
        $this->assertSame([$domain], $response->getDomainQuotas());
        $response = new GetAggregateQuotaUsageOnServerResponse();
        $response->setDomainQuotas([$domain])
            ->addDomainQuota($domain);
        $this->assertSame([$domain, $domain], $response->getDomainQuotas());
        $response->setDomainQuotas([$domain]);

        $body = new GetAggregateQuotaUsageOnServerBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetAggregateQuotaUsageOnServerBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetAggregateQuotaUsageOnServerEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetAggregateQuotaUsageOnServerEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAggregateQuotaUsageOnServerRequest />
        <urn:GetAggregateQuotaUsageOnServerResponse>
            <domain name="$name" id="$id" used="$quotaUsed" />
        </urn:GetAggregateQuotaUsageOnServerResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAggregateQuotaUsageOnServerEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetAggregateQuotaUsageOnServerRequest' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'GetAggregateQuotaUsageOnServerResponse' => [
                    'domain' => [
                        [
                            'name' => $name,
                            'id' => $id,
                            'used' => $quotaUsed,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetAggregateQuotaUsageOnServerEnvelope::class, 'json'));
    }
}
