<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\{ActionGrantRight, GrantGranteeType};
use Zimbra\Common\Struct\KeyValuePair;

use Zimbra\Mail\Struct\Acl;
use Zimbra\Mail\Struct\Grant;
use Zimbra\Mail\Struct\CommonDocumentInfo;
use Zimbra\Mail\Struct\MailCustomMetadata;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CommonDocumentInfo.
 */
class CommonDocumentInfoTest extends ZimbraTestCase
{
    public function testCommonDocumentInfo()
    {
        $id = $this->faker->uuid;
        $uuid = $this->faker->uuid;
        $name = $this->faker->name;
        $size = $this->faker->randomNumber;
        $date = $this->faker->unixTime;
        $folderId = $this->faker->uuid;
        $folderUuid = $this->faker->uuid;
        $modifiedSequence = $this->faker->unixTime;
        $metadataVersion = $this->faker->randomNumber;
        $changeDate = $this->faker->unixTime;
        $revision = $this->faker->randomNumber;
        $flags = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;
        $description = $this->faker->word;
        $contentType = $this->faker->mimeType;
        $version = $this->faker->randomNumber;
        $lastEditedBy = $this->faker->name;
        $creator = $this->faker->name;
        $createdDate = $this->faker->unixTime;
        $fragment = $this->faker->word;

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

        $doc = new StubCommonDocumentInfo(
            $id, $uuid, $name, $size, $date, $folderId, $folderUuid, $modifiedSequence, $metadataVersion, $changeDate, $revision, $flags, $tags, $tagNames, $description, $contentType, FALSE, $version, $lastEditedBy, $creator, $createdDate, [$metadata], $fragment, $acl
        );
        $this->assertSame($id, $doc->getId());
        $this->assertSame($uuid, $doc->getUuid());
        $this->assertSame($name, $doc->getName());
        $this->assertSame($size, $doc->getSize());
        $this->assertSame($date, $doc->getDate());
        $this->assertSame($folderId, $doc->getFolderId());
        $this->assertSame($folderUuid, $doc->getFolderUuid());
        $this->assertSame($modifiedSequence, $doc->getModifiedSequence());
        $this->assertSame($metadataVersion, $doc->getMetadataVersion());
        $this->assertSame($changeDate, $doc->getChangeDate());
        $this->assertSame($revision, $doc->getRevision());
        $this->assertSame($flags, $doc->getFlags());
        $this->assertSame($tags, $doc->getTags());
        $this->assertSame($tagNames, $doc->getTagNames());
        $this->assertSame($description, $doc->getDescription());
        $this->assertSame($contentType, $doc->getContentType());
        $this->assertFalse($doc->getDescEnabled());
        $this->assertSame($version, $doc->getVersion());
        $this->assertSame($lastEditedBy, $doc->getLastEditedBy());
        $this->assertSame($creator, $doc->getCreator());
        $this->assertSame($createdDate, $doc->getCreatedDate());
        $this->assertSame([$metadata], $doc->getMetadatas());
        $this->assertSame($fragment, $doc->getFragment());
        $this->assertSame($acl, $doc->getAcl());

        $doc = new StubCommonDocumentInfo();
        $doc->setId($id)
            ->setUuid($uuid)
            ->setName($name)
            ->setSize($size)
            ->setDate($date)
            ->setFolderId($folderId)
            ->setFolderUuid($folderUuid)
            ->setModifiedSequence($modifiedSequence)
            ->setMetadataVersion($metadataVersion)
            ->setChangeDate($changeDate)
            ->setRevision($revision)
            ->setFlags($flags)
            ->setTags($tags)
            ->setTagNames($tagNames)
            ->setDescription($description)
            ->setContentType($contentType)
            ->setDescEnabled(TRUE)
            ->setVersion($version)
            ->setLastEditedBy($lastEditedBy)
            ->setCreator($creator)
            ->setCreatedDate($createdDate)
            ->setMetadatas([$metadata])
            ->setFragment($fragment)
            ->setAcl($acl);
        $this->assertSame($id, $doc->getId());
        $this->assertSame($uuid, $doc->getUuid());
        $this->assertSame($name, $doc->getName());
        $this->assertSame($size, $doc->getSize());
        $this->assertSame($date, $doc->getDate());
        $this->assertSame($folderId, $doc->getFolderId());
        $this->assertSame($folderUuid, $doc->getFolderUuid());
        $this->assertSame($modifiedSequence, $doc->getModifiedSequence());
        $this->assertSame($metadataVersion, $doc->getMetadataVersion());
        $this->assertSame($changeDate, $doc->getChangeDate());
        $this->assertSame($revision, $doc->getRevision());
        $this->assertSame($flags, $doc->getFlags());
        $this->assertSame($tags, $doc->getTags());
        $this->assertSame($tagNames, $doc->getTagNames());
        $this->assertSame($description, $doc->getDescription());
        $this->assertSame($contentType, $doc->getContentType());
        $this->assertTrue($doc->getDescEnabled());
        $this->assertSame($version, $doc->getVersion());
        $this->assertSame($lastEditedBy, $doc->getLastEditedBy());
        $this->assertSame($creator, $doc->getCreator());
        $this->assertSame($createdDate, $doc->getCreatedDate());
        $this->assertSame([$metadata], $doc->getMetadatas());
        $this->assertSame($fragment, $doc->getFragment());
        $this->assertSame($acl, $doc->getAcl());
        $doc = new StubCommonDocumentInfo(
            $id, $uuid, $name, $size, $date, $folderId, $folderUuid, $modifiedSequence, $metadataVersion, $changeDate, $revision, $flags, $tags, $tagNames, $description, $contentType, TRUE, $version, $lastEditedBy, $creator, $createdDate, [$metadata], $fragment, $acl
        );

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" uuid="$uuid" name="$name" s="$size" d="$date" l="$folderId" luuid="$folderUuid" ms="$modifiedSequence" mdver="$metadataVersion" md="$changeDate" rev="$revision" f="$flags" t="$tags" tn="$tagNames" desc="$description" ct="$contentType" descEnabled="true" ver="$version" leb="$lastEditedBy" cr="$creator" cd="$createdDate" xmlns:urn="urn:zimbraMail">
    <urn:meta section="$section">
        <urn:a n="$key">$value</urn:a>
    </urn:meta>
    <urn:fr>$fragment</urn:fr>
    <urn:acl internalGrantExpiry="$internalGrantExpiry" guestGrantExpiry="$guestGrantExpiry">
        <urn:grant perm="$grantRight" gt="usr" zid="$granteeId" expiry="$expiry" d="$granteeName" pw="$guestPassword" key="$accessKey" />
    </urn:acl>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($doc, 'xml'));
        $this->assertEquals($doc, $this->serializer->deserialize($xml, StubCommonDocumentInfo::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
#[XmlNamespace(uri: 'urn:zimbraMail', prefix: "urn")]
class StubCommonDocumentInfo extends CommonDocumentInfo
{
}
