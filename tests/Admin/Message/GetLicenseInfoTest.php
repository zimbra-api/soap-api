<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Request;

use Zimbra\Admin\Message\GetLicenseInfoBody;
use Zimbra\Admin\Message\GetLicenseInfoEnvelope;
use Zimbra\Admin\Message\GetLicenseInfoRequest;
use Zimbra\Admin\Message\GetLicenseInfoResponse;

use Zimbra\Admin\Struct\LicenseExpirationInfo;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetLicenseInfo.
 */
class GetLicenseInfoTest extends ZimbraTestCase
{
    public function testGetLicenseInfo()
    {
        $date = date('Ymd');
        $expiration = new LicenseExpirationInfo($date);

        $request = new GetLicenseInfoRequest();

        $response = new GetLicenseInfoResponse($expiration);
        $this->assertSame($expiration, $response->getExpiration());
        $response = new GetLicenseInfoResponse(new LicenseExpirationInfo($date));
        $response->setExpiration($expiration);
        $this->assertSame($expiration, $response->getExpiration());

        $body = new GetLicenseInfoBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new GetLicenseInfoBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetLicenseInfoEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new GetLicenseInfoEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetLicenseInfoRequest />
        <urn:GetLicenseInfoResponse>
            <expiration date="$date" />
        </urn:GetLicenseInfoResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetLicenseInfoEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetLicenseInfoRequest' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'GetLicenseInfoResponse' => [
                    'expiration' => [
                        'date' => $date,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetLicenseInfoEnvelope::class, 'json'));
    }
}
