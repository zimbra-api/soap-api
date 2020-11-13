<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Message;

use Zimbra\Account\Message\CheckLicenseRequest;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckLicenseRequest.
 */
class CheckLicenseRequestTest extends ZimbraStructTestCase
{
    public function testCheckLicenseRequest()
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
        $req = new CheckLicenseRequest($feature);
        $this->assertSame($feature, $req->getFeature());

        $req = new CheckLicenseRequest('');
        $req->setFeature($feature);
        $this->assertSame($feature, $req->getFeature());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckLicenseRequest xmlns="urn:zimbraAccount" feature="' . $feature . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, CheckLicenseRequest::class, 'xml'));

        $json = json_encode([
            'feature' => $feature,
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, CheckLicenseRequest::class, 'json'));
    }
}
