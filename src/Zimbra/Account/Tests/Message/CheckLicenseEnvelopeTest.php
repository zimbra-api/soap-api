<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Message;

use Zimbra\Account\Message\CheckLicenseEnvelope;
use Zimbra\Account\Message\CheckLicenseBody;
use Zimbra\Account\Message\CheckLicenseRequest;
use Zimbra\Account\Message\CheckLicenseResponse;
use Zimbra\Enum\CheckLicenseStatus;
use Zimbra\Struct\Tests\ZimbraStructTestCase;
/**
 * Testcase class for CheckLicenseEnvelope.
 */
class CheckLicenseEnvelopeTest extends ZimbraStructTestCase
{
    public function testCheckLicenseEnvelope()
    {
        $feature = $this->faker->randomElement([
            'mapi',
            'mobilesync',
            'isync',
            'smime',
            'bes',
            'ews',
            'touchclient',
        ]);
        $request = new CheckLicenseRequest($feature);
        $response = new CheckLicenseResponse(CheckLicenseStatus::OK());
        $body = new CheckLicenseBody($request, $response);

        $envelope = new CheckLicenseEnvelope(NULL, $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CheckLicenseEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">'
                . '<soap:Body>'
                    . '<urn:CheckLicenseRequest feature="' . $feature . '" />'
                    . '<urn:CheckLicenseResponse status="' . CheckLicenseStatus::OK() . '" />'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CheckLicenseEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'CheckLicenseRequest' => [
                    'feature' => $feature,
                    '_jsns' => 'urn:zimbraAccount',
                ],
                'CheckLicenseResponse' => [
                    'status' => (string) CheckLicenseStatus::OK(),
                    '_jsns' => 'urn:zimbraAccount',
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CheckLicenseEnvelope::class, 'json'));
    }
}
