<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\MemberType;
use Zimbra\Common\Struct\AttributeName;
use Zimbra\Common\Struct\ContactAttr;
use Zimbra\Common\Struct\Id;

use Zimbra\Mail\Message\GetContactsEnvelope;
use Zimbra\Mail\Message\GetContactsBody;
use Zimbra\Mail\Message\GetContactsRequest;
use Zimbra\Mail\Message\GetContactsResponse;

use Zimbra\Mail\Struct\ContactGroupMember;
use Zimbra\Mail\Struct\ContactInfo;
use Zimbra\Mail\Struct\MailCustomMetadata;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetContacts.
 */
class GetContactsTest extends ZimbraTestCase
{
    public function testGetContacts()
    {
        $folderId = $this->faker->uuid;
        $sortBy = $this->faker->word;
        $maxMembers = $this->faker->randomNumber;

        $section = $this->faker->word;
        $key = $this->faker->word;
        $name = $this->faker->word;
        $value = $this->faker->word;

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

        $part = $this->faker->word;
        $contentType = $this->faker->word;
        $size = $this->faker->randomNumber;
        $contentFilename = $this->faker->word;

        $attr = new AttributeName($name);
        $cn = new Id($value);

        $request = new GetContactsRequest(
            FALSE, $folderId, $sortBy, FALSE, FALSE, FALSE, FALSE, FALSE, $maxMembers, [$attr], [$attr], [$cn]
        );
        $this->assertFalse($request->getSync());
        $this->assertSame($folderId, $request->getFolderId());
        $this->assertSame($sortBy, $request->getSortBy());
        $this->assertFalse($request->getDerefGroupMember());
        $this->assertFalse($request->getIncludeMemberOf());
        $this->assertFalse($request->getReturnHiddenAttrs());
        $this->assertFalse($request->getReturnCertInfo());
        $this->assertFalse($request->getWantImapUid());
        $this->assertSame($maxMembers, $request->getMaxMembers());
        $this->assertSame([$attr], $request->getAttributes());
        $this->assertSame([$attr], $request->getMemberAttributes());
        $this->assertSame([$cn], $request->getContacts());
        $request = new GetContactsRequest();
        $request->setSync(TRUE)
            ->setFolderId($folderId)
            ->setSortBy($sortBy)
            ->setDerefGroupMember(TRUE)
            ->setIncludeMemberOf(TRUE)
            ->setReturnHiddenAttrs(TRUE)
            ->setReturnCertInfo(TRUE)
            ->setWantImapUid(TRUE)
            ->setMaxMembers($maxMembers)
            ->setAttributes([$attr])
            ->addAttribute($attr)
            ->setMemberAttributes([$attr])
            ->addMemberAttribute($attr)
            ->setContacts([$cn])
            ->addContact($cn);
        $this->assertTrue($request->getSync());
        $this->assertSame($folderId, $request->getFolderId());
        $this->assertSame($sortBy, $request->getSortBy());
        $this->assertTrue($request->getDerefGroupMember());
        $this->assertTrue($request->getIncludeMemberOf());
        $this->assertTrue($request->getReturnHiddenAttrs());
        $this->assertTrue($request->getReturnCertInfo());
        $this->assertTrue($request->getWantImapUid());
        $this->assertSame($maxMembers, $request->getMaxMembers());
        $this->assertSame([$attr, $attr], $request->getAttributes());
        $this->assertSame([$attr, $attr], $request->getMemberAttributes());
        $this->assertSame([$cn, $cn], $request->getContacts());
        $request->setAttributes([$attr])
            ->setMemberAttributes([$attr])
            ->setContacts([$cn]);

        $meta = new MailCustomMetadata($section);
        $attr = new ContactAttr($key, $value, $part, $contentType, $size, $contentFilename);
        $member = new ContactGroupMember(MemberType::CONTACT(), $value);
        $contact = new ContactInfo(
            $id, $sortField, TRUE, $imapUid, $folder, $flags, $tags, $tagNames, $changeDate, $modifiedSequenceId, $date, $revisionId, $fileAs, $email, $email2, $email3, $type, $dlist, $reference, FALSE, [$meta], [$attr], [$member], $memberOf
        );

        $response = new GetContactsResponse([$contact]);
        $this->assertSame([$contact], $response->getContacts());
        $response = new GetContactsResponse();
        $response->setContacts([$contact]);
        $this->assertSame([$contact], $response->getContacts());

        $body = new GetContactsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetContactsBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetContactsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetContactsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetContactsRequest sync="true" l="$folderId" sortBy="$sortBy" derefGroupMember="true" memberOf="true" returnHiddenAttrs="true" returnCertInfo="true" wantImapUid="true" maxMembers="$maxMembers">
            <urn:a n="$name" />
            <urn:ma n="$name" />
            <urn:cn id="$value" />
        </urn:GetContactsRequest>
        <urn:GetContactsResponse>
            <urn:cn sf="$sortField" exp="true" id="$id" i4uid="$imapUid" l="$folder" f="$flags" t="$tags" tn="$tagNames" md="$changeDate" ms="$modifiedSequenceId" d="$date" rev="$revisionId" fileAsStr="$fileAs" email="$email" email2="$email2" email3="$email3" type="$type" dlist="$dlist" ref="$reference" tooManyMembers="false">
                <urn:meta section="$section" />
                <urn:a n="$key" part="$part" ct="$contentType" s="$size" filename="$contentFilename">$value</urn:a>
                <urn:m type="C" value="$value" />
                <urn:memberOf>$memberOf</urn:memberOf>
            </urn:cn>
        </urn:GetContactsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetContactsEnvelope::class, 'xml'));
    }
}
