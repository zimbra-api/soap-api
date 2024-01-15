<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\{ActionGrantRight, GrantGranteeType};
use Zimbra\Common\Enum\RemoteFolderAccess;
use Zimbra\Common\Enum\Type;
use Zimbra\Common\Enum\ViewType;
use Zimbra\Common\Struct\KeyValuePair;

use Zimbra\Mail\Message\GetFolderEnvelope;
use Zimbra\Mail\Message\GetFolderBody;
use Zimbra\Mail\Message\GetFolderRequest;
use Zimbra\Mail\Message\GetFolderResponse;

use Zimbra\Mail\Struct\Acl;
use Zimbra\Mail\Struct\Folder;
use Zimbra\Mail\Struct\Grant;
use Zimbra\Mail\Struct\MailCustomMetadata;
use Zimbra\Mail\Struct\Mountpoint;
use Zimbra\Mail\Struct\Policy;
use Zimbra\Mail\Struct\RetentionPolicy;
use Zimbra\Mail\Struct\SearchFolder;
use Zimbra\Mail\Struct\GetFolderSpec;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetFolder.
 */
class GetFolderTest extends ZimbraTestCase
{
    public function testGetFolder()
    {
        $folderId = $this->faker->uuid;
        $path = $this->faker->word;
        $viewConstraint = $this->faker->word;
        $treeDepth = $this->faker->randomNumber;

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
        $view = ViewType::CONVERSATION;
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
        $accessKey = $this->faker->word;

        $folder = new GetFolderSpec($uuid, $folderId, $path);
        $request = new GetFolderRequest(
            $folder, FALSE, FALSE, $viewConstraint, $treeDepth, FALSE
        );
        $this->assertSame($folder, $request->getFolder());
        $this->assertFalse($request->isVisible());
        $this->assertFalse($request->isNeedGranteeName());
        $this->assertSame($viewConstraint, $request->getViewConstraint());
        $this->assertSame($treeDepth, $request->getTreeDepth());
        $this->assertFalse($request->isTraverseMountpoints());
        $request = new GetFolderRequest();
        $request->setFolder($folder)
            ->setVisible(TRUE)
            ->setNeedGranteeName(TRUE)
            ->setViewConstraint($viewConstraint)
            ->setTreeDepth($treeDepth)
            ->setTraverseMountpoints(TRUE);
        $this->assertSame($folder, $request->getFolder());
        $this->assertTrue($request->isVisible());
        $this->assertTrue($request->isNeedGranteeName());
        $this->assertSame($viewConstraint, $request->getViewConstraint());
        $this->assertSame($treeDepth, $request->getTreeDepth());
        $this->assertTrue($request->isTraverseMountpoints());

        $metadata = new MailCustomMetadata($section, [new KeyValuePair($key, $value)]);
        $acl = new Acl(
            $internalGrantExpiry, $guestGrantExpiry, [new Grant(
                $grantRight, $granteeType, $granteeId, $expiry, $granteeName, $guestPassword, $accessKey
            )]
        );
        $retentionPolicy = new RetentionPolicy(
            [new Policy(Type::SYSTEM, $id, $name, $lifetime)],
            [new Policy(Type::USER, $id, $name, $lifetime)]
        );
        $subFolder = new Folder($id, $uuid);
        $mountpoint = new Mountpoint($id, $uuid);
        $searchFolder = new SearchFolder($id, $uuid);

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
            [$metadata],
            $acl,
            [$subFolder],
            [$mountpoint],
            [$searchFolder],
            $retentionPolicy
        );
        $response = new GetFolderResponse($mountpoint);
        $this->assertSame($mountpoint, $response->getMountpoint());
        $response = new GetFolderResponse($searchFolder);
        $this->assertSame($searchFolder, $response->getSearchFolder());
        $response = new GetFolderResponse($folder);
        $this->assertSame($folder, $response->getFolder());

        $response = new GetFolderResponse();
        $response->setMountpoint($mountpoint)
            ->setSearchFolder($searchFolder)
            ->setFolder($folder);
        $this->assertSame($mountpoint, $response->getMountpoint());
        $this->assertSame($searchFolder, $response->getSearchFolder());
        $this->assertSame($folder, $response->getFolder());
        $response = new GetFolderResponse($folder);

        $body = new GetFolderBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetFolderBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetFolderEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetFolderEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetFolderRequest visible="true" needGranteeName="true" view="$viewConstraint" depth="$treeDepth" tr="true">
            <urn:folder uuid="$uuid" l="$folderId" path="$path" />
        </urn:GetFolderRequest>
        <urn:GetFolderResponse>
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
        </urn:GetFolderResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetFolderEnvelope::class, 'xml'));
    }
}
