<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Message;

use Zimbra\Account\Message\CheckLicenseBody;
use Zimbra\Account\Message\CheckLicenseRequest;
use Zimbra\Account\Message\CheckLicenseResponse;
use Zimbra\Enum\CheckLicenseStatus;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckLicenseBody.
 */
class CheckLicenseBodyTest extends ZimbraStructTestCase
{
    public function testCheckLicenseBody()
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
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CheckLicenseBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAccount">'
                . '<urn:CheckLicenseRequest feature="' . $feature . '" />'
                . '<urn:CheckLicenseResponse status="' . CheckLicenseStatus::OK() . '" />'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, CheckLicenseBody::class, 'xml'));

        $json = json_encode([
            'CheckLicenseRequest' => [
                'feature' => $feature,
                '_jsns' => 'urn:zimbraAccount',
            ],
            'CheckLicenseResponse' => [
                'status' => (string) CheckLicenseStatus::OK(),
                '_jsns' => 'urn:zimbraAccount',
            ],
        ]);

        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, CheckLicenseBody::class, 'json'));
    }
}
