<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\VolumeExternalOpenIOInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for VolumeExternalOpenIOInfo.
 */
class VolumeExternalOpenIOInfoTest extends ZimbraTestCase
{
    public function testVolumeExternalOpenIOInfo()
    {
        $storageType = $this->faker->word;
        $url = $this->faker->word;
        $account = $this->faker->word;
        $nameSpace = $this->faker->word;
        $proxyPort = $this->faker->randomNumber;
        $accountPort = $this->faker->randomNumber;

        $info = new VolumeExternalOpenIOInfo(
            $storageType, $url, $account, $nameSpace, $proxyPort, $accountPort
        );
        $this->assertSame($storageType, $info->getStorageType());
        $this->assertSame($url, $info->getUrl());
        $this->assertSame($account, $info->getAccount());
        $this->assertSame($nameSpace, $info->getNameSpace());
        $this->assertSame($proxyPort, $info->getProxyPort());
        $this->assertSame($accountPort, $info->getAccountPort());

        $info = new VolumeExternalOpenIOInfo();
        $info->setStorageType($storageType)
             ->setUrl($url)
             ->setAccount($account)
             ->setNameSpace($nameSpace)
             ->setProxyPort($proxyPort)
             ->setAccountPort($accountPort);
        $this->assertSame($storageType, $info->getStorageType());
        $this->assertSame($url, $info->getUrl());
        $this->assertSame($account, $info->getAccount());
        $this->assertSame($nameSpace, $info->getNameSpace());
        $this->assertSame($proxyPort, $info->getProxyPort());
        $this->assertSame($accountPort, $info->getAccountPort());

        $xml = <<<EOT
<?xml version="1.0"?>
<result storageType="$storageType" url="$url" account="$account" namespace="$nameSpace" proxyPort="$proxyPort" accountPort="$accountPort" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($info, 'xml'));
        $this->assertEquals($info, $this->serializer->deserialize($xml, VolumeExternalOpenIOInfo::class, 'xml'));
    }
}
