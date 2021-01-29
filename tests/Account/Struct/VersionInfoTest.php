<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Account\Struct\VersionInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for VersionInfo.
 */
class VersionInfoTest extends ZimbraTestCase
{
    public function testVersionInfo()
    {
        $fullVersion = $this->faker->word;
        $release = $this->faker->word;
        $date = $this->faker->date;
        $host = $this->faker->ipv4;

        $info = new VersionInfo($fullVersion, $release, $date, $host);
        $this->assertSame($fullVersion, $info->getFullVersion());
        $this->assertSame($release, $info->getRelease());
        $this->assertSame($date, $info->getDate());
        $this->assertSame($host, $info->getHost());

        $info = new VersionInfo('', '', '', '');
        $info->setFullVersion($fullVersion)
            ->setRelease($release)
            ->setDate($date)
            ->setHost($host);
        $this->assertSame($fullVersion, $info->getFullVersion());
        $this->assertSame($release, $info->getRelease());
        $this->assertSame($date, $info->getDate());
        $this->assertSame($host, $info->getHost());

        $xml = <<<EOT
<?xml version="1.0"?>
<info version="$fullVersion" release="$release" buildDate="$date" host="$host" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($info, 'xml'));
        $this->assertEquals($info, $this->serializer->deserialize($xml, VersionInfo::class, 'xml'));

        $json = json_encode([
            'version' => $fullVersion,
            'release' => $release,
            'buildDate' => $date,
            'host' => $host,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($info, 'json'));
        $this->assertEquals($info, $this->serializer->deserialize($json, VersionInfo::class, 'json'));
    }
}
