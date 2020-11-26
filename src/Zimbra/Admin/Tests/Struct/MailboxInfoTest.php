<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\MailboxInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for MailboxInfo.
 */
class MailboxInfoTest extends ZimbraStructTestCase
{
    public function testMailboxInfo()
    {
        $id = mt_rand(1, 100);
        $groupId = mt_rand(1, 100);
        $accountId = $this->faker->uuid;
        $indexVolumeId = mt_rand(1, 100);
        $itemIdCheckPoint = mt_rand(1, 100);
        $contactCount = mt_rand(1, 100);
        $sizeCheckPoint = mt_rand(1, 100);
        $changeCheckPoint = mt_rand(1, 100);
        $trackingSync = mt_rand(1, 100);
        $lastBackupAt = mt_rand(1, 100);
        $lastSoapAccess = mt_rand(1, 100);
        $newMessages = mt_rand(1, 100);

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

        $mbox = new MailboxInfo(0, 0, '', 0, 0, 0, 0, 0, 0, FALSE, 0, 0, 0);
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

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<mbox id="' . $id . '" groupId="' . $groupId . '" accountId="' . $accountId . '" indexVolumeId="' . $indexVolumeId . '" itemIdCheckPoint="' . $itemIdCheckPoint . '" contactCount="' . $contactCount . '" sizeCheckPoint="' . $sizeCheckPoint . '" changeCheckPoint="' . $changeCheckPoint . '" trackingSync="' . $trackingSync . '" trackingImap="true" lastBackupAt="' . $lastBackupAt . '" lastSoapAccess="' . $lastSoapAccess . '" newMessages="' . $newMessages . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($mbox, 'xml'));
        $this->assertEquals($mbox, $this->serializer->deserialize($xml, MailboxInfo::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'groupId' => $groupId,
            'accountId' => $accountId,
            'indexVolumeId' => $indexVolumeId,
            'itemIdCheckPoint' => $itemIdCheckPoint,
            'contactCount' => $contactCount,
            'sizeCheckPoint' => $sizeCheckPoint,
            'changeCheckPoint' => $changeCheckPoint,
            'trackingSync' => $trackingSync,
            'trackingImap' => TRUE,
            'lastBackupAt' => $lastBackupAt,
            'lastSoapAccess' => $lastSoapAccess,
            'newMessages' => $newMessages,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($mbox, 'json'));
        $this->assertEquals($mbox, $this->serializer->deserialize($json, MailboxInfo::class, 'json'));
    }
}
