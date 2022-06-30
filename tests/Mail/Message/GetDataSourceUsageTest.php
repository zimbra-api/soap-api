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
        $response = new GetDataSourceUsageResponse();
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
            <urn:dataSourceUsage id="$id" usage="$usage" />
            <urn:dsQuota>$dataSourceQuota</urn:dsQuota>
            <urn:dsTotalQuota>$totalQuota</urn:dsTotalQuota>
        </urn:GetDataSourceUsageResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetDataSourceUsageEnvelope::class, 'xml'));
    }
}
