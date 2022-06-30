<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\MemberType;

use Zimbra\Mail\Message\CreateContactEnvelope;
use Zimbra\Mail\Message\CreateContactBody;
use Zimbra\Mail\Message\CreateContactRequest;
use Zimbra\Mail\Message\CreateContactResponse;

use Zimbra\Mail\Struct\VCardInfo;
use Zimbra\Mail\Struct\ContactSpec;
use Zimbra\Mail\Struct\NewContactGroupMember;
use Zimbra\Mail\Struct\NewContactAttr;

use Zimbra\Mail\Struct\MailCustomMetadata;
use Zimbra\Mail\Struct\ContactInfo;
use Zimbra\Mail\Struct\ContactGroupMember;
use Zimbra\Common\Struct\ContactAttr;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CreateContact.
 */
class CreateContactTest extends ZimbraTestCase
{
    public function testCreateContact()
    {
        $id = $this->faker->randomNumber;
        $folder = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;
        $section = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->text;
        $part = $this->faker->word;
        $name = $this->faker->word;
        $messageId = $this->faker->uuid;
        $attachId = $this->faker->uuid;

        $contactSpec = new ContactSpec(
            $id, $folder, $tags, $tagNames,
            new VCardInfo($messageId, $part, $attachId, $value),
            [new NewContactAttr($name, $attachId, $id, $part, $value)],
            [new NewContactGroupMember(MemberType::CONTACT(), $value)]
        );
        $request = new CreateContactRequest($contactSpec, FALSE, FALSE, FALSE);
        $this->assertSame($contactSpec, $request->getContact());
        $this->assertFalse($request->getVerbose());
        $this->assertFalse($request->getWantImapUid());
        $this->assertFalse($request->getWantModifiedSequence());
        $request = new CreateContactRequest(new ContactSpec());
        $request->setContact($contactSpec)
            ->setVerbose(TRUE)
            ->setWantImapUid(TRUE)
            ->setWantModifiedSequence(TRUE);
        $this->assertSame($contactSpec, $request->getContact());
        $this->assertTrue($request->getVerbose());
        $this->assertTrue($request->getWantImapUid());
        $this->assertTrue($request->getWantModifiedSequence());

        $sortField = $this->faker->word;
        $uuid = $this->faker->uuid;
        $imapUid = $this->faker->randomNumber;
        $flags = $this->faker->word;
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

        $contentType = $this->faker->word;
        $size = $this->faker->randomNumber;
        $contentFilename = $this->faker->word;

        $contactInfo = new ContactInfo(
            $uuid, $sortField, TRUE, $imapUid, $folder, $flags, $tags, $tagNames, $changeDate,
            $modifiedSequenceId, $date, $revisionId, $fileAs, $email, $email2, $email3, $type, $dlist, $reference, FALSE,
            [new MailCustomMetadata($section)],
            [new ContactAttr($key, $value, $part, $contentType, $size, $contentFilename)],
            [new ContactGroupMember(MemberType::CONTACT(), $value)],
            $memberOf
        );
        $response = new CreateContactResponse($contactInfo);
        $this->assertSame($contactInfo, $response->getContact());
        $response = new CreateContactResponse();
        $response->setContact($contactInfo);
        $this->assertSame($contactInfo, $response->getContact());

        $body = new CreateContactBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new CreateContactBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CreateContactEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new CreateContactEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:CreateContactRequest verbose="true" wantImapUid="true" wantModSeq="true">
            <urn:cn id="$id" l="$folder" t="$tags" tn="$tagNames">
                <urn:vcard mid="$messageId" part="$part" aid="$attachId">$value</urn:vcard>
                <urn:a n="$name" aid="$attachId" id="$id" part="$part">$value</urn:a>
                <urn:m type="C" value="$value" />
            </urn:cn>
        </urn:CreateContactRequest>
        <urn:CreateContactResponse>
            <urn:cn sf="$sortField" exp="true" id="$uuid" i4uid="$imapUid" l="$folder" f="$flags" t="$tags" tn="$tagNames" md="$changeDate" ms="$modifiedSequenceId" d="$date" rev="$revisionId" fileAsStr="$fileAs" email="$email" email2="$email2" email3="$email3" type="$type" dlist="$dlist" ref="$reference" tooManyMembers="false">
                <urn:meta section="$section" />
                <urn:a n="$key" part="$part" ct="$contentType" s="$size" filename="$contentFilename">$value</urn:a>
                <urn:m type="C" value="$value" />
                <urn:memberOf>$memberOf</urn:memberOf>
            </urn:cn>
        </urn:CreateContactResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CreateContactEnvelope::class, 'xml'));
    }
}
