<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\MemberType;
use Zimbra\Common\Enum\ModifyGroupMemberOperation;

use Zimbra\Mail\Message\ModifyContactEnvelope;
use Zimbra\Mail\Message\ModifyContactBody;
use Zimbra\Mail\Message\ModifyContactRequest;
use Zimbra\Mail\Message\ModifyContactResponse;

use Zimbra\Mail\Struct\ModifyContactSpec;
use Zimbra\Mail\Struct\ModifyContactGroupMember;
use Zimbra\Mail\Struct\ModifyContactAttr;

use Zimbra\Mail\Struct\MailCustomMetadata;
use Zimbra\Mail\Struct\ContactInfo;
use Zimbra\Mail\Struct\ContactGroupMember;
use Zimbra\Common\Struct\ContactAttr;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ModifyContact.
 */
class ModifyContactTest extends ZimbraTestCase
{
    public function testModifyContact()
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
        $operation = $this->faker->word;

        $contactSpec = new ModifyContactSpec(
            $id, $tagNames,
            [new ModifyContactAttr($name, $operation, $attachId, $id, $part, $value)],
            [new ModifyContactGroupMember(
                ModifyGroupMemberOperation::ADD(), MemberType::CONTACT(), $value
            )]
        );
        $request = new ModifyContactRequest($contactSpec, FALSE, FALSE, FALSE, FALSE);
        $this->assertSame($contactSpec, $request->getContact());
        $this->assertFalse($request->getReplace());
        $this->assertFalse($request->getVerbose());
        $this->assertFalse($request->getWantImapUid());
        $this->assertFalse($request->getWantModifiedSequence());
        $request = new ModifyContactRequest(new ModifyContactSpec());
        $request->setContact($contactSpec)
            ->setReplace(TRUE)
            ->setVerbose(TRUE)
            ->setWantImapUid(TRUE)
            ->setWantModifiedSequence(TRUE);
        $this->assertSame($contactSpec, $request->getContact());
        $this->assertTrue($request->getReplace());
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
        $response = new ModifyContactResponse($contactInfo);
        $this->assertSame($contactInfo, $response->getContact());
        $response = new ModifyContactResponse();
        $response->setContact($contactInfo);
        $this->assertSame($contactInfo, $response->getContact());

        $body = new ModifyContactBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ModifyContactBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ModifyContactEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new ModifyContactEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ModifyContactRequest replace="true" verbose="true" wantImapUid="true" wantModSeq="true">
            <urn:cn id="$id" tn="$tagNames">
                <urn:a n="$name" op="$operation" aid="$attachId" id="$id" part="$part">$value</urn:a>
                <urn:m op="+" type="C" value="$value" />
            </urn:cn>
        </urn:ModifyContactRequest>
        <urn:ModifyContactResponse>
            <urn:cn sf="$sortField" exp="true" id="$uuid" i4uid="$imapUid" l="$folder" f="$flags" t="$tags" tn="$tagNames" md="$changeDate" ms="$modifiedSequenceId" d="$date" rev="$revisionId" fileAsStr="$fileAs" email="$email" email2="$email2" email3="$email3" type="$type" dlist="$dlist" ref="$reference" tooManyMembers="false">
                <urn:meta section="$section" />
                <urn:a n="$key" part="$part" ct="$contentType" s="$size" filename="$contentFilename">$value</urn:a>
                <urn:m type="C" value="$value" />
                <urn:memberOf>$memberOf</urn:memberOf>
            </urn:cn>
        </urn:ModifyContactResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ModifyContactEnvelope::class, 'xml'));
    }
}
