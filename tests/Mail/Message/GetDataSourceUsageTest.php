<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\GetDataSourceUsageEnvelope;
use Zimbra\Mail\Message\GetDataSourceUsageBody;
use Zimbra\Mail\Message\GetDataSourceUsageRequest;
use Zimbra\Mail\Message\GetDataSourceUsageResponse;

use Zimbra\Mail\Struct\DataSourceUsage;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetDataSourceUsage.
 */
class GetDataSourceUsageTest extends ZimbraTestCase
{
    public function testGetDataSourceUsage()
    {
        $id = $this->faker->uuid;
        $usage = $this->faker->randomNumber;
        $dataSourceQuota = $this->faker->randomNumber;
        $totalQuota = $this->faker->randomNumber;

        $dsUsage = new DataSourceUsage(
            $id, $usage
        );

        $request = new GetDataSourceUsageRequest();
        $response = new GetDataSourceUsageResponse($dataSourceQuota, $totalQuota, [$dsUsage]);
        $this->assertSame($dataSourceQuota, $response->getDataSourceQuota());
        $this->assertSame($totalQuota, $response->getDataSourceTotalQuota());
        $this->assertSame([$dsUsage], $response->getUsages());
        $response = new GetDataSourceUsageResponse(0, 0);
        $response->setDataSourceQuota($dataSourceQuota)
            ->setDataSourceTotalQuota($totalQuota)
            ->setUsages([$dsUsage])
            ->addDataSourceUsage($dsUsage);
        $this->assertSame($dataSourceQuota, $response->getDataSourceQuota());
        $this->assertSame($totalQuota, $response->getDataSourceTotalQuota());
        $this->assertSame([$dsUsage, $dsUsage], $response->getUsages());
        $response = new GetDataSourceUsageResponse($dataSourceQuota, $totalQuota, [$dsUsage]);

        $body = new GetDataSourceUsageBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetDataSourceUsageBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetDataSourceUsageEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetDataSourceUsageEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetDataSourceUsageRequest />
        <urn:GetDataSourceUsageResponse>
            <dataSourceUsage id="$id" usage="$usage" />
            <dsQuota>$dataSourceQuota</dsQuota>
            <dsTotalQuota>$totalQuota</dsTotalQuota>
        </urn:GetDataSourceUsageResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetDataSourceUsageEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetDataSourceUsageRequest' => [
                    '_jsns' => 'urn:zimbraMail',
                ],
                'GetDataSourceUsageResponse' => [
                    'dataSourceUsage' => [
                        [
                            'id' => $id,
                            'usage' => $usage,
                        ],
                    ],
                    'dsQuota' => [
                        '_content' => $dataSourceQuota,
                    ],
                    'dsTotalQuota' => [
                        '_content' => $totalQuota,
                    ],
                    '_jsns' => 'urn:zimbraMail',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetDataSourceUsageEnvelope::class, 'json'));
    }
}
