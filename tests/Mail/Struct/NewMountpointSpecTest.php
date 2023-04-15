<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\NewMountpointSpec;
use Zimbra\Common\Enum\ViewType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for NewMountpointSpec.
 */
class NewMountpointSpecTest extends ZimbraTestCase
{
    public function testNewMountpointSpec()
    {
        $name = $this->faker->word;
        $folderId = $this->faker->uuid;
        $defaultView = ViewType::CONVERSATION;
        $flags = $this->faker->word;
        $color = $this->faker->numberBetween(0, 127);
        $rgb = $this->faker->hexcolor;
        $url = $this->faker->word;
        $ownerId = $this->faker->uuid;
        $ownerName = $this->faker->word;
        $remoteId = $this->faker->numberBetween(0, 99);
        $path = $this->faker->word;

        $mount = new NewMountpointSpec(
            $name,
            $folderId,
            $defaultView,
            $flags,
            $color,
            $rgb,
            $url,
            FALSE,
            FALSE,
            $ownerId,
            $ownerName,
            $remoteId,
            $path
        );
        $this->assertSame($name, $mount->getName());
        $this->assertSame($folderId, $mount->getFolderId());
        $this->assertSame($defaultView, $mount->getDefaultView());
        $this->assertSame($flags, $mount->getFlags());
        $this->assertSame($color, $mount->getColor());
        $this->assertSame($rgb, $mount->getRgb());
        $this->assertSame($url, $mount->getUrl());
        $this->assertFalse($mount->getFetchIfExists());
        $this->assertFalse($mount->getReminderEnabled());
        $this->assertSame($ownerId, $mount->getOwnerId());
        $this->assertSame($ownerName, $mount->getOwnerName());
        $this->assertSame($remoteId, $mount->getRemoteId());
        $this->assertSame($path, $mount->getPath());

        $mount = new NewMountpointSpec('', '');
        $mount->setName($name)
            ->setFolderId($folderId)
            ->setDefaultView($defaultView)
            ->setFlags($flags)
            ->setColor($color)
            ->setRgb($rgb)
            ->setUrl($url)
            ->setFetchIfExists(TRUE)
            ->setReminderEnabled(TRUE)
            ->setOwnerId($ownerId)
            ->setOwnerName($ownerName)
            ->setRemoteId($remoteId)
            ->setPath($path);
        $this->assertSame($name, $mount->getName());
        $this->assertSame($folderId, $mount->getFolderId());
        $this->assertSame($defaultView, $mount->getDefaultView());
        $this->assertSame($flags, $mount->getFlags());
        $this->assertSame($color, $mount->getColor());
        $this->assertSame($rgb, $mount->getRgb());
        $this->assertSame($url, $mount->getUrl());
        $this->assertTrue($mount->getFetchIfExists());
        $this->assertTrue($mount->getReminderEnabled());
        $this->assertSame($ownerId, $mount->getOwnerId());
        $this->assertSame($ownerName, $mount->getOwnerName());
        $this->assertSame($remoteId, $mount->getRemoteId());
        $this->assertSame($path, $mount->getPath());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" view="conversation" f="$flags" color="$color" rgb="$rgb" url="$url" l="$folderId" fie="true" reminder="true" zid="$ownerId" owner="$ownerName" rid="$remoteId" path="$path" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($mount, 'xml'));
        $this->assertEquals($mount, $this->serializer->deserialize($xml, NewMountpointSpec::class, 'xml'));
    }
}
