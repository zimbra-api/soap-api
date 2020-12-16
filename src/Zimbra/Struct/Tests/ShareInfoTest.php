<?php declare(strict_types=1);

namespace Zimbra\Struct\Tests;

use Zimbra\Struct\ShareInfo;

/**
 * Testcase class for ShareInfo.
 */
class ShareInfoTest extends ZimbraStructTestCase
{
    public function testShareInfo()
    {
        $ownerId = $this->faker->uuid;
        $ownerEmail = $this->faker->email;
        $ownerDisplayName = $this->faker->name;
        $folderId = mt_rand(1, 100);
        $folderUuid = $this->faker->uuid;
        $folderPath = $this->faker->word;
        $defaultView = $this->faker->word;
        $rights = $this->faker->word;
        $granteeType = $this->faker->word;
        $granteeId = $this->faker->uuid;
        $granteeName = $this->faker->name;
        $granteeDisplayName = $this->faker->name;
        $mountpointId = $this->faker->uuid;

        $share = new ShareInfo(
            $ownerId, $ownerEmail, $ownerDisplayName,
            $folderId, $folderUuid, $folderPath,
            $defaultView, $rights,
            $granteeType, $granteeId, $granteeName, $granteeDisplayName,
            $mountpointId
        );
        $this->assertSame($ownerId, $share->getOwnerId());
        $this->assertSame($ownerEmail, $share->getOwnerEmail());
        $this->assertSame($ownerDisplayName, $share->getOwnerDisplayName());
        $this->assertSame($folderId, $share->getFolderId());
        $this->assertSame($folderUuid, $share->getFolderUuid());
        $this->assertSame($folderPath, $share->getFolderPath());
        $this->assertSame($defaultView, $share->getDefaultView());
        $this->assertSame($rights, $share->getRights());
        $this->assertSame($granteeType, $share->getGranteeType());
        $this->assertSame($granteeId, $share->getGranteeId());
        $this->assertSame($granteeName, $share->getGranteeName());
        $this->assertSame($granteeDisplayName, $share->getGranteeDisplayName());
        $this->assertSame($mountpointId, $share->getMountpointId());

        $share = new ShareInfo('', '', '', 0, '', '', '', '', '', '', '', '', '');
        $share->setOwnerId($ownerId)
            ->setOwnerEmail($ownerEmail)
            ->setOwnerDisplayName($ownerDisplayName)
            ->setFolderId($folderId)
            ->setFolderUuid($folderUuid)
            ->setFolderPath($folderPath)
            ->setDefaultView($defaultView)
            ->setRights($rights)
            ->setGranteeType($granteeType)
            ->setGranteeId($granteeId)
            ->setGranteeName($granteeName)
            ->setGranteeDisplayName($granteeDisplayName)
            ->setMountpointId($mountpointId);
        $this->assertSame($ownerId, $share->getOwnerId());
        $this->assertSame($ownerEmail, $share->getOwnerEmail());
        $this->assertSame($ownerDisplayName, $share->getOwnerDisplayName());
        $this->assertSame($folderId, $share->getFolderId());
        $this->assertSame($folderUuid, $share->getFolderUuid());
        $this->assertSame($folderPath, $share->getFolderPath());
        $this->assertSame($defaultView, $share->getDefaultView());
        $this->assertSame($rights, $share->getRights());
        $this->assertSame($granteeType, $share->getGranteeType());
        $this->assertSame($granteeId, $share->getGranteeId());
        $this->assertSame($granteeName, $share->getGranteeName());
        $this->assertSame($granteeDisplayName, $share->getGranteeDisplayName());
        $this->assertSame($mountpointId, $share->getMountpointId());

        $xml = <<<EOT
<?xml version="1.0"?>
<share ownerId="$ownerId" ownerEmail="$ownerEmail" ownerName="$ownerDisplayName" folderId="$folderId" folderUuid="$folderUuid" folderPath="$folderPath" view="$defaultView" rights="$rights" granteeType="$granteeType" granteeId="$granteeId" granteeName="$granteeName" granteeDisplayName="$granteeDisplayName" mid="$mountpointId" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($share, 'xml'));
        $this->assertEquals($share, $this->serializer->deserialize($xml, ShareInfo::class, 'xml'));

        $json = json_encode([
            'ownerId' => $ownerId,
            'ownerEmail' => $ownerEmail,
            'ownerName' => $ownerDisplayName,
            'folderId' => $folderId,
            'folderUuid' => $folderUuid,
            'folderPath' => $folderPath,
            'view' => $defaultView,
            'rights' => $rights,
            'granteeType' => $granteeType,
            'granteeId' => $granteeId,
            'granteeName' => $granteeName,
            'granteeDisplayName' => $granteeDisplayName,
            'mid' => $mountpointId,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($share, 'json'));
        $this->assertEquals($share, $this->serializer->deserialize($json, ShareInfo::class, 'json'));
    }
}
