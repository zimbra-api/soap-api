<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\Folder;
use Zimbra\Mail\Struct\Mountpoint;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for Mountpoint.
 */
class MountpointTest extends ZimbraTestCase
{
    public function testMountpoint()
    {
        $id = $this->faker->uuid;
        $uuid = $this->faker->uuid;
        $ownerEmail = $this->faker->email;
        $ownerAccountId = $this->faker->uuid;
        $remoteFolderId = $this->faker->randomNumber;
        $remoteUuid = $this->faker->uuid;
        $remoteFolderName = $this->faker->word;

        $link = new Mountpoint(
            $id,
            $uuid,
            $ownerEmail,
            $ownerAccountId,
            $remoteFolderId,
            $remoteUuid,
            $remoteFolderName,
            FALSE,
            FALSE
        );
        $this->assertTrue($link instanceof Folder);
        $this->assertSame($ownerEmail, $link->getOwnerEmail());
        $this->assertSame($ownerAccountId, $link->getOwnerAccountId());
        $this->assertSame($remoteFolderId, $link->getRemoteFolderId());
        $this->assertSame($remoteUuid, $link->getRemoteUuid());
        $this->assertSame($remoteFolderName, $link->getRemoteFolderName());
        $this->assertFalse($link->getReminderEnabled());
        $this->assertFalse($link->getBroken());

        $link = new Mountpoint(
            $id,
            $uuid,
        );
        $link->setOwnerEmail($ownerEmail)
            ->setOwnerAccountId($ownerAccountId)
            ->setRemoteFolderId($remoteFolderId)
            ->setRemoteUuid($remoteUuid)
            ->setRemoteFolderName($remoteFolderName)
            ->setReminderEnabled(TRUE)
            ->setBroken(TRUE);

        $this->assertSame($ownerEmail, $link->getOwnerEmail());
        $this->assertSame($ownerAccountId, $link->getOwnerAccountId());
        $this->assertSame($remoteFolderId, $link->getRemoteFolderId());
        $this->assertSame($remoteUuid, $link->getRemoteUuid());
        $this->assertSame($remoteFolderName, $link->getRemoteFolderName());
        $this->assertTrue($link->getReminderEnabled());
        $this->assertTrue($link->getBroken());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" uuid="$uuid" owner="$ownerEmail" zid="$ownerAccountId" rid="$remoteFolderId" ruuid="$remoteUuid" oname="$remoteFolderName" reminder="true" broken="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($link, 'xml'));
        $this->assertEquals($link, $this->serializer->deserialize($xml, Mountpoint::class, 'xml'));
    }
}
