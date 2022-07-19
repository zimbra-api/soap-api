<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

use Zimbra\Account\Message\GetVersionInfoBody;
use Zimbra\Account\Message\GetVersionInfoEnvelope;
use Zimbra\Account\Message\GetVersionInfoRequest;
use Zimbra\Account\Message\GetVersionInfoResponse;
use Zimbra\Account\Struct\VersionInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetVersionInfoTest.
 */
class GetVersionInfoTest extends ZimbraTestCase
{
    public function testGetVersionInfo()
    {
        $fullVersion = $this->faker->word;
        $release = $this->faker->word;
        $date = $this->faker->date;
        $host = $this->faker->ipv4;

        $request = new GetVersionInfoRequest();

        $info = new VersionInfo($fullVersion, $release, $date, $host);
        $response = new GetVersionInfoResponse($info);
        $this->assertSame($info, $response->getVersionInfo());
        $response = new GetVersionInfoResponse(new VersionInfo());
        $response->setVersionInfo($info);
        $this->assertSame($info, $response->getVersionInfo());

        $body = new GetVersionInfoBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetVersionInfoBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetVersionInfoEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetVersionInfoEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:GetVersionInfoRequest />
        <urn:GetVersionInfoResponse>
            <urn:info version="$fullVersion" release="$release" buildDate="$date" host="$host" />
        </urn:GetVersionInfoResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetVersionInfoEnvelope::class, 'xml'));
    }
}
