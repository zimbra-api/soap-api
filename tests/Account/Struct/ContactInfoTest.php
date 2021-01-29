<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Account\Struct\AccountCustomMetadata;
use Zimbra\Account\Struct\ContactInfo;
use Zimbra\Account\Struct\ContactGroupMember;
use Zimbra\Struct\ContactAttr;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ContactInfo.
 */
class ContactInfoTest extends ZimbraTestCase
{
    public function testContactInfo()
    {
        $sortField = $this->faker->word;
        $id = $this->faker->word;
        $folder = $this->faker->word;
        $flags = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;
        $changeDate = mt_rand(1, 99);
        $modifiedSequenceId = mt_rand(1, 99);
        $date = mt_rand(1, 99);
        $revisionId = mt_rand(1, 99);
        $fileAs = $this->faker->word;
        $email = $this->faker->word;
        $email2 = $this->faker->word;
        $email3 = $this->faker->word;
        $type = $this->faker->word;
        $dlist = $this->faker->word;
        $reference = $this->faker->word;

        $section = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $part = $this->faker->word;
        $contentType = $this->faker->word;
        $size = mt_rand(1, 99);
        $contentFilename = $this->faker->word;

        $meta = new AccountCustomMetadata($section);
        $attr = new ContactAttr($key, $value, $part, $contentType, $size, $contentFilename);
        $member = new ContactGroupMember($type, $value);

        $contact = new ContactInfo(
            $sortField, TRUE, $id, $folder, $flags, $tags, $tagNames, $changeDate, $modifiedSequenceId, $date, $revisionId, $fileAs, $email, $email2, $email3, $type, $dlist, $reference, FALSE, [$meta], [$attr], [$member], TRUE, FALSE
        );
        $this->assertSame($sortField, $contact->getSortField());
        $this->assertTrue($contact->getCanExpand());
        $this->assertSame($id, $contact->getId());
        $this->assertSame($folder, $contact->getFolder());
        $this->assertSame($flags, $contact->getFlags());
        $this->assertSame($tags, $contact->getTags());
        $this->assertSame($tagNames, $contact->getTagNames());
        $this->assertSame($changeDate, $contact->getChangeDate());
        $this->assertSame($modifiedSequenceId, $contact->getModifiedSequenceId());
        $this->assertSame($date, $contact->getDate());
        $this->assertSame($revisionId, $contact->getRevisionId());
        $this->assertSame($fileAs, $contact->getFileAs());
        $this->assertSame($email, $contact->getEmail());
        $this->assertSame($email2, $contact->getEmail2());
        $this->assertSame($email3, $contact->getEmail3());
        $this->assertSame($type, $contact->getType());
        $this->assertSame($dlist, $contact->getDlist());
        $this->assertSame($reference, $contact->getReference());
        $this->assertFalse($contact->getTooManyMembers());
        $this->assertSame([$meta], $contact->getMetadatas());
        $this->assertSame([$attr], $contact->getAttrs());
        $this->assertSame([$member], $contact->getContactGroupMembers());
        $this->assertTrue($contact->isOwner());
        $this->assertFalse($contact->isMember());

        $contact = new ContactInfo();
        $contact->setSortField($sortField)
            ->setCanExpand(FALSE)
            ->setId($id)
            ->setFolder($folder)
            ->setFlags($flags)
            ->setTags($tags)
            ->setTagNames($tagNames)
            ->setChangeDate($changeDate)
            ->setModifiedSequenceId($modifiedSequenceId)
            ->setDate($date)
            ->setRevisionId($revisionId)
            ->setFileAs($fileAs)
            ->setEmail($email)
            ->setEmail2($email2)
            ->setEmail3($email3)
            ->setType($type)
            ->setDlist($dlist)
            ->setReference($reference)
            ->setTooManyMembers(TRUE)
            ->setMetadatas([$meta])
            ->setAttrs([$attr])
            ->setContactGroupMembers([$member])
            ->setIsOwner(FALSE)
            ->setIsMember(TRUE);
        $this->assertSame($sortField, $contact->getSortField());
        $this->assertFalse($contact->getCanExpand());
        $this->assertSame($id, $contact->getId());
        $this->assertSame($folder, $contact->getFolder());
        $this->assertSame($flags, $contact->getFlags());
        $this->assertSame($tags, $contact->getTags());
        $this->assertSame($tagNames, $contact->getTagNames());
        $this->assertSame($changeDate, $contact->getChangeDate());
        $this->assertSame($modifiedSequenceId, $contact->getModifiedSequenceId());
        $this->assertSame($date, $contact->getDate());
        $this->assertSame($revisionId, $contact->getRevisionId());
        $this->assertSame($fileAs, $contact->getFileAs());
        $this->assertSame($email, $contact->getEmail());
        $this->assertSame($email2, $contact->getEmail2());
        $this->assertSame($email3, $contact->getEmail3());
        $this->assertSame($type, $contact->getType());
        $this->assertSame($dlist, $contact->getDlist());
        $this->assertSame($reference, $contact->getReference());
        $this->assertTrue($contact->getTooManyMembers());
        $this->assertSame([$meta], $contact->getMetadatas());
        $this->assertSame([$attr], $contact->getAttrs());
        $this->assertSame([$member], $contact->getContactGroupMembers());
        $this->assertFalse($contact->isOwner());
        $this->assertTrue($contact->isMember());

        $contact->addMetadata($meta)
            ->addAttr($attr)
            ->addContactGroupMember($member);
        $this->assertSame([$meta, $meta], $contact->getMetadatas());
        $this->assertSame([$attr, $attr], $contact->getAttrs());
        $this->assertSame([$member, $member], $contact->getContactGroupMembers());

        $contact = new ContactInfo(
            $sortField, TRUE, $id, $folder, $flags, $tags, $tagNames, $changeDate, $modifiedSequenceId, $date, $revisionId, $fileAs, $email, $email2, $email3, $type, $dlist, $reference, FALSE, [$meta], [$attr], [$member], TRUE, FALSE
        );

        $xml = <<<EOT
<?xml version="1.0"?>
<cn sf="$sortField" exp="true" id="$id" l="$folder" f="$flags" t="$tags" tn="$tagNames" md="$changeDate" ms="$modifiedSequenceId" d="$date" rev="$revisionId" fileAsStr="$fileAs" email="$email" email2="$email2" email3="$email3" type="$type" dlist="$dlist" ref="$reference" tooManyMembers="false" isOwner="true" isMember="false">
    <meta section="$section" />
    <a n="$key" part="$part" ct="$contentType" s="$size" filename="$contentFilename">$value</a>
    <m type="$type" value="$value" />
</cn>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($contact, 'xml'));
        $this->assertEquals($contact, $this->serializer->deserialize($xml, ContactInfo::class, 'xml'));

        $json = json_encode([
            'sf' => $sortField,
            'exp' => TRUE,
            'id' => $id,
            'l' => $folder,
            'f' => $flags,
            't' => $tags,
            'tn' => $tagNames,
            'md' => $changeDate,
            'ms' => $modifiedSequenceId,
            'd' => $date,
            'rev' => $revisionId,
            'fileAsStr' => $fileAs,
            'email' => $email,
            'email2' => $email2,
            'email3' => $email3,
            'type' => $type,
            'dlist' => $dlist,
            'ref' => $reference,
            'tooManyMembers' => FALSE,
            'meta' => [
                [
                    'section' => $section,
                ]
            ],
            'a' => [
                [
                    'n' => $key,
                    '_content' => $value,
                    'part' => $part,
                    'ct' => $contentType,
                    's' => $size,
                    'filename' => $contentFilename,
                ],
            ],
            'm' => [
                [
                    'type' => $type,
                    'value' => $value,
                ]
            ],
            'isOwner' => TRUE,
            'isMember' => FALSE,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($contact, 'json'));
        $this->assertEquals($contact, $this->serializer->deserialize($json, ContactInfo::class, 'json'));
    }
}
