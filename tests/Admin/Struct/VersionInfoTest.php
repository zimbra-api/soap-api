<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\VersionInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for VersionInfo.
 */
class VersionInfoTest extends ZimbraTestCase
{
    public function testVersionInfo()
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
        $this->assertSame($type, $info->getType());
        $this->assertSame($version, $info->getVersion());
        $this->assertSame($release, $info->getRelease());
        $this->assertSame($buildDate, $info->getBuildDate());
        $this->assertSame($host, $info->getHost());
        $this->assertSame($majorVersion, $info->getMajorVersion());
        $this->assertSame($minorVersion, $info->getMinorVersion());
        $this->assertSame($microVersion, $info->getMicroVersion());
        $this->assertSame($platform, $info->getPlatform());

        $info = new VersionInfo();
        $info->setType($type)
            ->setVersion($version)
            ->setRelease($release)
            ->setBuildDate($buildDate)
            ->setHost($host)
            ->setMajorVersion($majorVersion)
            ->setMinorVersion($minorVersion)
            ->setMicroVersion($microVersion)
            ->setPlatform($platform);
        $this->assertSame($type, $info->getType());
        $this->assertSame($version, $info->getVersion());
        $this->assertSame($release, $info->getRelease());
        $this->assertSame($buildDate, $info->getBuildDate());
        $this->assertSame($host, $info->getHost());
        $this->assertSame($majorVersion, $info->getMajorVersion());
        $this->assertSame($minorVersion, $info->getMinorVersion());
        $this->assertSame($microVersion, $info->getMicroVersion());
        $this->assertSame($platform, $info->getPlatform());

        $xml = <<<EOT
<?xml version="1.0"?>
<result type="$type" version="$version" release="$release" buildDate="$buildDate" host="$host" majorversion="$majorVersion" minorversion="$minorVersion" microversion="$microVersion" platform="$platform" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($info, 'xml'));
        $this->assertEquals($info, $this->serializer->deserialize($xml, VersionInfo::class, 'xml'));
    }
}
