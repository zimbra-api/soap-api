<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetVersionInfoBody;
use Zimbra\Admin\Message\GetVersionInfoEnvelope;
use Zimbra\Admin\Message\GetVersionInfoRequest;
use Zimbra\Admin\Message\GetVersionInfoResponse;
use Zimbra\Admin\Struct\VersionInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetVersionInfo.
 */
class GetVersionInfoTest extends ZimbraTestCase
{
    public function testGetVersionInfo()
    {
        $type = $this->faker->word;
        $version = $this->faker->word;
        $release = $this->faker->word;
        $buildDate = date('Ymd-Hi');
        $host = $this->faker->ipv4;
        $majorVersion = $this->faker->word;
        $minorVersion = $this->faker->word;
        $microVersion = $this->faker->word;
        $platform = $this->faker->word;

        $info = new VersionInfo(
            $type, $version, $release, $buildDate, $host, $majorVersion, $minorVersion, $microVersion, $platform
        );

        $request = new GetVersionInfoRequest();
        $response = new GetVersionInfoResponse($info);
        $this->assertSame($info, $response->getInfo());
        $response = new GetVersionInfoResponse(new VersionInfo());
        $response->setInfo($info);
        $this->assertSame($info, $response->getInfo());

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
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetVersionInfoRequest />
        <urn:GetVersionInfoResponse>
            <urn:info type="$type" version="$version" release="$release" buildDate="$buildDate" host="$host" majorversion="$majorVersion" minorversion="$minorVersion" microversion="$microVersion" platform="$platform" />
        </urn:GetVersionInfoResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetVersionInfoEnvelope::class, 'xml'));
    }
}
