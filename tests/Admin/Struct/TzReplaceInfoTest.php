<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\CalTZInfo;
use Zimbra\Admin\Struct\TzReplaceInfo;
use Zimbra\Common\Struct\TzOnsetInfo;
use Zimbra\Common\Struct\Id;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for TzReplaceInfo.
 */
class TzReplaceInfoTest extends ZimbraTestCase
{
    public function testTzReplaceInfo()
    {
        $id = $this->faker->word;
        $mon = mt_rand(1, 12);
        $hour = mt_rand(0, 23);
        $min = mt_rand(0, 59);
        $sec = mt_rand(0, 59);
        $wellKnownTz = new Id($id);
        $standard = new TzOnsetInfo($mon, $hour, $min, $sec);
        $daylight = new TzOnsetInfo($mon, $hour, $min, $sec);

        $stdname = $this->faker->word;
        $dayname = $this->faker->word;
        $stdoff = mt_rand(0, 100);
        $dayoff = mt_rand(0, 100);
        $tz = new CalTZInfo($id, $stdoff, $dayoff, $standard, $daylight, $stdname, $dayname);

        $replace = new StubTzReplaceInfo($wellKnownTz, $tz);
        $this->assertSame($wellKnownTz, $replace->getWellKnownTz());
        $this->assertSame($tz, $replace->getCalTz());

        $replace = new StubTzReplaceInfo();
        $replace->setWellKnownTz($wellKnownTz)
                ->setCalTz($tz);
        $this->assertSame($wellKnownTz, $replace->getWellKnownTz());
        $this->assertSame($tz, $replace->getCalTz());

        $xml = <<<EOT
<?xml version="1.0"?>
<result xmlns:urn="urn:zimbraAdmin">
    <urn:wellKnownTz id="$id" />
    <urn:tz id="$id" stdoff="$stdoff" dayoff="$dayoff" stdname="$stdname" dayname="$dayname">
        <urn:standard mon="$mon" hour="$hour" min="$min" sec="$sec" />
        <urn:daylight mon="$mon" hour="$hour" min="$min" sec="$sec" />
    </urn:tz>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($replace, 'xml'));
        $this->assertEquals($replace, $this->serializer->deserialize($xml, StubTzReplaceInfo::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: "urn")]
class StubTzReplaceInfo extends TzReplaceInfo
{
}
