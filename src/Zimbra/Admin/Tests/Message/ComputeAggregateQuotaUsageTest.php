<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\ComputeAggregateQuotaUsageBody;
use Zimbra\Admin\Message\ComputeAggregateQuotaUsageEnvelope;
use Zimbra\Admin\Message\ComputeAggregateQuotaUsageRequest;
use Zimbra\Admin\Message\ComputeAggregateQuotaUsageResponse;
use Zimbra\Admin\Struct\DomainAggregateQuotaInfo;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ComputeAggregateQuotaUsage.
 */
class ComputeAggregateQuotaUsageTest extends ZimbraStructTestCase
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

    public function testComputeAggregateQuotaUsageEnvelope()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $quotaUsed = mt_rand(1, 100);
        $domain = new DomainAggregateQuotaInfo($name, $id, $quotaUsed);

        $request = new ComputeAggregateQuotaUsageRequest();
        $response = new ComputeAggregateQuotaUsageResponse([$domain]);
        $body = new ComputeAggregateQuotaUsageBody($request, $response);

        $envelope = new ComputeAggregateQuotaUsageEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new ComputeAggregateQuotaUsageEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:ComputeAggregateQuotaUsageRequest />'
                    . '<urn:ComputeAggregateQuotaUsageResponse>'
                        . '<domain name="' . $name . '" id="' . $id . '" used="' . $quotaUsed . '" />'
                    . '</urn:ComputeAggregateQuotaUsageResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ComputeAggregateQuotaUsageEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
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
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, ComputeAggregateQuotaUsageEnvelope::class, 'json'));
    }
}
