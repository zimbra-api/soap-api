<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Message;

use Zimbra\Account\Message\CheckLicenseResponse;
use Zimbra\Enum\CheckLicenseStatus;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckLicenseResponse.
 */
class CheckLicenseResponseTest extends ZimbraStructTestCase
{
    public function testCheckLicenseResponse()
    {
        $res = new CheckLicenseResponse(CheckLicenseStatus::NO());
        $this->assertEquals(CheckLicenseStatus::NO(), $res->getStatus());

        $res = new CheckLicenseResponse(CheckLicenseStatus::NO());
        $res->setStatus(CheckLicenseStatus::OK());
        $this->assertEquals(CheckLicenseStatus::OK(), $res->getStatus());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckLicenseResponse xmlns="urn:zimbraAccount" status="' . CheckLicenseStatus::OK() . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, CheckLicenseResponse::class, 'xml'));

        $json = json_encode([
            'status' => CheckLicenseStatus::OK(),
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, CheckLicenseResponse::class, 'json'));
    }
}
