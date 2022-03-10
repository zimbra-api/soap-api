<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\LicenseExpirationInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for LicenseExpirationInfo.
 */
class LicenseExpirationInfoTest extends ZimbraTestCase
{
    public function testLicenseExpirationInfo()
    {
        $date = date('Ymd');
        $expiration = new LicenseExpirationInfo($date);
        $this->assertSame($date, $expiration->getDate());

        $expiration = new LicenseExpirationInfo('');
        $expiration->setDate($date);
        $this->assertSame($date, $expiration->getDate());

        $xml = <<<EOT
<?xml version="1.0"?>
<result date="$date" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($expiration, 'xml'));
        $this->assertEquals($expiration, $this->serializer->deserialize($xml, LicenseExpirationInfo::class, 'xml'));

        $json = json_encode([
            'date' => $date,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($expiration, 'json'));
        $this->assertEquals($expiration, $this->serializer->deserialize($json, LicenseExpirationInfo::class, 'json'));
    }
}
