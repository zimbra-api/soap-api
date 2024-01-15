<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\{
    ActionGrantRight, GranteeType, GrantGranteeType, ItemType, RemoteFolderAccess, SearchSortBy, ViewType, Type
};
use Zimbra\Common\Struct\KeyValuePair;

use Zimbra\Mail\Message\CreateFolderEnvelope;
use Zimbra\Mail\Message\CreateFolderBody;
use Zimbra\Mail\Message\CreateFolderRequest;
use Zimbra\Mail\Message\CreateFolderResponse;

use Zimbra\Mail\Struct\NewFolderSpec;
use Zimbra\Mail\Struct\ActionGrantSelector;
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
 * Testcase class for CreateFolder.
 */
class CreateFolderTest extends ZimbraTestCase
{
    public function testCreateFolder()
    {
        $id = $this->faker->uuid;
        $uuid = $this->faker->uuid;
        $name = $this->faker->word;
        $parentFolderId = $this->faker->uuid;
        $defaultView = ViewType::CONVERSATION;
        $flags = $this->faker->word;
        $color = $this->faker->numberBetween(0, 127);
        $rgb = $this->faker->hexcolor;

        $rights = implode([ActionGrantRight::READ->value, ActionGrantRight::WRITE->value]);
        $grantType = GranteeType::USR;
        $zimbraId = $this->faker->uuid;
        $displayName = $this->faker->name;
        $args = $this->faker->word;
        $password = $this->faker->word;
        $accessKey = $this->faker->word;

        $absoluteFolderPath = $this->faker->word;
        $parentId = $this->faker->uuid;
        $folderUuid = $this->faker->uuid;
        $unreadCount =  $this->faker->randomNumber;
        $imapUnreadCount =  $this->faker->randomNumber;
        $view = ViewType::CONVERSATION;
        $revision =  $this->faker->randomNumber;
        $modifiedSequence =  $this->faker->randomNumber;
        $changeDate =  $this->faker->unixTime;
        $itemCount =  $this->faker->randomNumber;
        $imapItemCount =  $this->faker->randomNumber;
        $totalSize =  $this->faker->randomNumber;
        $imapModifiedSequence =  $this->faker->randomNumber;
        $imapUidNext =  $this->faker->randomNumber;
        $url = $this->faker->word;
        $webOfflineSyncDays =  $this->faker->randomNumber;
        $perm = implode(',', [RemoteFolderAccess::CREATE->value, RemoteFolderAccess::READ->value]);
        $restUrl = $this->faker->word;
        $lifetime = $this->faker->word;
        $section = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->text;

        $internalGrantExpiry = $this->faker->randomNumber;
        $guestGrantExpiry = $this->faker->randomNumber;

        $grantRight = implode([ActionGrantRight::READ->value, ActionGrantRight::WRITE->value]);
        $granteeType = GrantGranteeType::USR;
        $granteeId = $this->faker->uuid;
        $expiry = $this->faker->unixTime;
        $granteeName = $this->faker->name;
        $guestPassword = $this->faker->word;

        $ownerEmail = $this->faker->email;
        $ownerAccountId = $this->faker->uuid;
        $remoteFolderId = $this->faker->randomNumber;
        $remoteUuid = $this->faker->uuid;
        $remoteFolderName = $this->faker->word;

        $query = $this->faker->word;
        $sortBy = SearchSortBy::DATE_DESC;
        $types = implode(',', [ItemType::MESSAGE->value, ItemType::CONVERSATION->value]);

        $newFolder = new NewFolderSpec(
            $name, $parentFolderId, $defaultView, $flags, $color, $rgb, $url, TRUE, TRUE, [
                new ActionGrantSelector(
                    $rights, $grantType, $zimbraId, $displayName, $args, $password, $accessKey
                )
            ]
        );
        $request = new CreateFolderRequest($newFolder);
        $this->assertSame($newFolder, $request->getFolder());
        $request = new CreateFolderRequest(new NewFolderSpec());
        $request->setFolder($newFolder);
        $this->assertSame($newFolder, $request->getFolder());

        $folder = new Folder(
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
            TRUE,
            $webOfflineSyncDays,
            $perm,
            TRUE,
            $restUrl,
            TRUE,
            [new MailCustomMetadata($section, [new KeyValuePair($key, $value)])],
            new Acl(
                $internalGrantExpiry, $guestGrantExpiry, [new Grant(
                    $grantRight, $granteeType, $granteeId, $expiry, $granteeName, $guestPassword, $accessKey
                )]
            ),
            [new Folder($id, $uuid)],
            [new Mountpoint($id, $uuid)],
            [new SearchFolder($id, $uuid)],
            new RetentionPolicy(
                [new Policy(Type::SYSTEM, $id, $name, $lifetime)],
                [new Policy(Type::USER, $id, $name, $lifetime)]
            )
        );
        $link = new Mountpoint(
            $id, $uuid
        );
        $link->setOwnerEmail($ownerEmail)
            ->setOwnerAccountId($ownerAccountId)
            ->setRemoteFolderId($remoteFolderId)
            ->setRemoteUuid($remoteUuid)
            ->setRemoteFolderName($remoteFolderName)
            ->setReminderEnabled(TRUE)
            ->setBroken(TRUE);
        $search = new SearchFolder(
            $id, $uuid
        );
        $search->setQuery($query)
            ->setSortBy($sortBy)
            ->setTypes($types);

        $response = new CreateFolderResponse($folder);
        $this->assertSame($folder, $response->getFolder());
        $response = new CreateFolderResponse($link);
        $this->assertSame($link, $response->getMountpoint());
        $response = new CreateFolderResponse($search);
        $this->assertSame($search, $response->getSearchFolder());

        $response = new CreateFolderResponse();
        $response->setMountpoint($link)
            ->setSearchFolder($search)
            ->setFolder($folder);
        $this->assertSame($link, $response->getMountpoint());
        $this->assertSame($search, $response->getSearchFolder());
        $this->assertSame($folder, $response->getFolder());
        $response = new CreateFolderResponse($folder);

        $body = new CreateFolderBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new CreateFolderBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CreateFolderEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new CreateFolderEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:CreateFolderRequest>
            <urn:folder name="$name" view="conversation" f="$flags" color="$color" rgb="$rgb" url="$url" l="$parentFolderId" fie="true" sync="true">
                <urn:acl>
                    <urn:grant perm="$rights" gt="usr" zid="$zimbraId" d="$displayName" args="$args" pw="$password" key="$accessKey" />
                </urn:acl>
            </urn:folder>
        </urn:CreateFolderRequest>
        <urn:CreateFolderResponse>
            <urn:folder id="$id" uuid="$uuid" name="$name" absFolderPath="$absoluteFolderPath" l="$parentId" luuid="$folderUuid" f="$flags" color="$color" rgb="$rgb" u="$unreadCount" i4u="$imapUnreadCount" view="conversation" rev="$revision" ms="$modifiedSequence" md="$changeDate" n="$itemCount" i4n="$imapItemCount" s="$totalSize" i4ms="$imapModifiedSequence" i4next="$imapUidNext" url="$url" activesyncdisabled="true" webOfflineSyncDays="$webOfflineSyncDays" perm="$perm" recursive="true" rest="$restUrl" deletable="true">
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
            </urn:folder>
        </urn:CreateFolderResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CreateFolderEnvelope::class, 'xml'));
    }
}
