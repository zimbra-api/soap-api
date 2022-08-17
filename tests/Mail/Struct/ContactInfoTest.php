<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\MemberType;
use Zimbra\Common\Struct\ContactAttr;
use Zimbra\Mail\Struct\ContactGroupMember;
use Zimbra\Mail\Struct\ContactInfo;
use Zimbra\Mail\Struct\MailCustomMetadata;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ContactInfo.
 */
class ContactInfoTest extends ZimbraTestCase
{
    public function testContactInfo()
    {
        $sortField = $this->faker->word;
        $id = $this->faker->uuid;
        $imapUid = $this->faker->randomNumber;
        $folder = $this->faker->word;
        $flags = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;
        $changeDate = $this->faker->randomNumber;
        $modifiedSequenceId = $this->faker->randomNumber;
        $date = $this->faker->randomNumber;
        $revisionId = $this->faker->randomNumber;
        $fileAs = $this->faker->word;
        $email = $this->faker->email;
        $email2 = $this->faker->email;
        $email3 = $this->faker->email;
        $type = $this->faker->word;
        $dlist = $this->faker->word;
        $reference = $this->faker->word;
        $memberOf = $this->faker->word;

        $section = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $part = $this->faker->word;
        $contentType = $this->faker->word;
        $size = $this->faker->randomNumber;
        $contentFilename = $this->faker->word;

        $meta = new MailCustomMetadata($section);
        $attr = new ContactAttr($key, $value, $part, $contentType, $size, $contentFilename);
        $member = new ContactGroupMember(MemberType::CONTACT(), $value);

        $contact = new StubContactInfo(
            $id, $sortField, TRUE, $imapUid, $folder, $flags, $tags, $tagNames, $changeDate, $modifiedSequenceId, $date, $revisionId, $fileAs, $email, $email2, $email3, $type, $dlist, $reference, FALSE, [$meta], [$attr], [$member], $memberOf
        );
        $this->assertSame($sortField, $contact->getSortField());
        $this->assertTrue($contact->getCanExpand());
        $this->assertSame($id, $contact->getId());
        $this->assertSame($imapUid, $contact->getImapUid());
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
        $this->assertSame($memberOf, $contact->getMemberOf());

        $contact = new StubContactInfo();
        $contact->setSortField($sortField)
            ->setCanExpand(FALSE)
            ->setId($id)
            ->setImapUid($imapUid)
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
            ->setMemberOf($memberOf);
        $this->assertSame($sortField, $contact->getSortField());
        $this->assertFalse($contact->getCanExpand());
        $this->assertSame($id, $contact->getId());
        $this->assertSame($imapUid, $contact->getImapUid());
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
        $this->assertSame($memberOf, $contact->getMemberOf());

        $contact = new StubContactInfo(
            $id, $sortField, TRUE, $imapUid, $folder, $flags, $tags, $tagNames, $changeDate, $modifiedSequenceId, $date, $revisionId, $fileAs, $email, $email2, $email3, $type, $dlist, $reference, FALSE, [$meta], [$attr], [$member], $memberOf
        );

        $xml = <<<EOT
<?xml version="1.0"?>
<result sf="$sortField" exp="true" id="$id" i4uid="$imapUid" l="$folder" f="$flags" t="$tags" tn="$tagNames" md="$changeDate" ms="$modifiedSequenceId" d="$date" rev="$revisionId" fileAsStr="$fileAs" email="$email" email2="$email2" email3="$email3" type="$type" dlist="$dlist" ref="$reference" tooManyMembers="false" xmlns:urn="urn:zimbraMail">
    <urn:meta section="$section" />
    <urn:a n="$key" part="$part" ct="$contentType" s="$size" filename="$contentFilename">$value</urn:a>
    <urn:m type="C" value="$value" />
    <urn:memberOf>$memberOf</urn:memberOf>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($contact, 'xml'));
        $this->assertEquals($contact, $this->serializer->deserialize($xml, StubContactInfo::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
#[XmlNamespace(uri: 'urn:zimbraMail', prefix: "urn")]
class StubContactInfo extends ContactInfo
{
}
