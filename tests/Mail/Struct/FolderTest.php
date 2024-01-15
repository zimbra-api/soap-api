<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\{ActionGrantRight, GrantGranteeType};
use Zimbra\Common\Enum\RemoteFolderAccess;
use Zimbra\Common\Enum\Type;
use Zimbra\Common\Enum\ViewType;
use Zimbra\Common\Struct\KeyValuePair;

use Zimbra\Mail\Struct\Acl;
use Zimbra\Mail\Struct\Folder;
use Zimbra\Mail\Struct\Grant;
use Zimbra\Mail\Struct\MailCustomMetadata;
use Zimbra\Mail\Struct\Mountpoint;
use Zimbra\Mail\Struct\Policy;
use Zimbra\Mail\Struct\RetentionPolicy;
use Zimbra\Mail\Struct\SearchFolder;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for Folder.
 */
class FolderTest extends ZimbraTestCase
{
    public function testFolder()
    {
        $id = $this->faker->uuid;
        $uuid = $this->faker->uuid;
        $name = $this->faker->word;
        $absoluteFolderPath = $this->faker->word;
        $parentId = $this->faker->uuid;
        $folderUuid = $this->faker->uuid;
        $flags = $this->faker->word;
        $color = $this->faker->numberBetween(0, 127);
        $rgb = $this->faker->hexcolor;
        $unreadCount = $this->faker->randomNumber;
        $imapUnreadCount = $this->faker->randomNumber;
        $view = ViewType::CONVERSATION();
        $revision = $this->faker->randomNumber;
        $modifiedSequence = $this->faker->randomNumber;
        $changeDate = $this->faker->unixTime;
        $itemCount = $this->faker->randomNumber;
        $imapItemCount = $this->faker->randomNumber;
        $totalSize = $this->faker->randomNumber;
        $imapModifiedSequence = $this->faker->randomNumber;
        $imapUidNext = $this->faker->randomNumber;
        $url = $this->faker->word;
        $webOfflineSyncDays = $this->faker->randomNumber;
        $perm = implode(',', [RemoteFolderAccess::CREATE(), RemoteFolderAccess::READ()]);
        $restUrl = $this->faker->word;
        $lifetime = $this->faker->word;
        $section = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->text;

        $internalGrantExpiry = $this->faker->randomNumber;
        $guestGrantExpiry = $this->faker->randomNumber;

        $grantRight = implode([ActionGrantRight::READ(), ActionGrantRight::WRITE()]);
        $granteeType = GrantGranteeType::USR();
        $granteeId = $this->faker->uuid;
        $expiry = $this->faker->unixTime;
        $granteeName = $this->faker->name;
        $guestPassword = $this->faker->word;
        $accessKey = $this->faker->word;

        $metadata = new MailCustomMetadata($section, [new KeyValuePair($key, $value)]);
        $acl = new Acl(
            $internalGrantExpiry, $guestGrantExpiry, [new Grant(
                $grantRight, $granteeType, $granteeId, $expiry, $granteeName, $guestPassword, $accessKey
            )]
        );
        $retentionPolicy = new RetentionPolicy(
            [new Policy(Type::SYSTEM(), $id, $name, $lifetime)],
            [new Policy(Type::USER(), $id, $name, $lifetime)]
        );
        $subFolder = new Folder($id, $uuid);
        $mountpoint = new Mountpoint($id, $uuid);
        $searchFolder = new SearchFolder($id, $uuid);

        $folder = new StubFolder(
            $id,
            $uuid,
            $name,
            $absoluteFolderPath,
            $parentId,
            $folderUuid,
            $flags,
            $color,
            $rgb,
            $unreadCount,
            $imapUnreadCount,
            $view,
            $revision,
            $modifiedSequence,
            $changeDate,
            $itemCount,
            $imapItemCount,
            $totalSize,
            $imapModifiedSequence,
            $imapUidNext,
            $url,
            FALSE,
            $webOfflineSyncDays,
            $perm,
            FALSE,
            $restUrl,
            FALSE,
            [$metadata],
            $acl,
            [$subFolder],
            [$mountpoint],
            [$searchFolder],
            $retentionPolicy
        );
        $this->assertSame($id, $folder->getId());
        $this->assertSame($uuid, $folder->getUuid());
        $this->assertSame($name, $folder->getName());
        $this->assertSame($absoluteFolderPath, $folder->getAbsoluteFolderPath());
        $this->assertSame($parentId, $folder->getParentId());
        $this->assertSame($folderUuid, $folder->getFolderUuid());
        $this->assertSame($flags, $folder->getFlags());
        $this->assertSame($color, $folder->getColor());
        $this->assertSame($rgb, $folder->getRgb());
        $this->assertSame($unreadCount, $folder->getUnreadCount());
        $this->assertSame($imapUnreadCount, $folder->getImapUnreadCount());
        $this->assertSame($view, $folder->getView());
        $this->assertSame($revision, $folder->getRevision());
        $this->assertSame($modifiedSequence, $folder->getModifiedSequence());
        $this->assertSame($changeDate, $folder->getChangeDate());
        $this->assertSame($itemCount, $folder->getItemCount());
        $this->assertSame($imapItemCount, $folder->getImapItemCount());
        $this->assertSame($totalSize, $folder->getTotalSize());
        $this->assertSame($imapModifiedSequence, $folder->getImapModifiedSequence());
        $this->assertSame($imapUidNext, $folder->getImapUidNext());
        $this->assertSame($url, $folder->getUrl());
        $this->assertFalse($folder->isActiveSyncDisabled());
        $this->assertSame($webOfflineSyncDays, $folder->getWebOfflineSyncDays());
        $this->assertSame($perm, $folder->getPerm());
        $this->assertFalse($folder->getRecursive());
        $this->assertSame($restUrl, $folder->getRestUrl());
        $this->assertFalse($folder->isDeletable());
        $this->assertSame([$metadata], $folder->getMetadatas());
        $this->assertSame($acl, $folder->getAcl());
        $this->assertSame([$subFolder], $folder->getSubfolders());
        $this->assertSame([$mountpoint], $folder->getMountpoints());
        $this->assertSame([$searchFolder], $folder->getSearchFolders());
        $this->assertSame($retentionPolicy, $folder->getRetentionPolicy());

        $folder = new StubFolder();
        $folder->setId($id)
            ->setUuid($uuid)
            ->setName($name)
            ->setAbsoluteFolderPath($absoluteFolderPath)
            ->setParentId($parentId)
            ->setFolderUuid($folderUuid)
            ->setFlags($flags)
            ->setColor($color)
            ->setRgb($rgb)
            ->setUnreadCount($unreadCount)
            ->setImapUnreadCount($imapUnreadCount)
            ->setView($view)
            ->setRevision($revision)
            ->setModifiedSequence($modifiedSequence)
            ->setChangeDate($changeDate)
            ->setItemCount($itemCount)
            ->setImapItemCount($imapItemCount)
            ->setTotalSize($totalSize)
            ->setImapModifiedSequence($imapModifiedSequence)
            ->setImapUidNext($imapUidNext)
            ->setUrl($url)
            ->setActiveSyncDisabled(TRUE)
            ->setWebOfflineSyncDays($webOfflineSyncDays)
            ->setPerm($perm)
            ->setRecursive(TRUE)
            ->setRestUrl($restUrl)
            ->setDeletable(TRUE)
            ->setMetadatas([$metadata])
            ->setAcl($acl)
            ->setSubfolders([$subFolder])
            ->setMountpoints([$mountpoint])
            ->setSearchFolders([$searchFolder])
            ->setRetentionPolicy($retentionPolicy);

        $this->assertSame($id, $folder->getId());
        $this->assertSame($uuid, $folder->getUuid());
        $this->assertSame($name, $folder->getName());
        $this->assertSame($absoluteFolderPath, $folder->getAbsoluteFolderPath());
        $this->assertSame($parentId, $folder->getParentId());
        $this->assertSame($folderUuid, $folder->getFolderUuid());
        $this->assertSame($flags, $folder->getFlags());
        $this->assertSame($color, $folder->getColor());
        $this->assertSame($rgb, $folder->getRgb());
        $this->assertSame($unreadCount, $folder->getUnreadCount());
        $this->assertSame($imapUnreadCount, $folder->getImapUnreadCount());
        $this->assertSame($view, $folder->getView());
        $this->assertSame($revision, $folder->getRevision());
        $this->assertSame($modifiedSequence, $folder->getModifiedSequence());
        $this->assertSame($changeDate, $folder->getChangeDate());
        $this->assertSame($itemCount, $folder->getItemCount());
        $this->assertSame($imapItemCount, $folder->getImapItemCount());
        $this->assertSame($totalSize, $folder->getTotalSize());
        $this->assertSame($imapModifiedSequence, $folder->getImapModifiedSequence());
        $this->assertSame($imapUidNext, $folder->getImapUidNext());
        $this->assertSame($url, $folder->getUrl());
        $this->assertTrue($folder->isActiveSyncDisabled());
        $this->assertSame($webOfflineSyncDays, $folder->getWebOfflineSyncDays());
        $this->assertSame($perm, $folder->getPerm());
        $this->assertTrue($folder->getRecursive());
        $this->assertSame($restUrl, $folder->getRestUrl());
        $this->assertTrue($folder->isDeletable());
        $this->assertSame([$metadata], $folder->getMetadatas());
        $this->assertSame($acl, $folder->getAcl());
        $this->assertSame([$subFolder], $folder->getSubfolders());
        $this->assertSame([$mountpoint], $folder->getMountpoints());
        $this->assertSame([$searchFolder], $folder->getSearchFolders());
        $this->assertSame($retentionPolicy, $folder->getRetentionPolicy());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" uuid="$uuid" name="$name" absFolderPath="$absoluteFolderPath" l="$parentId" luuid="$folderUuid" f="$flags" color="$color" rgb="$rgb" u="$unreadCount" i4u="$imapUnreadCount" view="conversation" rev="$revision" ms="$modifiedSequence" md="$changeDate" n="$itemCount" i4n="$imapItemCount" s="$totalSize" i4ms="$imapModifiedSequence" i4next="$imapUidNext" url="$url" activesyncdisabled="true" webOfflineSyncDays="$webOfflineSyncDays" perm="$perm" recursive="true" rest="$restUrl" deletable="true" xmlns:urn="urn:zimbraMail">
    <urn:meta section="$section">
        <urn:a n="$key">$value</urn:a>
    </urn:meta>
    <urn:acl internalGrantExpiry="$internalGrantExpiry" guestGrantExpiry="$guestGrantExpiry">
        <urn:grant perm="$grantRight" gt="usr" zid="$granteeId" expiry="$expiry" d="$granteeName" pw="$guestPassword" key="$accessKey" />
    </urn:acl>
    <urn:folder id="$id" uuid="$uuid" />
    <urn:link id="$id" uuid="$uuid" />
    <urn:search id="$id" uuid="$uuid" />
    <urn:retentionPolicy>
        <urn:keep>
            <urn:policy type="system" id="$id" name="$name" lifetime="$lifetime" />
        </urn:keep>
        <urn:purge>
            <urn:policy type="user" id="$id" name="$name" lifetime="$lifetime" />
        </urn:purge>
    </urn:retentionPolicy>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($folder, 'xml'));
        $this->assertEquals($folder, $this->serializer->deserialize($xml, StubFolder::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
#[XmlNamespace(uri: 'urn:zimbraMail', prefix: "urn")]
class StubFolder extends Folder
{
}
