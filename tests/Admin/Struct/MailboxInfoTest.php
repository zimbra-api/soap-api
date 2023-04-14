<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\MailboxInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for MailboxInfo.
 */
class MailboxInfoTest extends ZimbraTestCase
{
    public function testMailboxInfo()
    {
        $id = $this->faker->randomNumber;
        $groupId = $this->faker->randomNumber;
        $accountId = $this->faker->uuid;
        $indexVolumeId = $this->faker->randomNumber;
        $itemIdCheckPoint = $this->faker->randomNumber;
        $contactCount = $this->faker->randomNumber;
        $sizeCheckPoint = $this->faker->randomNumber;
        $changeCheckPoint = $this->faker->randomNumber;
        $trackingSync = $this->faker->randomNumber;
        $lastBackupAt = $this->faker->randomNumber;
        $lastSoapAccess = $this->faker->randomNumber;
        $newMessages = $this->faker->randomNumber;

        $mbox = new MailboxInfo(
            $id, $groupId, $accountId, $indexVolumeId, $itemIdCheckPoint,
            $contactCount, $sizeCheckPoint, $changeCheckPoint, $trackingSync, FALSE,
            $lastBackupAt, $lastSoapAccess, $newMessages
        );
        $this->assertSame($id, $mbox->getId());
        $this->assertSame($groupId, $mbox->getGroupId());
        $this->assertSame($accountId, $mbox->getAccountId());
        $this->assertSame($indexVolumeId, $mbox->getIndexVolumeId());
        $this->assertSame($itemIdCheckPoint, $mbox->getItemIdCheckPoint());
        $this->assertSame($contactCount, $mbox->getContactCount());
        $this->assertSame($sizeCheckPoint, $mbox->getSizeCheckPoint());
        $this->assertSame($changeCheckPoint, $mbox->getChangeCheckPoint());
        $this->assertSame($trackingSync, $mbox->getTrackingSync());
        $this->assertFalse($mbox->isTrackingImap());
        $this->assertSame($lastBackupAt, $mbox->getLastBackupAt());
        $this->assertSame($lastSoapAccess, $mbox->getLastSoapAccess());
        $this->assertSame($newMessages, $mbox->getNewMessages());

        $mbox = new MailboxInfo();
        $mbox->setId($id)
            ->setGroupId($groupId)
            ->setAccountId($accountId)
            ->setIndexVolumeId($indexVolumeId)
            ->setItemIdCheckPoint($itemIdCheckPoint)
            ->setContactCount($contactCount)
            ->setSizeCheckPoint($sizeCheckPoint)
            ->setChangeCheckPoint($changeCheckPoint)
            ->setTrackingSync($trackingSync)
            ->setTrackingImap(TRUE)
            ->setLastBackupAt($lastBackupAt)
            ->setLastSoapAccess($lastSoapAccess)
            ->setNewMessages($newMessages);
        $this->assertSame($id, $mbox->getId());
        $this->assertSame($groupId, $mbox->getGroupId());
        $this->assertSame($accountId, $mbox->getAccountId());
        $this->assertSame($indexVolumeId, $mbox->getIndexVolumeId());
        $this->assertSame($itemIdCheckPoint, $mbox->getItemIdCheckPoint());
        $this->assertSame($contactCount, $mbox->getContactCount());
        $this->assertSame($sizeCheckPoint, $mbox->getSizeCheckPoint());
        $this->assertSame($changeCheckPoint, $mbox->getChangeCheckPoint());
        $this->assertSame($trackingSync, $mbox->getTrackingSync());
        $this->assertTrue($mbox->isTrackingImap());
        $this->assertSame($lastBackupAt, $mbox->getLastBackupAt());
        $this->assertSame($lastSoapAccess, $mbox->getLastSoapAccess());
        $this->assertSame($newMessages, $mbox->getNewMessages());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" groupId="$groupId" accountId="$accountId" indexVolumeId="$indexVolumeId" itemIdCheckPoint="$itemIdCheckPoint" contactCount="$contactCount" sizeCheckPoint="$sizeCheckPoint" changeCheckPoint="$changeCheckPoint" trackingSync="$trackingSync" trackingImap="true" lastBackupAt="$lastBackupAt" lastSoapAccess="$lastSoapAccess" newMessages="$newMessages" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($mbox, 'xml'));
        $this->assertEquals($mbox, $this->serializer->deserialize($xml, MailboxInfo::class, 'xml'));
    }
}
