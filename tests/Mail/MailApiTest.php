<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail;

use Zimbra\Mail\{MailApi, MailApiInterface};
use Zimbra\Common\Soap\ClientInterface;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for account api.
 */
class MailApiTest extends ZimbraTestCase
{
    public function testMailApi()
    {
        $api = $this->createStub(MailApi::class);
        $this->assertInstanceOf(MailApiInterface::class, $api);
    }

    public function testAddAppointmentInvite()
    {
        $calItemId = $this->faker->randomNumber;
        $invId = $this->faker->randomNumber;
        $componentNum = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:AddAppointmentInviteResponse calItemId="$calItemId" invId="$invId" compNum="$componentNum" />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->addAppointmentInvite();
        $this->assertSame($calItemId, $response->getCalItemId());
        $this->assertSame($invId, $response->getInvId());
        $this->assertSame($componentNum, $response->getComponentNum());
    }

    public function testAddComment()
    {
        $id = $this->faker->uuid;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:AddCommentResponse>
            <urn:comment id="$id" />
        </urn:AddCommentResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->addComment(new \Zimbra\Mail\Struct\AddedComment());
        $comment = new \Zimbra\Common\Struct\Id($id);
        $this->assertEquals($comment, $response->getComment());
    }

    public function testAddMsg()
    {
        $id = $this->faker->uuid;
        $autoSendTime = $this->faker->unixTime;
        $subject = $this->faker->text;
        $fragment = $this->faker->text;

        $address = $this->faker->email;
        $display = $this->faker->name;
        $personal = $this->faker->word;
        $addressType = \Zimbra\Common\Enum\AddressType::TO();
        $calItemType = \Zimbra\Common\Enum\InviteType::TASK();

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:AddMsgResponse>
            <urn:chat id="$id" autoSendTime="$autoSendTime">
                <urn:e a="$address" d="$display" p="$personal" t="t" />
                <urn:su>$subject</urn:su>
                <urn:fr>$fragment</urn:fr>
                <urn:inv type="task" />
            </urn:chat>
        </urn:AddMsgResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->addMsg(new \Zimbra\Mail\Struct\AddMsgSpec());

        $email = new \Zimbra\Mail\Struct\EmailInfo($address, $display, $personal, $addressType);
        $invite = new \Zimbra\Mail\Struct\InviteInfo($calItemType);
        $chat = new \Zimbra\Mail\Struct\ChatSummary($id, $autoSendTime, [$email], $subject, $fragment, $invite);

        $this->assertEquals($chat, $response->getChatMessage());
        $this->assertNull($response->getMessage());
    }

    public function testAddTaskInvite()
    {
        $calItemId = $this->faker->randomNumber;
        $invId = $this->faker->randomNumber;
        $componentNum = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:AddTaskInviteResponse calItemId="$calItemId" invId="$invId" compNum="$componentNum" />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->addTaskInvite();
        $this->assertSame($calItemId, $response->getCalItemId());
        $this->assertSame($invId, $response->getInvId());
        $this->assertSame($componentNum, $response->getComponentNum());
    }

    public function testAnnounceOrganizerChange()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:AnnounceOrganizerChangeResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->announceOrganizerChange($this->faker->uuid);
        $this->assertInstanceOf(\Zimbra\Mail\Message\AnnounceOrganizerChangeResponse::class, $response);
    }

    public function testApplyFilterRules()
    {
        $ids = implode(',', [
            $this->faker->uuid,
            $this->faker->uuid,
        ]);

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ApplyFilterRulesResponse>
            <urn:m ids="$ids" />
        </urn:ApplyFilterRulesResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->applyFilterRules();
        $msgIds = new \Zimbra\Mail\Struct\IdsAttr($ids);
        $this->assertEquals($msgIds, $response->getMsgIds());
    }

    public function testApplyOutgoingFilterRules()
    {
        $ids = implode(',', [
            $this->faker->uuid,
            $this->faker->uuid,
        ]);

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ApplyOutgoingFilterRulesResponse>
            <urn:m ids="$ids" />
        </urn:ApplyOutgoingFilterRulesResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->applyOutgoingFilterRules();
        $msgIds = new \Zimbra\Mail\Struct\IdsAttr($ids);
        $this->assertEquals($msgIds, $response->getMsgIds());
    }

    public function testAutoComplete()
    {
        $email = $this->faker->email;
        $matchType = \Zimbra\Common\Enum\AutoCompleteMatchType::GAL();
        $ranking = $this->faker->randomNumber;
        $id = $this->faker->uuid;
        $folder = $this->faker->word;
        $displayName = $this->faker->name;
        $firstName = $this->faker->firstName;
        $middleName = $this->faker->name;
        $lastName = $this->faker->lastName;
        $fullName = $this->faker->name;
        $nickname = $this->faker->name;
        $company = $this->faker->company;
        $fileAs = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:AutoCompleteResponse canBeCached="true">
            <urn:match email="$email" type="gal" ranking="$ranking" isGroup="true" exp="true" id="$id" l="$folder" display="$displayName" first="$firstName" middle="$middleName" last="$lastName" full="$fullName" nick="$nickname" company="$company" fileas="$fileAs" />
        </urn:AutoCompleteResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->autoComplete($this->faker->name);

        $match = new \Zimbra\Mail\Struct\AutoCompleteMatch(
            $email, $matchType, $ranking, TRUE, TRUE, $id, $folder, $displayName, $firstName, $middleName, $lastName, $fullName, $nickname, $company, $fileAs
        );
        $this->assertTrue($response->getCanBeCached());
        $this->assertEquals([$match], $response->getMatches());
    }

    public function testBeginTrackingIMAP()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:BeginTrackingIMAPResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->beginTrackingIMAP();
        $this->assertInstanceOf(\Zimbra\Mail\Message\BeginTrackingIMAPResponse::class, $response);
    }

    public function testBounceMsg()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:BounceMsgResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->bounceMsg(new \Zimbra\Mail\Struct\BounceMsgSpec());
        $this->assertInstanceOf(\Zimbra\Mail\Message\BounceMsgResponse::class, $response);
    }

    public function testBrowse()
    {
        $browseDomainHeader = $this->faker->word;
        $frequency = $this->faker->randomNumber;
        $data = $this->faker->text;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:BrowseResponse>
            <urn:bd h="$browseDomainHeader" freq="$frequency">$data</urn:bd>
        </urn:BrowseResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->browse();
        $browseData = new \Zimbra\Mail\Struct\BrowseData($browseDomainHeader, $frequency, $data);
        $this->assertEquals([$browseData], $response->getBrowseDatas());
    }

    public function testCancelAppointment()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:CancelAppointmentResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->cancelAppointment();
        $this->assertInstanceOf(\Zimbra\Mail\Message\CancelAppointmentResponse::class, $response);
    }

    public function testCancelTask()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:CancelTaskResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->cancelTask();
        $this->assertInstanceOf(\Zimbra\Mail\Message\CancelTaskResponse::class, $response);
    }

    public function testCheckPermission()
    {
        $rightName = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:CheckPermissionResponse allow="true">
            <urn:right allow="true">$rightName</urn:right>
        </urn:CheckPermissionResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $right = new \Zimbra\Mail\Struct\RightPermission(TRUE, $rightName);
        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->checkPermission();
        $this->assertTrue($response->getAllow());
        $this->assertEquals([$right], $response->getRights());
    }

    public function testCheckRecurConflicts()
    {
        $name = $this->faker->email;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:CheckRecurConflictsResponse>
            <urn:inst>
                <urn:usr name="$name" fb="F" />
            </urn:inst>
        </urn:CheckRecurConflictsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->checkRecurConflicts();

        $instance = new \Zimbra\Mail\Struct\ConflictRecurrenceInstance(
            [new \Zimbra\Mail\Struct\FreeBusyUserStatus($name, \Zimbra\Common\Enum\FreeBusyStatus::FREE())]
        );
        $this->assertEquals([$instance], $response->getInstances());
    }

    public function testCheckSpelling()
    {
        $word = $this->faker->word;
        $suggestions = $this->faker->text;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:CheckSpellingResponse available="true">
            <urn:misspelled word="$word" suggestions="$suggestions" />
        </urn:CheckSpellingResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->checkSpelling();

        $missed = new \Zimbra\Mail\Struct\Misspelling($word, $suggestions);
        $this->assertTrue($response->isAvailable());
        $this->assertEquals([$missed], $response->getMisspelledWords());
    }

    public function testCompleteTaskInstance()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:CompleteTaskInstanceResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->completeTaskInstance(new \Zimbra\Mail\Struct\DtTimeInfo(), $this->faker->uuid);
        $this->assertInstanceOf(\Zimbra\Mail\Message\CompleteTaskInstanceResponse::class, $response);
    }

    public function testContactAction()
    {
        $id = $this->faker->uuid;
        $operation = $this->faker->randomElement(\Zimbra\Common\Enum\ContactActionOp::values())->getValue();
        $nonExistentIds = $this->faker->uuid;
        $newlyCreatedIds = $this->faker->uuid;
        $zimbraId = $this->faker->uuid;
        $displayName = $this->faker->name;
        $accessKey = $this->faker->text;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ContactActionResponse>
            <urn:action id="$id" op="$operation" nei="$nonExistentIds" nci="$newlyCreatedIds" zid="$zimbraId" d="$displayName" key="$accessKey" />
        </urn:ContactActionResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->contactAction(new \Zimbra\Mail\Struct\ContactActionSelector());
        $action = new \Zimbra\Mail\Struct\FolderActionResult(
            $id, $operation, $nonExistentIds, $newlyCreatedIds, $zimbraId, $displayName, $accessKey
        );
        $this->assertEquals($action, $response->getAction());
    }

    public function testConvAction()
    {
        $id = $this->faker->uuid;
        $operation = $this->faker->randomElement(\Zimbra\Common\Enum\ConvActionOp::values())->getValue();
        $nonExistentIds = $this->faker->uuid;
        $newlyCreatedIds = $this->faker->uuid;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ConvActionResponse>
            <urn:action id="$id" op="$operation" nei="$nonExistentIds" nci="$newlyCreatedIds" />
        </urn:ConvActionResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->convAction(new \Zimbra\Mail\Struct\ConvActionSelector());
        $action = new \Zimbra\Mail\Struct\ActionResult(
            $id, $operation, $nonExistentIds, $newlyCreatedIds
        );
        $this->assertEquals($action, $response->getAction());
    }

    public function testCounterAppointment()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:CounterAppointmentResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->counterAppointment();
        $this->assertInstanceOf(\Zimbra\Mail\Message\CounterAppointmentResponse::class, $response);
    }

    public function testCreateAppointmentException()
    {
        $id = $this->faker->uuid;
        $modifiedSequence = $this->faker->randomNumber;
        $revision = $this->faker->randomNumber;

        $subject = $this->faker->text;
        $content = $this->faker->text;
        $contentType = $this->faker->word;
        $contentId = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $address = $this->faker->email;
        $personal = $this->faker->word;

        $calItemId = $this->faker->uuid;
        $deprecatedApptId = $this->faker->uuid;
        $calInvId = $this->faker->uuid;

        $part = $this->faker->word;
        $sentDate = $this->faker->unixTime;
        $messageIdHeader = $this->faker->uuid;

        $display = $this->faker->name;
        $addressType = \Zimbra\Common\Enum\AddressType::TO();
        $calItemType = \Zimbra\Common\Enum\InviteType::TASK();

        $size = $this->faker->randomNumber;
        $contentDisposition = $this->faker->word;
        $contentFilename = $this->faker->word;
        $location = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:CreateAppointmentExceptionResponse calItemId="$calItemId" apptId="$deprecatedApptId" invId="$calInvId" ms="$modifiedSequence" rev="$revision">
            <urn:m id="$id" />
            <urn:echo>
                <urn:m id="$id" part="$part" sd="$sentDate">
                    <urn:e a="$address" d="$display" p="$personal" t="t" />
                    <urn:su>$subject</urn:su>
                    <urn:mid>$messageIdHeader</urn:mid>
                    <urn:inv type="task" />
                    <urn:header n="$key">$value</urn:header>
                    <urn:mp part="$part" ct="$contentType" s="$size" cd="$contentDisposition" filename="$contentFilename" ci="$contentId" cl="$location" body="true" truncated="true">
                        <urn:content>$content</urn:content>
                    </urn:mp>
                    <urn:shr truncated="true">
                        <urn:content>$content</urn:content>
                    </urn:shr>
                    <urn:dlSubs truncated="true">
                        <urn:content>$content</urn:content>
                    </urn:dlSubs>
                </urn:m>
            </urn:echo>
        </urn:CreateAppointmentExceptionResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->createAppointmentException();

        $contentElems = [
            new \Zimbra\Mail\Struct\PartInfo(
                $part, $contentType, $size, $contentDisposition, $contentFilename, $contentId, $location, TRUE, TRUE, $content
            ),
            new \Zimbra\Mail\Struct\ShareNotification(TRUE, $content),
            new \Zimbra\Mail\Struct\DLSubscriptionNotification(TRUE, $content),
        ];
        $invite = new \Zimbra\Mail\Struct\InviteAsMP(
            $id, $part, $sentDate,
            [new \Zimbra\Mail\Struct\EmailInfo($address, $display, $personal, $addressType)],
            $subject, $messageIdHeader,
            new \Zimbra\Mail\Struct\MPInviteInfo($calItemType), [new \Zimbra\Common\Struct\KeyValuePair($key, $value)],
            $contentElems
        );
        $msg = new \Zimbra\Common\Struct\Id($id);
        $echo = new \Zimbra\Mail\Struct\CalEcho($invite);

        $this->assertSame($calItemId, $response->getCalItemId());
        $this->assertSame($deprecatedApptId, $response->getDeprecatedApptId());
        $this->assertSame($calInvId, $response->getCalInvId());
        $this->assertSame($modifiedSequence, $response->getModifiedSequence());
        $this->assertSame($revision, $response->getRevision());
        $this->assertEquals($msg, $response->getMsg());
        $this->assertEquals($echo, $response->getEcho());
    }

    public function testCreateAppointment()
    {
        $id = $this->faker->uuid;
        $modifiedSequence = $this->faker->randomNumber;
        $revision = $this->faker->randomNumber;

        $subject = $this->faker->text;
        $content = $this->faker->text;
        $contentType = $this->faker->word;
        $contentId = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $address = $this->faker->email;
        $personal = $this->faker->word;

        $calItemId = $this->faker->uuid;
        $deprecatedApptId = $this->faker->uuid;
        $calInvId = $this->faker->uuid;

        $part = $this->faker->word;
        $sentDate = $this->faker->unixTime;
        $messageIdHeader = $this->faker->uuid;

        $display = $this->faker->name;
        $addressType = \Zimbra\Common\Enum\AddressType::TO();
        $calItemType = \Zimbra\Common\Enum\InviteType::TASK();

        $size = $this->faker->randomNumber;
        $contentDisposition = $this->faker->word;
        $contentFilename = $this->faker->word;
        $location = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:CreateAppointmentResponse calItemId="$calItemId" apptId="$deprecatedApptId" invId="$calInvId" ms="$modifiedSequence" rev="$revision">
            <urn:m id="$id" />
            <urn:echo>
                <urn:m id="$id" part="$part" sd="$sentDate">
                    <urn:e a="$address" d="$display" p="$personal" t="t" />
                    <urn:su>$subject</urn:su>
                    <urn:mid>$messageIdHeader</urn:mid>
                    <urn:inv type="task" />
                    <urn:header n="$key">$value</urn:header>
                    <urn:mp part="$part" ct="$contentType" s="$size" cd="$contentDisposition" filename="$contentFilename" ci="$contentId" cl="$location" body="true" truncated="true">
                        <urn:content>$content</urn:content>
                    </urn:mp>
                    <urn:shr truncated="true">
                        <urn:content>$content</urn:content>
                    </urn:shr>
                    <urn:dlSubs truncated="true">
                        <urn:content>$content</urn:content>
                    </urn:dlSubs>
                </urn:m>
            </urn:echo>
        </urn:CreateAppointmentResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->createAppointment();

        $contentElems = [
            new \Zimbra\Mail\Struct\PartInfo(
                $part, $contentType, $size, $contentDisposition, $contentFilename, $contentId, $location, TRUE, TRUE, $content
            ),
            new \Zimbra\Mail\Struct\ShareNotification(TRUE, $content),
            new \Zimbra\Mail\Struct\DLSubscriptionNotification(TRUE, $content),
        ];
        $invite = new \Zimbra\Mail\Struct\InviteAsMP(
            $id, $part, $sentDate,
            [new \Zimbra\Mail\Struct\EmailInfo($address, $display, $personal, $addressType)],
            $subject, $messageIdHeader,
            new \Zimbra\Mail\Struct\MPInviteInfo($calItemType), [new \Zimbra\Common\Struct\KeyValuePair($key, $value)],
            $contentElems
        );
        $msg = new \Zimbra\Common\Struct\Id($id);
        $echo = new \Zimbra\Mail\Struct\CalEcho($invite);

        $this->assertSame($calItemId, $response->getCalItemId());
        $this->assertSame($deprecatedApptId, $response->getDeprecatedApptId());
        $this->assertSame($calInvId, $response->getCalInvId());
        $this->assertSame($modifiedSequence, $response->getModifiedSequence());
        $this->assertSame($revision, $response->getRevision());
        $this->assertEquals($msg, $response->getMsg());
        $this->assertEquals($echo, $response->getEcho());
    }

    public function testCreateContact()
    {
        $folder = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;
        $section = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->text;
        $part = $this->faker->word;

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

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
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

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->createContact(new \Zimbra\Mail\Struct\ContactSpec());

        $contact = new \Zimbra\Mail\Struct\ContactInfo(
            $uuid, $sortField, TRUE, $imapUid, $folder, $flags, $tags, $tagNames, $changeDate,
            $modifiedSequenceId, $date, $revisionId, $fileAs, $email, $email2, $email3, $type, $dlist, $reference, FALSE,
            [new \Zimbra\Mail\Struct\MailCustomMetadata($section)],
            [new \Zimbra\Common\Struct\ContactAttr($key, $value, $part, $contentType, $size, $contentFilename)],
            [new \Zimbra\Mail\Struct\ContactGroupMember(\Zimbra\Common\Enum\MemberType::CONTACT(), $value)],
            $memberOf
        );
        $this->assertEquals($contact, $response->getContact());
    }

    public function testCreateDataSource()
    {
        $id = $this->faker->uuid;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:CreateDataSourceResponse>
            <urn:imap id="$id" />
        </urn:CreateDataSourceResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->createDataSource(new \Zimbra\Mail\Struct\MailImapDataSource($id));
        $imap = new \Zimbra\Mail\Struct\ImapDataSourceId($id);
        $this->assertEquals($imap, $response->getImapDataSource());
    }

    public function testCreateFolder()
    {
        $id = $this->faker->uuid;
        $uuid = $this->faker->uuid;
        $name = $this->faker->word;
        $flags = $this->faker->word;
        $color = $this->faker->numberBetween(0, 127);
        $rgb = $this->faker->hexcolor;
        $accessKey = $this->faker->word;

        $absoluteFolderPath = $this->faker->word;
        $parentId = $this->faker->uuid;
        $folderUuid = $this->faker->uuid;
        $unreadCount =  $this->faker->randomNumber;
        $imapUnreadCount =  $this->faker->randomNumber;
        $view = \Zimbra\Common\Enum\ViewType::CONVERSATION();
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
        $perm = implode(',', [\Zimbra\Common\Enum\RemoteFolderAccess::CREATE(), \Zimbra\Common\Enum\RemoteFolderAccess::READ()]);
        $restUrl = $this->faker->word;
        $lifetime = $this->faker->word;
        $section = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->text;

        $internalGrantExpiry = $this->faker->randomNumber;
        $guestGrantExpiry = $this->faker->randomNumber;

        $grantRight = implode(',', [\Zimbra\Common\Enum\ActionGrantRight::READ(), \Zimbra\Common\Enum\ActionGrantRight::WRITE()]);
        $granteeType = \Zimbra\Common\Enum\GrantGranteeType::USR();
        $granteeId = $this->faker->uuid;
        $expiry = $this->faker->unixTime;
        $granteeName = $this->faker->name;
        $guestPassword = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
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

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->createFolder(new \Zimbra\Mail\Struct\NewFolderSpec());

        $folder = new \Zimbra\Mail\Struct\Folder(
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
            [new \Zimbra\Mail\Struct\MailCustomMetadata($section, [new \Zimbra\Common\Struct\KeyValuePair($key, $value)])],
            new \Zimbra\Mail\Struct\Acl(
                $internalGrantExpiry, $guestGrantExpiry, [new \Zimbra\Mail\Struct\Grant(
                    $grantRight, $granteeType, $granteeId, $expiry, $granteeName, $guestPassword, $accessKey
                )]
            ),
            [new \Zimbra\Mail\Struct\Folder($id, $uuid)],
            [new \Zimbra\Mail\Struct\Mountpoint($id, $uuid)],
            [new \Zimbra\Mail\Struct\SearchFolder($id, $uuid)],
            new \Zimbra\Mail\Struct\RetentionPolicy(
                [new \Zimbra\Mail\Struct\Policy(\Zimbra\Common\Enum\Type::SYSTEM(), $id, $name, $lifetime)],
                [new \Zimbra\Mail\Struct\Policy(\Zimbra\Common\Enum\Type::USER(), $id, $name, $lifetime)]
            )
        );
        $this->assertEquals($folder, $response->getFolder());
    }

    public function testCreateMountpoint()
    {
        $id = $this->faker->uuid;
        $uuid = $this->faker->uuid;
        $ownerEmail = $this->faker->email;
        $ownerAccountId = $this->faker->uuid;
        $remoteFolderId = $this->faker->randomNumber;
        $remoteUuid = $this->faker->uuid;
        $remoteFolderName = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:CreateMountpointResponse>
            <urn:link id="$id" uuid="$uuid" owner="$ownerEmail" zid="$ownerAccountId" rid="$remoteFolderId" ruuid="$remoteUuid" oname="$remoteFolderName" reminder="true" broken="true" />
        </urn:CreateMountpointResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->createMountpoint(new \Zimbra\Mail\Struct\NewMountpointSpec());

        $link = new \Zimbra\Mail\Struct\Mountpoint(
            $id,
            $uuid,
            $ownerEmail,
            $ownerAccountId,
            $remoteFolderId,
            $remoteUuid,
            $remoteFolderName,
            TRUE,
            TRUE
        );
        $this->assertEquals($link, $response->getMount());
    }

    public function testCreateNote()
    {
        $folder = $this->faker->uuid;
        $content = $this->faker->uuid;
        $id = $this->faker->uuid;
        $revision =  $this->faker->randomNumber;
        $date = $this->faker->randomNumber;
        $flags = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;
        $bounds = $this->faker->word;
        $color = $this->faker->numberBetween(0, 127);
        $rgb = $this->faker->hexcolor;
        $changeDate =  $this->faker->unixTime;
        $modifiedSequence =  $this->faker->randomNumber;
        $section = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->text;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:CreateNoteResponse>
            <urn:note id="$id" rev="$revision" l="$folder" d="$date" f="$flags" t="$tags" tn="$tagNames" pos="$bounds" color="$color" rgb="$rgb" md="$changeDate" ms="$modifiedSequence">
                <urn:content>$content</urn:content>
                <urn:meta section="$section">
                    <urn:a n="$key">$value</urn:a>
                </urn:meta>
            </urn:note>
        </urn:CreateNoteResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->createNote(new \Zimbra\Mail\Struct\NewNoteSpec());

        $metadata = new \Zimbra\Mail\Struct\MailCustomMetadata(
            $section, [new \Zimbra\Common\Struct\KeyValuePair($key, $value)]
        );
        $note = new \Zimbra\Mail\Struct\NoteInfo(
            $id,
            $revision,
            $folder,
            $date,
            $flags,
            $tags,
            $tagNames,
            $bounds,
            $color,
            $rgb,
            $changeDate,
            $modifiedSequence,
            $content,
            [$metadata]
        );
        $this->assertEquals($note, $response->getNote());
    }

    public function testCreateSearchFolder()
    {
        $id = $this->faker->uuid;
        $uuid = $this->faker->uuid;
        $query = $this->faker->word;
        $searchTypes = implode(',', [
            \Zimbra\Common\Enum\ItemType::MESSAGE(), \Zimbra\Common\Enum\ItemType::CONVERSATION()
        ]);
        $sortBy = \Zimbra\Common\Enum\SearchSortBy::DATE_DESC();

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:CreateSearchFolderResponse>
            <urn:search id="$id" uuid="$uuid" query="$query" sortBy="dateDesc" types="$searchTypes" />
        </urn:CreateSearchFolderResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->createSearchFolder(new \Zimbra\Mail\Struct\NewSearchFolderSpec());
        $search = new \Zimbra\Mail\Struct\SearchFolder(
            $id,
            $uuid,
            $query,
            $sortBy,
            $searchTypes
        );
        $this->assertEquals($search, $response->getSearchFolder());
    }

    public function testCreateTag()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $rgb = $this->faker->hexcolor;
        $color = $this->faker->numberBetween(0, 127);
        $unread = $this->faker->randomNumber;
        $count = $this->faker->randomNumber;
        $date = $this->faker->unixTime;
        $revision = $this->faker->randomNumber;
        $changeDate = $this->faker->unixTime;
        $modifiedSequence = $this->faker->randomNumber;

        $lifetime = $this->faker->word;
        $section = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->text;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:CreateTagResponse>
            <urn:tag id="$id" name="$name" color="$color" rgb="$rgb" u="$unread" n="$count" d="$date" rev="$revision" md="$changeDate" ms="$modifiedSequence">
                <urn:meta section="$section">
                    <urn:a n="$key">$value</urn:a>
                </urn:meta>
                <urn:retentionPolicy>
                    <urn:keep>
                        <urn:policy type="system" id="$id" name="$name" lifetime="$lifetime" />
                    </urn:keep>
                    <urn:purge>
                        <urn:policy type="user" id="$id" name="$name" lifetime="$lifetime" />
                    </urn:purge>
                </urn:retentionPolicy>
            </urn:tag>
        </urn:CreateTagResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->createTag(new \Zimbra\Mail\Struct\TagSpec());

        $metadata = new \Zimbra\Mail\Struct\MailCustomMetadata($section, [new \Zimbra\Common\Struct\KeyValuePair($key, $value)]);
        $retentionPolicy = new \Zimbra\Mail\Struct\RetentionPolicy(
            [new \Zimbra\Mail\Struct\Policy(\Zimbra\Common\Enum\Type::SYSTEM(), $id, $name, $lifetime)],
            [new \Zimbra\Mail\Struct\Policy(\Zimbra\Common\Enum\Type::USER(), $id, $name, $lifetime)]
        );
        $tag = new \Zimbra\Mail\Struct\TagInfo(
            $id,
            $name,
            $color,
            $rgb,
            $unread,
            $count,
            $date,
            $revision,
            $changeDate,
            $modifiedSequence,
            [$metadata],
            $retentionPolicy
        );
        $this->assertEquals($tag, $response->getTag());
    }

    public function testCreateTaskException()
    {
        $id = $this->faker->uuid;
        $modifiedSequence = $this->faker->randomNumber;
        $revision = $this->faker->randomNumber;

        $subject = $this->faker->text;
        $content = $this->faker->text;
        $contentType = $this->faker->word;
        $contentId = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $address = $this->faker->email;
        $personal = $this->faker->word;

        $calItemId = $this->faker->uuid;
        $deprecatedApptId = $this->faker->uuid;
        $calInvId = $this->faker->uuid;

        $part = $this->faker->word;
        $sentDate = $this->faker->unixTime;
        $messageIdHeader = $this->faker->uuid;

        $display = $this->faker->name;
        $addressType = \Zimbra\Common\Enum\AddressType::TO();
        $calItemType = \Zimbra\Common\Enum\InviteType::TASK();

        $size = $this->faker->randomNumber;
        $contentDisposition = $this->faker->word;
        $contentFilename = $this->faker->word;
        $location = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:CreateTaskExceptionResponse calItemId="$calItemId" apptId="$deprecatedApptId" invId="$calInvId" ms="$modifiedSequence" rev="$revision">
            <urn:m id="$id" />
            <urn:echo>
                <urn:m id="$id" part="$part" sd="$sentDate">
                    <urn:e a="$address" d="$display" p="$personal" t="t" />
                    <urn:su>$subject</urn:su>
                    <urn:mid>$messageIdHeader</urn:mid>
                    <urn:inv type="task" />
                    <urn:header n="$key">$value</urn:header>
                    <urn:mp part="$part" ct="$contentType" s="$size" cd="$contentDisposition" filename="$contentFilename" ci="$contentId" cl="$location" body="true" truncated="true">
                        <urn:content>$content</urn:content>
                    </urn:mp>
                    <urn:shr truncated="true">
                        <urn:content>$content</urn:content>
                    </urn:shr>
                    <urn:dlSubs truncated="true">
                        <urn:content>$content</urn:content>
                    </urn:dlSubs>
                </urn:m>
            </urn:echo>
        </urn:CreateTaskExceptionResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->createTaskException();

        $contentElems = [
            new \Zimbra\Mail\Struct\PartInfo(
                $part, $contentType, $size, $contentDisposition, $contentFilename, $contentId, $location, TRUE, TRUE, $content
            ),
            new \Zimbra\Mail\Struct\ShareNotification(TRUE, $content),
            new \Zimbra\Mail\Struct\DLSubscriptionNotification(TRUE, $content),
        ];
        $invite = new \Zimbra\Mail\Struct\InviteAsMP(
            $id, $part, $sentDate,
            [new \Zimbra\Mail\Struct\EmailInfo($address, $display, $personal, $addressType)],
            $subject, $messageIdHeader,
            new \Zimbra\Mail\Struct\MPInviteInfo($calItemType), [new \Zimbra\Common\Struct\KeyValuePair($key, $value)],
            $contentElems
        );
        $msg = new \Zimbra\Common\Struct\Id($id);
        $echo = new \Zimbra\Mail\Struct\CalEcho($invite);

        $this->assertSame($calItemId, $response->getCalItemId());
        $this->assertSame($deprecatedApptId, $response->getDeprecatedApptId());
        $this->assertSame($calInvId, $response->getCalInvId());
        $this->assertSame($modifiedSequence, $response->getModifiedSequence());
        $this->assertSame($revision, $response->getRevision());
        $this->assertEquals($msg, $response->getMsg());
        $this->assertEquals($echo, $response->getEcho());
    }

    public function testCreateTask()
    {
        $id = $this->faker->uuid;
        $modifiedSequence = $this->faker->randomNumber;
        $revision = $this->faker->randomNumber;

        $subject = $this->faker->text;
        $content = $this->faker->text;
        $contentType = $this->faker->word;
        $contentId = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $address = $this->faker->email;
        $personal = $this->faker->word;

        $calItemId = $this->faker->uuid;
        $deprecatedApptId = $this->faker->uuid;
        $calInvId = $this->faker->uuid;

        $part = $this->faker->word;
        $sentDate = $this->faker->unixTime;
        $messageIdHeader = $this->faker->uuid;

        $display = $this->faker->name;
        $addressType = \Zimbra\Common\Enum\AddressType::TO();
        $calItemType = \Zimbra\Common\Enum\InviteType::TASK();

        $size = $this->faker->randomNumber;
        $contentDisposition = $this->faker->word;
        $contentFilename = $this->faker->word;
        $location = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:CreateTaskResponse calItemId="$calItemId" apptId="$deprecatedApptId" invId="$calInvId" ms="$modifiedSequence" rev="$revision">
            <urn:m id="$id" />
            <urn:echo>
                <urn:m id="$id" part="$part" sd="$sentDate">
                    <urn:e a="$address" d="$display" p="$personal" t="t" />
                    <urn:su>$subject</urn:su>
                    <urn:mid>$messageIdHeader</urn:mid>
                    <urn:inv type="task" />
                    <urn:header n="$key">$value</urn:header>
                    <urn:mp part="$part" ct="$contentType" s="$size" cd="$contentDisposition" filename="$contentFilename" ci="$contentId" cl="$location" body="true" truncated="true">
                        <urn:content>$content</urn:content>
                    </urn:mp>
                    <urn:shr truncated="true">
                        <urn:content>$content</urn:content>
                    </urn:shr>
                    <urn:dlSubs truncated="true">
                        <urn:content>$content</urn:content>
                    </urn:dlSubs>
                </urn:m>
            </urn:echo>
        </urn:CreateTaskResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->createTask();

        $contentElems = [
            new \Zimbra\Mail\Struct\PartInfo(
                $part, $contentType, $size, $contentDisposition, $contentFilename, $contentId, $location, TRUE, TRUE, $content
            ),
            new \Zimbra\Mail\Struct\ShareNotification(TRUE, $content),
            new \Zimbra\Mail\Struct\DLSubscriptionNotification(TRUE, $content),
        ];
        $invite = new \Zimbra\Mail\Struct\InviteAsMP(
            $id, $part, $sentDate,
            [new \Zimbra\Mail\Struct\EmailInfo($address, $display, $personal, $addressType)],
            $subject, $messageIdHeader,
            new \Zimbra\Mail\Struct\MPInviteInfo($calItemType), [new \Zimbra\Common\Struct\KeyValuePair($key, $value)],
            $contentElems
        );
        $msg = new \Zimbra\Common\Struct\Id($id);
        $echo = new \Zimbra\Mail\Struct\CalEcho($invite);

        $this->assertSame($calItemId, $response->getCalItemId());
        $this->assertSame($deprecatedApptId, $response->getDeprecatedApptId());
        $this->assertSame($calInvId, $response->getCalInvId());
        $this->assertSame($modifiedSequence, $response->getModifiedSequence());
        $this->assertSame($revision, $response->getRevision());
        $this->assertEquals($msg, $response->getMsg());
        $this->assertEquals($echo, $response->getEcho());
    }

    public function testCreateWaitSet()
    {
        $id = $this->faker->uuid;
        $type = $this->faker->word;
        $sequence = $this->faker->randomNumber;
        $interests = implode(',', [
            \Zimbra\Common\Enum\InterestType::FOLDERS()->getValue(),
            \Zimbra\Common\Enum\InterestType::MESSAGES()->getValue(),
            \Zimbra\Common\Enum\InterestType::CONTACTS()->getValue(),
        ]);

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:CreateWaitSetResponse waitSet="$id" defTypes="$interests" seq="$sequence">
            <urn:error id="$id" type="$type" />
        </urn:CreateWaitSetResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->createWaitSet($interests);

        $error = new \Zimbra\Common\Struct\IdAndType($id, $type);
        $this->assertSame($id, $response->getWaitSetId());
        $this->assertSame($interests, $response->getDefaultInterests());
        $this->assertSame($sequence, $response->getSequence());
        $this->assertEquals([$error], $response->getErrors());
    }

    public function testDeclineCounterAppointment()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:DeclineCounterAppointmentResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->declineCounterAppointment();
        $this->assertInstanceOf(\Zimbra\Mail\Message\DeclineCounterAppointmentResponse::class, $response);
    }

    public function testDeleteDataSource()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:DeleteDataSourceResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->deleteDataSource();
        $this->assertInstanceOf(\Zimbra\Mail\Message\DeleteDataSourceResponse::class, $response);
    }

    public function testDestroyWaitSet()
    {
        $waitSetId = $this->faker->uuid;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:DestroyWaitSetResponse waitSet="$waitSetId" />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->destroyWaitSet($waitSetId);
        $this->assertSame($waitSetId, $response->getWaitSetId());
    }

    public function testDiffDocument()
    {
        $disposition = $this->faker->word;
        $text = $this->faker->text;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:DiffDocumentResponse>
            <urn:chunk disp="$disposition">$text</urn:chunk>
        </urn:DiffDocumentResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->diffDocument();

        $chunk = new \Zimbra\Mail\Struct\DispositionAndText($disposition, $text);
        $this->assertEquals([$chunk], $response->getChunks());
    }

    public function testDismissCalendarItemAlarm()
    {
        $calItemId = $this->faker->uuid;
        $nextAlarm = $this->faker->randomNumber;
        $alarmInstanceStart = $this->faker->randomNumber;
        $invId = $this->faker->randomNumber;
        $componentNum = $this->faker->randomNumber;

        $action = \Zimbra\Common\Enum\AlarmAction::DISPLAY();
        $name = $this->faker->name;
        $value = $this->faker->word;
        $date = $this->faker->date;
        $weeks = mt_rand(1, 100);
        $days = mt_rand(1, 30);
        $hours = mt_rand(0, 23);
        $minutes = mt_rand(0, 59);
        $seconds = mt_rand(0, 59);
        $uri = $this->faker->url;
        $contentType = $this->faker->mimeType;
        $binaryB64Data = base64_encode($this->faker->text);
        $description = $this->faker->text;
        $summary = $this->faker->text;
        $location = $this->faker->text;

        $address = $this->faker->email;
        $displayName = $this->faker->name;
        $role = $this->faker->word;
        $partStat = \Zimbra\Common\Enum\ParticipationStatus::ACCEPT();

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:DismissCalendarItemAlarmResponse>
            <urn:appt calItemId="$calItemId">
                <urn:alarmData nextAlarm="$nextAlarm" alarmInstStart="$alarmInstanceStart" invId="$invId" compNum="$componentNum" name="$name" loc="$location">
                    <urn:alarm action="DISPLAY">
                        <urn:trigger>
                            <urn:abs d="$date" />
                            <urn:rel w="$weeks" d="$days" h="$hours" m="$minutes" s="$seconds" />
                        </urn:trigger>
                        <urn:repeat w="$weeks" d="$days" h="$hours" m="$minutes" s="$seconds" />
                        <urn:desc>$description</urn:desc>
                        <urn:attach uri="$uri" ct="$contentType">$binaryB64Data</urn:attach>
                        <urn:summary>$summary</urn:summary>
                        <urn:at a="$address" d="$displayName" role="$role" ptst="AC" rsvp="true">
                            <urn:xparam name="$name" value="$value" />
                        </urn:at>
                        <urn:xprop name="$name" value="$value">
                            <urn:xparam name="$name" value="$value" />
                        </urn:xprop>
                    </urn:alarm>
                </urn:alarmData>
            </urn:appt>
            <urn:task calItemId="$calItemId">
                <urn:alarmData nextAlarm="$nextAlarm" alarmInstStart="$alarmInstanceStart" invId="$invId" compNum="$componentNum" name="$name" loc="$location">
                    <urn:alarm action="DISPLAY">
                        <urn:trigger>
                            <urn:abs d="$date" />
                            <urn:rel w="$weeks" d="$days" h="$hours" m="$minutes" s="$seconds" />
                        </urn:trigger>
                        <urn:repeat w="$weeks" d="$days" h="$hours" m="$minutes" s="$seconds" />
                        <urn:desc>$description</urn:desc>
                        <urn:attach uri="$uri" ct="$contentType">$binaryB64Data</urn:attach>
                        <urn:summary>$summary</urn:summary>
                        <urn:at a="$address" d="$displayName" role="$role" ptst="AC" rsvp="true">
                            <urn:xparam name="$name" value="$value" />
                        </urn:at>
                        <urn:xprop name="$name" value="$value">
                            <urn:xparam name="$name" value="$value" />
                        </urn:xprop>
                    </urn:alarm>
                </urn:alarmData>
            </urn:task>
        </urn:DismissCalendarItemAlarmResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->dismissCalendarItemAlarm();

        $trigger = new \Zimbra\Mail\Struct\AlarmTriggerInfo(
            new \Zimbra\Mail\Struct\DateAttr($date), new \Zimbra\Mail\Struct\DurationInfo($weeks, $days, $hours, $minutes, $seconds)
        );
        $repeat = new \Zimbra\Mail\Struct\DurationInfo($weeks, $days, $hours, $minutes, $seconds);
        $attach = new \Zimbra\Mail\Struct\CalendarAttach($uri, $contentType, $binaryB64Data);
        $at = new \Zimbra\Mail\Struct\CalendarAttendee($address, $displayName, $role, $partStat, TRUE, [new \Zimbra\Mail\Struct\XParam($name, $value)]);
        $xprop = new \Zimbra\Mail\Struct\XProp($name, $value, [new \Zimbra\Mail\Struct\XParam($name, $value)]);
        $alarm = new \Zimbra\Mail\Struct\AlarmInfo($action, $trigger, $repeat, $description, $attach, $summary, [$at], [$xprop]);
        $alarmData = new \Zimbra\Mail\Struct\AlarmDataInfo(
            $nextAlarm, $alarmInstanceStart, $invId, $componentNum, $name, $location, $alarm
        );
        $appt = new \Zimbra\Mail\Struct\UpdatedAppointmentAlarmInfo(
            $calItemId, $alarmData
        );
        $task = new \Zimbra\Mail\Struct\UpdatedTaskAlarmInfo(
            $calItemId, $alarmData
        );

        $this->assertEquals([$appt], $response->getApptUpdatedAlarms());
        $this->assertEquals([$task], $response->getTaskUpdatedAlarms());
    }

    public function testEmptyDumpster()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:EmptyDumpsterResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->emptyDumpster();
        $this->assertInstanceOf(\Zimbra\Mail\Message\EmptyDumpsterResponse::class, $response);
    }

    public function testEnableSharedReminder()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:EnableSharedReminderResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->enableSharedReminder(new \Zimbra\Mail\Struct\SharedReminderMount());
        $this->assertInstanceOf(\Zimbra\Mail\Message\EnableSharedReminderResponse::class, $response);
    }

    public function testExpandRecur()
    {
        $startTime = $this->faker->unixTime;
        $endTime = $this->faker->unixTime;
        $duration = $this->faker->randomNumber;
        $tzOffset = $this->faker->randomNumber;
        $recurIdZ = $this->faker->iso8601;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ExpandRecurResponse>
            <urn:inst s="$startTime" dur="$duration" allDay="true" tzo="$tzOffset" ridZ="$recurIdZ" />
        </urn:ExpandRecurResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->expandRecur($startTime, $endTime);

        $instance = new \Zimbra\Mail\Struct\ExpandedRecurrenceInstance(
            $startTime, $duration, TRUE, $tzOffset, $recurIdZ
        );
        $this->assertEquals([$instance], $response->getInstances());
    }

    public function testExportContacts()
    {
        $contentType = $this->faker->mimeType;
        $content = $this->faker->text;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ExportContactsResponse>
            <urn:content>$content</urn:content>
        </urn:ExportContactsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->exportContacts($contentType);
        $this->assertSame($content, $response->getContent());
    }

    public function testFileSharedWithMe()
    {
        $status = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:FileSharedWithMeResponse>
            <urn:status>$status</urn:status>
        </urn:FileSharedWithMeResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->fileSharedWithMe();
        $this->assertEquals($status, $response->getStatus());
    }

    public function testFolderAction()
    {
        $operation = $this->faker->randomElement(\Zimbra\Common\Enum\ContactActionOp::values())->getValue();
        $id = $this->faker->uuid;
        $zimbraId = $this->faker->uuid;
        $nonExistentIds = $this->faker->uuid;
        $newlyCreatedIds = $this->faker->uuid;
        $displayName = $this->faker->name;
        $accessKey = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:FolderActionResponse>
            <urn:action id="$id" op="$operation" nei="$nonExistentIds" nci="$newlyCreatedIds" zid="$zimbraId" d="$displayName" key="$accessKey" />
        </urn:FolderActionResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->folderAction(new \Zimbra\Mail\Struct\FolderActionSelector($operation, $id));

        $action = new \Zimbra\Mail\Struct\FolderActionResult(
            $id, $operation, $nonExistentIds, $newlyCreatedIds, $zimbraId, $displayName, $accessKey
        );
        $this->assertEquals($action, $response->getAction());
    }

    public function testForwardAppointmentInvite()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ForwardAppointmentInviteResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->forwardAppointmentInvite();
        $this->assertInstanceOf(\Zimbra\Mail\Message\ForwardAppointmentInviteResponse::class, $response);
    }

    public function testForwardAppointment()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ForwardAppointmentResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->forwardAppointment();
        $this->assertInstanceOf(\Zimbra\Mail\Message\ForwardAppointmentResponse::class, $response);
    }

    public function testGenerateUUID()
    {
        $uuid = $this->faker->uuid;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GenerateUUIDResponse>$uuid</urn:GenerateUUIDResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->generateUUID();
        $this->assertSame($uuid, $response->getUuid());
    }

    public function testGetAppointment()
    {
        $flags = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;
        $uid = $this->faker->uuid;
        $id = $this->faker->uuid;
        $revision = $this->faker->randomNumber;
        $size = $this->faker->randomNumber;
        $date = $this->faker->randomNumber;
        $folder = $this->faker->uuid;
        $changeDate = $this->faker->randomNumber;
        $modifiedSequence = $this->faker->randomNumber;
        $nextAlarm = $this->faker->randomNumber;

        $calItemType = $this->faker->word;
        $sequence = $this->faker->randomNumber;
        $intId = $this->faker->randomNumber;
        $componentNum = $this->faker->randomNumber;
        $recurrenceId = $this->faker->uuid;

        $tzStdOffset = $this->faker->randomNumber;
        $tzDayOffset = $this->faker->randomNumber;
        $standardTZName = $this->faker->word;
        $daylightTZName = $this->faker->word;

        $mon = mt_rand(1, 12);
        $hour = mt_rand(0, 23);
        $min = mt_rand(0, 59);
        $sec = mt_rand(0, 59);
        $mday = mt_rand(1, 31);
        $week = mt_rand(1, 4);
        $wkday = mt_rand(1, 7);

        $method = $this->faker->word;
        $part = $this->faker->word;
        $contentType = $this->faker->mimeType;
        $contentDisposition = $this->faker->word;
        $contentFilename = $this->faker->word;
        $contentId = $this->faker->word;
        $location = $this->faker->word;
        $content = $this->faker->text;

        $seq = $this->faker->randomNumber;
        $date = $this->faker->unixTime;
        $attendee = $this->faker->email;
        $sentBy = $this->faker->email;
        $partStat = \Zimbra\Common\Enum\ParticipationStatus::ACCEPT();
        $rangeType = $this->faker->numberBetween(1, 3);
        $recurId = $this->faker->uuid;

        $section = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->text;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetAppointmentResponse>
            <urn:appt f="$flags" t="$tags" tn="$tagNames" uid="$uid" id="$id" rev="$revision" s="$size" d="$date" l="$folder" md="$changeDate" ms="$modifiedSequence" nextAlarm="$nextAlarm" orphan="true">
                <urn:inv type="$calItemType" seq="$sequence" id="$intId" compNum="$componentNum" recurId="$recurrenceId">
                    <urn:tz id="$id" stdoff="$tzStdOffset" dayoff="$tzDayOffset" stdname="$standardTZName" dayname="$daylightTZName">
                        <urn:standard mon="$mon" hour="$hour" min="$min" sec="$sec" mday="$mday" week="$week" wkday="$wkday" />
                        <urn:daylight mon="$mon" hour="$hour" min="$min" sec="$sec" mday="$mday" week="$week" wkday="$wkday" />
                    </urn:tz>
                    <urn:comp method="$method" compNum="$componentNum" rsvp="true" />
                    <urn:mp part="$part" ct="$contentType" s="$size" cd="$contentDisposition" filename="$contentFilename" ci="$contentId" cl="$location" body="true" truncated="true">
                        <urn:content>$content</urn:content>
                        <urn:mp part="$part" ct="$contentType" />
                    </urn:mp>
                    <urn:shr truncated="true">
                        <urn:content>$content</urn:content>
                    </urn:shr>
                    <urn:dlSubs truncated="true">
                        <urn:content>$content</urn:content>
                    </urn:dlSubs>
                </urn:inv>
                <urn:replies>
                    <urn:reply rangeType="$rangeType" recurId="$recurId" seq="$seq" d="$date" at="$attendee" sentBy="$sentBy" ptst="AC" />
                </urn:replies>
                <urn:meta section="$section">
                    <urn:a n="$key">$value</urn:a>
                </urn:meta>
            </urn:appt>
            <urn:task f="$flags" t="$tags" tn="$tagNames" uid="$uid" id="$id" rev="$revision" s="$size" d="$date" l="$folder" md="$changeDate" ms="$modifiedSequence" nextAlarm="$nextAlarm" orphan="true">
                <urn:inv type="$calItemType" seq="$sequence" id="$intId" compNum="$componentNum" recurId="$recurrenceId">
                    <urn:tz id="$id" stdoff="$tzStdOffset" dayoff="$tzDayOffset" stdname="$standardTZName" dayname="$daylightTZName">
                        <urn:standard mon="$mon" hour="$hour" min="$min" sec="$sec" mday="$mday" week="$week" wkday="$wkday" />
                        <urn:daylight mon="$mon" hour="$hour" min="$min" sec="$sec" mday="$mday" week="$week" wkday="$wkday" />
                    </urn:tz>
                    <urn:comp method="$method" compNum="$componentNum" rsvp="true" />
                    <urn:mp part="$part" ct="$contentType" s="$size" cd="$contentDisposition" filename="$contentFilename" ci="$contentId" cl="$location" body="true" truncated="true">
                        <urn:content>$content</urn:content>
                        <urn:mp part="$part" ct="$contentType" />
                    </urn:mp>
                    <urn:shr truncated="true">
                        <urn:content>$content</urn:content>
                    </urn:shr>
                    <urn:dlSubs truncated="true">
                        <urn:content>$content</urn:content>
                    </urn:dlSubs>
                </urn:inv>
                <urn:replies>
                    <urn:reply rangeType="$rangeType" recurId="$recurId" seq="$seq" d="$date" at="$attendee" sentBy="$sentBy" ptst="AC" />
                </urn:replies>
                <urn:meta section="$section">
                    <urn:a n="$key">$value</urn:a>
                </urn:meta>
            </urn:task>
        </urn:GetAppointmentResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->getAppointment();

        $standardTzOnset = new \Zimbra\Common\Struct\TzOnsetInfo($mon, $hour, $min, $sec, $mday, $week, $wkday);
        $daylightTzOnset = new \Zimbra\Common\Struct\TzOnsetInfo($mon, $hour, $min, $sec, $mday, $week, $wkday);
        $tz = new \Zimbra\Mail\Struct\CalTZInfo(
            $id, $tzStdOffset, $tzDayOffset, $standardTzOnset, $daylightTzOnset, $standardTZName, $daylightTZName
        );
        $comp = new \Zimbra\Mail\Struct\InviteComponent($method, $componentNum, TRUE);
        $mimePart = new \Zimbra\Mail\Struct\PartInfo($part, $contentType);
        $mp = new \Zimbra\Mail\Struct\PartInfo(
            $part, $contentType, $size, $contentDisposition, $contentFilename, $contentId, $location, TRUE, TRUE, $content, [$mimePart]
        );
        $shr = new \Zimbra\Mail\Struct\ShareNotification(TRUE, $content);
        $dlSubs = new \Zimbra\Mail\Struct\DLSubscriptionNotification(TRUE, $content);
        $inv = new \Zimbra\Mail\Struct\Invitation(
            $calItemType, $sequence, $intId, $componentNum, $recurrenceId, [$tz], $comp, [$mp], [$shr], [$dlSubs]
        );
        $reply = new \Zimbra\Mail\Struct\CalendarReply(
            $rangeType, $recurId, $seq, $date, $attendee, $sentBy, $partStat
        );
        $meta = new \Zimbra\Mail\Struct\MailCustomMetadata($section, [new \Zimbra\Common\Struct\KeyValuePair($key, $value)]);
        $appt = new \Zimbra\Mail\Struct\CalendarItemInfo(
            $flags, $tags, $tagNames, $uid, $id, $revision, $size, $date, $folder, $changeDate, $modifiedSequence, $nextAlarm, TRUE, [$inv], [$reply], [$meta]
        );
        $task = new \Zimbra\Mail\Struct\TaskItemInfo(
            $flags, $tags, $tagNames, $uid, $id, $revision, $size, $date, $folder, $changeDate, $modifiedSequence, $nextAlarm, TRUE, [$inv], [$reply], [$meta]
        );

        $this->assertEquals($appt, $response->getApptItem());
        $this->assertEquals($task, $response->getTaskItem());
    }

    public function testGetApptSummaries()
    {
        $startTime = $this->faker->randomNumber;
        $endTime = $this->faker->randomNumber;

        $xUid = $this->faker->uuid;
        $uid = $this->faker->uuid;
        $category1 = $this->faker->unique->word;
        $category2 = $this->faker->unique->word;
        $latitude = (string) $this->faker->latitude;
        $longitude = (string) $this->faker->longitude;
        $fragment = $this->faker->text;

        $name = $this->faker->name;
        $value = $this->faker->word;
        $address = $this->faker->email;
        $displayName = $this->faker->name;
        $url = $this->faker->url;
        $sentBy = $this->faker->email;
        $dir = $this->faker->word;
        $language = $this->faker->locale;

        $nextAlarm = $this->faker->randomNumber;
        $alarmInstanceStart = $this->faker->randomNumber;
        $invId = $this->faker->randomNumber;
        $componentNum = $this->faker->randomNumber;

        $action = \Zimbra\Common\Enum\AlarmAction::DISPLAY();
        $date = $this->faker->date;
        $weeks = mt_rand(1, 100);
        $days = mt_rand(1, 30);
        $hours = mt_rand(0, 23);
        $minutes = mt_rand(0, 59);
        $seconds = mt_rand(0, 59);
        $uri = $this->faker->url;
        $contentType = $this->faker->mimeType;
        $binaryB64Data = base64_encode($this->faker->text);
        $description = $this->faker->text;
        $summary = $this->faker->text;
        $location = $this->faker->text;
        $role = $this->faker->word;
        $partStat = \Zimbra\Common\Enum\ParticipationStatus::ACCEPT();

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetApptSummariesResponse>
            <urn:appt x_uid="$xUid" uid="$uid">
                <urn:or a="$address" url="$url" d="$displayName" sentBy="$sentBy" dir="$dir" lang="$language">
                    <urn:xparam name="$name" value="$value" />
                </urn:or>
                <urn:category>$category1</urn:category>
                <urn:category>$category2</urn:category>
                <urn:geo lat="$latitude" lon="$longitude" />
                <urn:fr>$fragment</urn:fr>
                <urn:inst s="$startTime" ex="true">
                    <urn:or a="$address" url="$url" d="$displayName" sentBy="$sentBy" dir="$dir" lang="$language">
                        <urn:xparam name="$name" value="$value" />
                    </urn:or>
                    <urn:category>$category1</urn:category>
                    <urn:category>$category2</urn:category>
                    <urn:geo lat="$latitude" lon="$longitude" />
                    <urn:fr>$fragment</urn:fr>
                </urn:inst>
                <urn:alarmData nextAlarm="$nextAlarm" alarmInstStart="$alarmInstanceStart" invId="$invId" compNum="$componentNum" name="$name" loc="$location">
                    <urn:alarm action="DISPLAY">
                        <urn:trigger>
                            <urn:abs d="$date" />
                            <urn:rel w="$weeks" d="$days" h="$hours" m="$minutes" s="$seconds" />
                        </urn:trigger>
                        <urn:repeat w="$weeks" d="$days" h="$hours" m="$minutes" s="$seconds" />
                        <urn:desc>$description</urn:desc>
                        <urn:attach uri="$uri" ct="$contentType">$binaryB64Data</urn:attach>
                        <urn:summary>$summary</urn:summary>
                        <urn:at a="$address" d="$displayName" role="$role" ptst="AC" rsvp="true">
                            <urn:xparam name="$name" value="$value" />
                        </urn:at>
                        <urn:xprop name="$name" value="$value">
                            <urn:xparam name="$name" value="$value" />
                        </urn:xprop>
                    </urn:alarm>
                </urn:alarmData>
            </urn:appt>
            <urn:task x_uid="$xUid" uid="$uid">
                <urn:or a="$address" url="$url" d="$displayName" sentBy="$sentBy" dir="$dir" lang="$language">
                    <urn:xparam name="$name" value="$value" />
                </urn:or>
                <urn:category>$category1</urn:category>
                <urn:category>$category2</urn:category>
                <urn:geo lat="$latitude" lon="$longitude" />
                <urn:fr>$fragment</urn:fr>
                <urn:inst s="$startTime" ex="true">
                    <urn:or a="$address" url="$url" d="$displayName" sentBy="$sentBy" dir="$dir" lang="$language">
                        <urn:xparam name="$name" value="$value" />
                    </urn:or>
                    <urn:category>$category1</urn:category>
                    <urn:category>$category2</urn:category>
                    <urn:geo lat="$latitude" lon="$longitude" />
                    <urn:fr>$fragment</urn:fr>
                </urn:inst>
                <urn:alarmData nextAlarm="$nextAlarm" alarmInstStart="$alarmInstanceStart" invId="$invId" compNum="$componentNum" name="$name" loc="$location">
                    <urn:alarm action="DISPLAY">
                        <urn:trigger>
                            <urn:abs d="$date" />
                            <urn:rel w="$weeks" d="$days" h="$hours" m="$minutes" s="$seconds" />
                        </urn:trigger>
                        <urn:repeat w="$weeks" d="$days" h="$hours" m="$minutes" s="$seconds" />
                        <urn:desc>$description</urn:desc>
                        <urn:attach uri="$uri" ct="$contentType">$binaryB64Data</urn:attach>
                        <urn:summary>$summary</urn:summary>
                        <urn:at a="$address" d="$displayName" role="$role" ptst="AC" rsvp="true">
                            <urn:xparam name="$name" value="$value" />
                        </urn:at>
                        <urn:xprop name="$name" value="$value">
                            <urn:xparam name="$name" value="$value" />
                        </urn:xprop>
                    </urn:alarm>
                </urn:alarmData>
            </urn:task>
        </urn:GetApptSummariesResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->getApptSummaries($startTime, $endTime);

        $trigger = new \Zimbra\Mail\Struct\AlarmTriggerInfo(
            new \Zimbra\Mail\Struct\DateAttr($date), new \Zimbra\Mail\Struct\DurationInfo($weeks, $days, $hours, $minutes, $seconds)
        );
        $repeat = new \Zimbra\Mail\Struct\DurationInfo($weeks, $days, $hours, $minutes, $seconds);
        $attach = new \Zimbra\Mail\Struct\CalendarAttach($uri, $contentType, $binaryB64Data);
        $at = new \Zimbra\Mail\Struct\CalendarAttendee($address, $displayName, $role, $partStat, TRUE, [new \Zimbra\Mail\Struct\XParam($name, $value)]);
        $xprop = new \Zimbra\Mail\Struct\XProp($name, $value, [new \Zimbra\Mail\Struct\XParam($name, $value)]);
        $alarm = new \Zimbra\Mail\Struct\AlarmInfo($action, $trigger, $repeat, $description, $attach, $summary, [$at], [$xprop]);
        $alarmData = new \Zimbra\Mail\Struct\AlarmDataInfo(
            $nextAlarm, $alarmInstanceStart, $invId, $componentNum, $name, $location, $alarm
        );

        $geo = new \Zimbra\Mail\Struct\GeoInfo($latitude, $longitude);
        $organizer = new \Zimbra\Mail\Struct\CalOrganizer($address, $url, $displayName, $sentBy, $dir, $language, [new \Zimbra\Mail\Struct\XParam($name, $value)]);
        $inst = new \Zimbra\Mail\Struct\LegacyInstanceDataInfo(
            $startTime, TRUE, $organizer, [$category1, $category2], $geo, $fragment
        );

        $appt = new \Zimbra\Mail\Struct\LegacyAppointmentData(
            $xUid, $uid, $organizer, [$category1, $category2], $geo, $fragment, [$inst], $alarmData
        );
        $task = new \Zimbra\Mail\Struct\LegacyTaskData(
            $xUid, $uid, $organizer, [$category1, $category2], $geo, $fragment, [$inst], $alarmData
        );

        $this->assertEquals([$appt], $response->getApptEntries());
        $this->assertEquals([$task], $response->getTaskEntries());
    }

    public function testGetCalendarItemSummaries()
    {
        $startTime = $this->faker->randomNumber;
        $endTime = $this->faker->randomNumber;

        $xUid = $this->faker->uuid;
        $uid = $this->faker->uuid;
        $category1 = $this->faker->unique->word;
        $category2 = $this->faker->unique->word;
        $latitude = (string) $this->faker->latitude;
        $longitude = (string) $this->faker->longitude;
        $fragment = $this->faker->text;

        $name = $this->faker->name;
        $value = $this->faker->word;
        $address = $this->faker->email;
        $displayName = $this->faker->name;
        $url = $this->faker->url;
        $sentBy = $this->faker->email;
        $dir = $this->faker->word;
        $language = $this->faker->locale;

        $nextAlarm = $this->faker->randomNumber;
        $alarmInstanceStart = $this->faker->randomNumber;
        $invId = $this->faker->randomNumber;
        $componentNum = $this->faker->randomNumber;

        $action = \Zimbra\Common\Enum\AlarmAction::DISPLAY();
        $date = $this->faker->date;
        $weeks = mt_rand(1, 100);
        $days = mt_rand(1, 30);
        $hours = mt_rand(0, 23);
        $minutes = mt_rand(0, 59);
        $seconds = mt_rand(0, 59);
        $uri = $this->faker->url;
        $contentType = $this->faker->mimeType;
        $binaryB64Data = base64_encode($this->faker->text);
        $description = $this->faker->text;
        $summary = $this->faker->text;
        $location = $this->faker->text;
        $role = $this->faker->word;
        $partStat = \Zimbra\Common\Enum\ParticipationStatus::ACCEPT();

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetCalendarItemSummariesResponse>
            <urn:appt x_uid="$xUid" uid="$uid">
                <urn:or a="$address" url="$url" d="$displayName" sentBy="$sentBy" dir="$dir" lang="$language">
                    <urn:xparam name="$name" value="$value" />
                </urn:or>
                <urn:category>$category1</urn:category>
                <urn:category>$category2</urn:category>
                <urn:geo lat="$latitude" lon="$longitude" />
                <urn:fr>$fragment</urn:fr>
                <urn:inst s="$startTime" ex="true">
                    <urn:or a="$address" url="$url" d="$displayName" sentBy="$sentBy" dir="$dir" lang="$language">
                        <urn:xparam name="$name" value="$value" />
                    </urn:or>
                    <urn:category>$category1</urn:category>
                    <urn:category>$category2</urn:category>
                    <urn:geo lat="$latitude" lon="$longitude" />
                    <urn:fr>$fragment</urn:fr>
                </urn:inst>
                <urn:alarmData nextAlarm="$nextAlarm" alarmInstStart="$alarmInstanceStart" invId="$invId" compNum="$componentNum" name="$name" loc="$location">
                    <urn:alarm action="DISPLAY">
                        <urn:trigger>
                            <urn:abs d="$date" />
                            <urn:rel w="$weeks" d="$days" h="$hours" m="$minutes" s="$seconds" />
                        </urn:trigger>
                        <urn:repeat w="$weeks" d="$days" h="$hours" m="$minutes" s="$seconds" />
                        <urn:desc>$description</urn:desc>
                        <urn:attach uri="$uri" ct="$contentType">$binaryB64Data</urn:attach>
                        <urn:summary>$summary</urn:summary>
                        <urn:at a="$address" d="$displayName" role="$role" ptst="AC" rsvp="true">
                            <urn:xparam name="$name" value="$value" />
                        </urn:at>
                        <urn:xprop name="$name" value="$value">
                            <urn:xparam name="$name" value="$value" />
                        </urn:xprop>
                    </urn:alarm>
                </urn:alarmData>
            </urn:appt>
            <urn:task x_uid="$xUid" uid="$uid">
                <urn:or a="$address" url="$url" d="$displayName" sentBy="$sentBy" dir="$dir" lang="$language">
                    <urn:xparam name="$name" value="$value" />
                </urn:or>
                <urn:category>$category1</urn:category>
                <urn:category>$category2</urn:category>
                <urn:geo lat="$latitude" lon="$longitude" />
                <urn:fr>$fragment</urn:fr>
                <urn:inst s="$startTime" ex="true">
                    <urn:or a="$address" url="$url" d="$displayName" sentBy="$sentBy" dir="$dir" lang="$language">
                        <urn:xparam name="$name" value="$value" />
                    </urn:or>
                    <urn:category>$category1</urn:category>
                    <urn:category>$category2</urn:category>
                    <urn:geo lat="$latitude" lon="$longitude" />
                    <urn:fr>$fragment</urn:fr>
                </urn:inst>
                <urn:alarmData nextAlarm="$nextAlarm" alarmInstStart="$alarmInstanceStart" invId="$invId" compNum="$componentNum" name="$name" loc="$location">
                    <urn:alarm action="DISPLAY">
                        <urn:trigger>
                            <urn:abs d="$date" />
                            <urn:rel w="$weeks" d="$days" h="$hours" m="$minutes" s="$seconds" />
                        </urn:trigger>
                        <urn:repeat w="$weeks" d="$days" h="$hours" m="$minutes" s="$seconds" />
                        <urn:desc>$description</urn:desc>
                        <urn:attach uri="$uri" ct="$contentType">$binaryB64Data</urn:attach>
                        <urn:summary>$summary</urn:summary>
                        <urn:at a="$address" d="$displayName" role="$role" ptst="AC" rsvp="true">
                            <urn:xparam name="$name" value="$value" />
                        </urn:at>
                        <urn:xprop name="$name" value="$value">
                            <urn:xparam name="$name" value="$value" />
                        </urn:xprop>
                    </urn:alarm>
                </urn:alarmData>
            </urn:task>
        </urn:GetCalendarItemSummariesResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->getCalendarItemSummaries($startTime, $endTime);

        $trigger = new \Zimbra\Mail\Struct\AlarmTriggerInfo(
            new \Zimbra\Mail\Struct\DateAttr($date), new \Zimbra\Mail\Struct\DurationInfo($weeks, $days, $hours, $minutes, $seconds)
        );
        $repeat = new \Zimbra\Mail\Struct\DurationInfo($weeks, $days, $hours, $minutes, $seconds);
        $attach = new \Zimbra\Mail\Struct\CalendarAttach($uri, $contentType, $binaryB64Data);
        $at = new \Zimbra\Mail\Struct\CalendarAttendee($address, $displayName, $role, $partStat, TRUE, [new \Zimbra\Mail\Struct\XParam($name, $value)]);
        $xprop = new \Zimbra\Mail\Struct\XProp($name, $value, [new \Zimbra\Mail\Struct\XParam($name, $value)]);
        $alarm = new \Zimbra\Mail\Struct\AlarmInfo($action, $trigger, $repeat, $description, $attach, $summary, [$at], [$xprop]);
        $alarmData = new \Zimbra\Mail\Struct\AlarmDataInfo(
            $nextAlarm, $alarmInstanceStart, $invId, $componentNum, $name, $location, $alarm
        );

        $geo = new \Zimbra\Mail\Struct\GeoInfo($latitude, $longitude);
        $organizer = new \Zimbra\Mail\Struct\CalOrganizer($address, $url, $displayName, $sentBy, $dir, $language, [new \Zimbra\Mail\Struct\XParam($name, $value)]);
        $inst = new \Zimbra\Mail\Struct\LegacyInstanceDataInfo(
            $startTime, TRUE, $organizer, [$category1, $category2], $geo, $fragment
        );

        $appt = new \Zimbra\Mail\Struct\LegacyAppointmentData(
            $xUid, $uid, $organizer, [$category1, $category2], $geo, $fragment, [$inst], $alarmData
        );
        $task = new \Zimbra\Mail\Struct\LegacyTaskData(
            $xUid, $uid, $organizer, [$category1, $category2], $geo, $fragment, [$inst], $alarmData
        );

        $this->assertEquals([$appt], $response->getApptEntries());
        $this->assertEquals([$task], $response->getTaskEntries());
    }

    public function testGetComments()
    {
        $name = $this->faker->name;
        $parentId = $this->faker->uuid;
        $id = $this->faker->uuid;
        $uuid = $this->faker->uuid;
        $email = $this->faker->email;
        $creatorEmail = $this->faker->email;
        $date = $this->faker->randomNumber;
        $flags = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;
        $color = $this->faker->numberBetween(0, 127);
        $rgb = $this->faker->hexcolor;
        $section = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->text;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetCommentsResponse>
            <urn:user id="$id" email="$email" name="$name" />
            <urn:comment parentId="$parentId" id="$id" uuid="$uuid" email="$creatorEmail" f="$flags" t="$tags" tn="$tagNames" color="$color" rgb="$rgb" d="$date">
                <urn:meta section="$section">
                    <urn:a n="$key">$value</urn:a>
                </urn:meta>
            </urn:comment>
        </urn:GetCommentsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->getComments(new \Zimbra\Mail\Struct\ParentId());

        $user = new \Zimbra\Mail\Struct\IdEmailName(
            $id, $email, $name
        );
        $comment = new \Zimbra\Mail\Struct\CommentInfo(
            $parentId,
            $id,
            $uuid,
            $creatorEmail,
            $flags,
            $tags,
            $tagNames,
            $color,
            $rgb,
            $date,
            [new \Zimbra\Mail\Struct\MailCustomMetadata($section, [new \Zimbra\Common\Struct\KeyValuePair($key, $value)])]
        );
        $this->assertEquals([$user], $response->getUsers());
        $this->assertEquals([$comment], $response->getComments());
    }

    public function testGetContactBackupList()
    {
        $backup1 = $this->faker->unique->word;
        $backup2 = $this->faker->unique->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetContactBackupListResponse>
            <urn:backups>
                <urn:backup>$backup1</urn:backup>
                <urn:backup>$backup2</urn:backup>
            </urn:backups>
        </urn:GetContactBackupListResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->getContactBackupList();
        $this->assertSame([$backup1, $backup2], $response->getBackup());
    }

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

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
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

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->getContacts();

        $meta = new \Zimbra\Mail\Struct\MailCustomMetadata($section);
        $attr = new \Zimbra\Common\Struct\ContactAttr($key, $value, $part, $contentType, $size, $contentFilename);
        $member = new \Zimbra\Mail\Struct\ContactGroupMember(\Zimbra\Common\Enum\MemberType::CONTACT(), $value);
        $contact = new \Zimbra\Mail\Struct\ContactInfo(
            $id, $sortField, TRUE, $imapUid, $folder, $flags, $tags, $tagNames, $changeDate, $modifiedSequenceId, $date, $revisionId, $fileAs, $email, $email2, $email3, $type, $dlist, $reference, FALSE, [$meta], [$attr], [$member], $memberOf
        );
        $this->assertEquals([$contact], $response->getContacts());
    }

    public function testGetConv()
    {
        $id = $this->faker->uuid;
        $num = $this->faker->randomNumber;
        $totalSize = $this->faker->randomNumber;
        $flags = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;
        $subject = $this->faker->word;
        $section = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->text;

        $imapUid = $this->faker->randomNumber;
        $calendarIntendedFor = $this->faker->word;
        $origId = $this->faker->uuid;
        $draftReplyType = \Zimbra\Common\Enum\ReplyType::REPLIED();
        $identityId = $this->faker->uuid;
        $draftAccountId = $this->faker->uuid;
        $draftAutoSendTime = $this->faker->randomNumber;
        $sentDate = $this->faker->randomNumber;
        $resentDate = $this->faker->randomNumber;
        $part = $this->faker->word;
        $fragment = $this->faker->word;
        $messageIdHeader = $this->faker->word;
        $inReplyTo = $this->faker->word;

        $address = $this->faker->email;
        $display = $this->faker->name;
        $personal = $this->faker->word;
        $addressType = \Zimbra\Common\Enum\AddressType::TO();

        $contentType = $this->faker->mimeType;
        $size = $this->faker->randomNumber;
        $contentDisposition = $this->faker->word;
        $contentFilename = $this->faker->word;
        $contentId = $this->faker->word;
        $location = $this->faker->word;
        $content = $this->faker->text;

        $calItemType = \Zimbra\Common\Enum\InviteType::TASK();
        $tzStdOffset = $this->faker->randomNumber;
        $tzDayOffset = $this->faker->randomNumber;
        $method = $this->faker->word;
        $componentNum = $this->faker->randomNumber;

        $seq = $this->faker->randomNumber;
        $date = $this->faker->unixTime;
        $attendee = $this->faker->email;
        $rangeType = $this->faker->numberBetween(1, 3);
        $recurId = $this->faker->uuid;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetConvResponse>
            <urn:c id="$id" n="$num" total="$totalSize" f="$flags" t="$tags" tn="$tagNames">
                <urn:meta section="$section">
                    <urn:a n="$key">$value</urn:a>
                </urn:meta>
                <urn:su>$subject</urn:su>
                <urn:chat id="$id" i4uid="$imapUid" cif="$calendarIntendedFor" origid="$origId" rt="r" idnt="$identityId" forAcct="$draftAccountId" autoSendTime="$draftAutoSendTime" sd="$sentDate" rd="$resentDate" part="$part">
                    <urn:fr>$fragment</urn:fr>
                    <urn:e a="$address" d="$display" p="$personal" t="t" isGroup="true" exp="true" />
                    <urn:su>$subject</urn:su>
                    <urn:mid>$messageIdHeader</urn:mid>
                    <urn:irt>$inReplyTo</urn:irt>
                    <urn:inv type="task">
                        <urn:tz id="$id" stdoff="$tzStdOffset" dayoff="$tzDayOffset" />
                        <urn:comp method="$method" compNum="$componentNum" rsvp="true" />
                        <urn:replies>
                            <urn:reply rangeType="$rangeType" recurId="$recurId" seq="$seq" d="$date" at="$attendee" />
                        </urn:replies>
                    </urn:inv>
                    <urn:header n="$key">$value</urn:header>
                    <urn:mp part="$part" ct="$contentType" s="$size" cd="$contentDisposition" filename="$contentFilename" ci="$contentId" cl="$location" body="true" truncated="true">
                        <urn:content>$content</urn:content>
                        <urn:mp part="$part" ct="$contentType" />
                    </urn:mp>
                    <urn:shr truncated="true">
                        <urn:content>$content</urn:content>
                    </urn:shr>
                    <urn:dlSubs truncated="true">
                        <urn:content>$content</urn:content>
                    </urn:dlSubs>
                </urn:chat>
                <urn:m id="$id" i4uid="$imapUid" cif="$calendarIntendedFor" origid="$origId" rt="r" idnt="$identityId" forAcct="$draftAccountId" autoSendTime="$draftAutoSendTime" sd="$sentDate" rd="$resentDate" part="$part">
                    <urn:fr>$fragment</urn:fr>
                    <urn:e a="$address" d="$display" p="$personal" t="t" isGroup="true" exp="true" />
                    <urn:su>$subject</urn:su>
                    <urn:mid>$messageIdHeader</urn:mid>
                    <urn:irt>$inReplyTo</urn:irt>
                    <urn:inv type="task">
                        <urn:tz id="$id" stdoff="$tzStdOffset" dayoff="$tzDayOffset" />
                        <urn:comp method="$method" compNum="$componentNum" rsvp="true" />
                        <urn:replies>
                            <urn:reply rangeType="$rangeType" recurId="$recurId" seq="$seq" d="$date" at="$attendee" />
                        </urn:replies>
                    </urn:inv>
                    <urn:header n="$key">$value</urn:header>
                    <urn:mp part="$part" ct="$contentType" s="$size" cd="$contentDisposition" filename="$contentFilename" ci="$contentId" cl="$location" body="true" truncated="true">
                        <urn:content>$content</urn:content>
                        <urn:mp part="$part" ct="$contentType" />
                    </urn:mp>
                    <urn:shr truncated="true">
                        <urn:content>$content</urn:content>
                    </urn:shr>
                    <urn:dlSubs truncated="true">
                        <urn:content>$content</urn:content>
                    </urn:dlSubs>
                </urn:m>
            </urn:c>
        </urn:GetConvResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->getConv(new \Zimbra\Mail\Struct\ConversationSpec());

        $timezone = new \Zimbra\Mail\Struct\CalTZInfo($id, $tzStdOffset, $tzDayOffset);
        $inviteComponent = new \Zimbra\Mail\Struct\InviteComponent($method, $componentNum, TRUE);
        $calendarReply = new \Zimbra\Mail\Struct\CalendarReply($rangeType, $recurId, $seq, $date, $attendee);
        $invite = new \Zimbra\Mail\Struct\InviteInfo($calItemType, [$timezone], $inviteComponent, [$calendarReply]);
        $header = new \Zimbra\Common\Struct\KeyValuePair($key, $value);
        $email = new \Zimbra\Mail\Struct\EmailInfo($address, $display, $personal, $addressType, TRUE, TRUE);
        $mimePart = new \Zimbra\Mail\Struct\PartInfo($part, $contentType);
        $mp = new \Zimbra\Mail\Struct\PartInfo(
            $part, $contentType, $size, $contentDisposition, $contentFilename, $contentId, $location, TRUE, TRUE, $content, [$mimePart]
        );
        $shr = new \Zimbra\Mail\Struct\ShareNotification(TRUE, $content);
        $dlSubs = new \Zimbra\Mail\Struct\DLSubscriptionNotification(TRUE, $content);
        $metadata = new \Zimbra\Mail\Struct\MailCustomMetadata($section, [new \Zimbra\Common\Struct\KeyValuePair($key, $value)]);
        $chat = new \Zimbra\Mail\Struct\ChatMessageInfo(
            $id, $imapUid, $calendarIntendedFor, $origId, $draftReplyType, $identityId, $draftAccountId, $draftAutoSendTime, $sentDate, $resentDate, $part, $fragment, [$email], $subject, $messageIdHeader, $inReplyTo, $invite, [$header], [$mp], [$shr], [$dlSubs]
        );
        $msg = new \Zimbra\Mail\Struct\MessageInfo(
            $id, $imapUid, $calendarIntendedFor, $origId, $draftReplyType, $identityId, $draftAccountId, $draftAutoSendTime, $sentDate, $resentDate, $part, $fragment, [$email], $subject, $messageIdHeader, $inReplyTo, $invite, [$header], [$mp], [$shr], [$dlSubs]
        );
        $info = new \Zimbra\Mail\Struct\ConversationInfo(
            $id, $num, $totalSize, $flags, $tags, $tagNames, $subject, [$metadata], [$chat], [$msg]
        );

        $this->assertEquals($info, $response->getConversation());
    }

    public function testGetCustomMetadata()
    {
        $id = $this->faker->uuid;
        $section = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->text;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetCustomMetadataResponse id="$id">
            <urn:meta section="$section">
                <urn:a n="$key">$value</urn:a>
            </urn:meta>
        </urn:GetCustomMetadataResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->getCustomMetadata(new \Zimbra\Common\Struct\SectionAttr());

        $meta = new \Zimbra\Mail\Struct\MailCustomMetadata(
            $section, [new \Zimbra\Common\Struct\KeyValuePair($key, $value)]
        );
        $this->assertSame($id, $response->getId());
        $this->assertEquals($meta, $response->getMetadata());
    }

    public function testGetDataSources()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->name;
        $folderId = $this->faker->word;
        $host = $this->faker->ipv4;
        $port = $this->faker->randomNumber;
        $connectionType = \Zimbra\Common\Enum\ConnectionType::CLEAR_TEXT();
        $username = $this->faker->email;
        $password = $this->faker->text;
        $pollingInterval = $this->faker->word;
        $emailAddress = $this->faker->email;
        $smtpHost = $this->faker->ipv4;
        $smtpPort = $this->faker->randomNumber;
        $smtpConnectionType = \Zimbra\Common\Enum\ConnectionType::CLEAR_TEXT();
        $smtpUsername = $this->faker->email;
        $smtpPassword = $this->faker->text;
        $defaultSignature = $this->faker->word;
        $forwardReplySignature = $this->faker->word;
        $fromDisplay = $this->faker->name;
        $replyToAddress = $this->faker->email;
        $replyToDisplay = $this->faker->name;
        $importClass = $this->faker->text;
        $failingSince = $this->faker->randomNumber;
        $lastError = $this->faker->text;
        $refreshToken = $this->faker->text;
        $refreshTokenUrl = $this->faker->url;
        $attribute = $this->faker->unique->text;
        $attribute1 = $this->faker->unique->text;
        $attribute2 = $this->faker->unique->text;
        $attributes = [
            $attribute1,
            $attribute2,
            $attribute,
        ];

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetDataSourcesResponse>
            <urn:imap id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="cleartext" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" smtpEnabled="true" smtpHost="$smtpHost" smtpPort="$smtpPort" smtpConnectionType="cleartext" smtpAuthRequired="true" smtpUsername="$smtpUsername" smtpPassword="$smtpPassword" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl">
                <urn:lastError>$lastError</urn:lastError>
                <urn:a>$attribute1</urn:a>
                <urn:a>$attribute2</urn:a>
                <urn:a>$attribute</urn:a>
            </urn:imap>
            <urn:pop3 id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="cleartext" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" smtpEnabled="true" smtpHost="$smtpHost" smtpPort="$smtpPort" smtpConnectionType="cleartext" smtpAuthRequired="true" smtpUsername="$smtpUsername" smtpPassword="$smtpPassword" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl">
                <urn:lastError>$lastError</urn:lastError>
                <urn:a>$attribute1</urn:a>
                <urn:a>$attribute2</urn:a>
                <urn:a>$attribute</urn:a>
            </urn:pop3>
            <urn:caldav id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="cleartext" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" smtpEnabled="true" smtpHost="$smtpHost" smtpPort="$smtpPort" smtpConnectionType="cleartext" smtpAuthRequired="true" smtpUsername="$smtpUsername" smtpPassword="$smtpPassword" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl">
                <urn:lastError>$lastError</urn:lastError>
                <urn:a>$attribute1</urn:a>
                <urn:a>$attribute2</urn:a>
                <urn:a>$attribute</urn:a>
            </urn:caldav>
            <urn:yab id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="cleartext" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" smtpEnabled="true" smtpHost="$smtpHost" smtpPort="$smtpPort" smtpConnectionType="cleartext" smtpAuthRequired="true" smtpUsername="$smtpUsername" smtpPassword="$smtpPassword" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl">
                <urn:lastError>$lastError</urn:lastError>
                <urn:a>$attribute1</urn:a>
                <urn:a>$attribute2</urn:a>
                <urn:a>$attribute</urn:a>
            </urn:yab>
            <urn:rss id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="cleartext" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" smtpEnabled="true" smtpHost="$smtpHost" smtpPort="$smtpPort" smtpConnectionType="cleartext" smtpAuthRequired="true" smtpUsername="$smtpUsername" smtpPassword="$smtpPassword" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl">
                <urn:lastError>$lastError</urn:lastError>
                <urn:a>$attribute1</urn:a>
                <urn:a>$attribute2</urn:a>
                <urn:a>$attribute</urn:a>
            </urn:rss>
            <urn:gal id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="cleartext" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" smtpEnabled="true" smtpHost="$smtpHost" smtpPort="$smtpPort" smtpConnectionType="cleartext" smtpAuthRequired="true" smtpUsername="$smtpUsername" smtpPassword="$smtpPassword" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl">
                <urn:lastError>$lastError</urn:lastError>
                <urn:a>$attribute1</urn:a>
                <urn:a>$attribute2</urn:a>
                <urn:a>$attribute</urn:a>
            </urn:gal>
            <urn:cal id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="cleartext" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" smtpEnabled="true" smtpHost="$smtpHost" smtpPort="$smtpPort" smtpConnectionType="cleartext" smtpAuthRequired="true" smtpUsername="$smtpUsername" smtpPassword="$smtpPassword" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl">
                <urn:lastError>$lastError</urn:lastError>
                <urn:a>$attribute1</urn:a>
                <urn:a>$attribute2</urn:a>
                <urn:a>$attribute</urn:a>
            </urn:cal>
            <urn:unknown id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="cleartext" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" smtpEnabled="true" smtpHost="$smtpHost" smtpPort="$smtpPort" smtpConnectionType="cleartext" smtpAuthRequired="true" smtpUsername="$smtpUsername" smtpPassword="$smtpPassword" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl">
                <urn:lastError>$lastError</urn:lastError>
                <urn:a>$attribute1</urn:a>
                <urn:a>$attribute2</urn:a>
                <urn:a>$attribute</urn:a>
            </urn:unknown>
        </urn:GetDataSourcesResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->getDataSources();

        $imap = new \Zimbra\Mail\Struct\MailImapDataSource(
            $id, $name, $folderId, TRUE, TRUE, $host, $port, $connectionType, $username, $password, $pollingInterval, $emailAddress,
            TRUE, $smtpHost, $smtpPort, $smtpConnectionType, TRUE, $smtpUsername, $smtpPassword,
            TRUE, $defaultSignature, $forwardReplySignature,$fromDisplay, $replyToAddress, $replyToDisplay, $importClass,
            $failingSince, $lastError, $refreshToken, $refreshTokenUrl, $attributes
        );
        $pop3 = new \Zimbra\Mail\Struct\MailPop3DataSource(
            $id, $name, $folderId, TRUE, TRUE, $host, $port, $connectionType, $username, $password, $pollingInterval, $emailAddress,
            TRUE, $smtpHost, $smtpPort, $smtpConnectionType, TRUE, $smtpUsername, $smtpPassword,
            TRUE, $defaultSignature, $forwardReplySignature,$fromDisplay, $replyToAddress, $replyToDisplay, $importClass,
            $failingSince, $lastError, $refreshToken, $refreshTokenUrl, $attributes
        );
        $caldav = new \Zimbra\Mail\Struct\MailCaldavDataSource(
            $id, $name, $folderId, TRUE, TRUE, $host, $port, $connectionType, $username, $password, $pollingInterval, $emailAddress,
            TRUE, $smtpHost, $smtpPort, $smtpConnectionType, TRUE, $smtpUsername, $smtpPassword,
            TRUE, $defaultSignature, $forwardReplySignature,$fromDisplay, $replyToAddress, $replyToDisplay, $importClass,
            $failingSince, $lastError, $refreshToken, $refreshTokenUrl, $attributes
        );
        $yab = new \Zimbra\Mail\Struct\MailYabDataSource(
            $id, $name, $folderId, TRUE, TRUE, $host, $port, $connectionType, $username, $password, $pollingInterval, $emailAddress,
            TRUE, $smtpHost, $smtpPort, $smtpConnectionType, TRUE, $smtpUsername, $smtpPassword,
            TRUE, $defaultSignature, $forwardReplySignature,$fromDisplay, $replyToAddress, $replyToDisplay, $importClass,
            $failingSince, $lastError, $refreshToken, $refreshTokenUrl, $attributes
        );
        $rss = new \Zimbra\Mail\Struct\MailRssDataSource(
            $id, $name, $folderId, TRUE, TRUE, $host, $port, $connectionType, $username, $password, $pollingInterval, $emailAddress,
            TRUE, $smtpHost, $smtpPort, $smtpConnectionType, TRUE, $smtpUsername, $smtpPassword,
            TRUE, $defaultSignature, $forwardReplySignature,$fromDisplay, $replyToAddress, $replyToDisplay, $importClass,
            $failingSince, $lastError, $refreshToken, $refreshTokenUrl, $attributes
        );
        $gal = new \Zimbra\Mail\Struct\MailGalDataSource(
            $id, $name, $folderId, TRUE, TRUE, $host, $port, $connectionType, $username, $password, $pollingInterval, $emailAddress,
            TRUE, $smtpHost, $smtpPort, $smtpConnectionType, TRUE, $smtpUsername, $smtpPassword,
            TRUE, $defaultSignature, $forwardReplySignature,$fromDisplay, $replyToAddress, $replyToDisplay, $importClass,
            $failingSince, $lastError, $refreshToken, $refreshTokenUrl, $attributes
        );
        $cal = new \Zimbra\Mail\Struct\MailCalDataSource(
            $id, $name, $folderId, TRUE, TRUE, $host, $port, $connectionType, $username, $password, $pollingInterval, $emailAddress,
            TRUE, $smtpHost, $smtpPort, $smtpConnectionType, TRUE, $smtpUsername, $smtpPassword,
            TRUE, $defaultSignature, $forwardReplySignature,$fromDisplay, $replyToAddress, $replyToDisplay, $importClass,
            $failingSince, $lastError, $refreshToken, $refreshTokenUrl, $attributes
        );
        $unknown = new \Zimbra\Mail\Struct\MailUnknownDataSource(
            $id, $name, $folderId, TRUE, TRUE, $host, $port, $connectionType, $username, $password, $pollingInterval, $emailAddress,
            TRUE, $smtpHost, $smtpPort, $smtpConnectionType, TRUE, $smtpUsername, $smtpPassword,
            TRUE, $defaultSignature, $forwardReplySignature,$fromDisplay, $replyToAddress, $replyToDisplay, $importClass,
            $failingSince, $lastError, $refreshToken, $refreshTokenUrl, $attributes
        );

        $this->assertEquals([
            $imap,
            $pop3,
            $caldav,
            $yab,
            $rss,
            $gal,
            $cal,
            $unknown,
        ], $response->getDataSources());
    }

    public function testGetDataSourceUsage()
    {
        $id = $this->faker->uuid;
        $usage = $this->faker->randomNumber;
        $dataSourceQuota = $this->faker->randomNumber;
        $totalQuota = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetDataSourceUsageResponse>
            <urn:dataSourceUsage id="$id" usage="$usage" />
            <urn:dsQuota>$dataSourceQuota</urn:dsQuota>
            <urn:dsTotalQuota>$totalQuota</urn:dsTotalQuota>
        </urn:GetDataSourceUsageResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->getDataSourceUsage();

        $dsUsage = new \Zimbra\Mail\Struct\DataSourceUsage(
            $id, $usage
        );
        $this->assertSame($dataSourceQuota, $response->getDataSourceQuota());
        $this->assertSame($totalQuota, $response->getDataSourceTotalQuota());
        $this->assertEquals([$dsUsage], $response->getUsages());
    }

    public function testGetEffectiveFolderPerms()
    {
        $effectivePermissions = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetEffectiveFolderPermsResponse>
            <urn:folder perm="$effectivePermissions" />
        </urn:GetEffectiveFolderPermsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->getEffectiveFolderPerms(new \Zimbra\Mail\Struct\FolderSpec());

        $folder = new \Zimbra\Mail\Struct\Rights($effectivePermissions);
        $this->assertEquals($folder, $response->getFolder());
    }

    public function testGetFilterRules()
    {
        $index = $this->faker->randomNumber;
        $header = $this->faker->word;
        $name = $this->faker->word;
        $value = $this->faker->word;
        $where = $this->faker->word;
        $time = $this->faker->time;
        $date = $this->faker->unixTime;
        $flag = $this->faker->word;
        $tag = $this->faker->word;
        $method = $this->faker->word;
        $size = $this->faker->word;
        $folder = $this->faker->word;
        $address = $this->faker->word;
        $content = $this->faker->word;
        $subject = $this->faker->word;
        $maxBodySize = $this->faker->randomNumber;
        $origHeaders = $this->faker->word;
        $from = $this->faker->word;
        $importance = $this->faker->word;
        $options = $this->faker->word;
        $message = $this->faker->word;
        $headerName = $this->faker->word;
        $headerValue = $this->faker->word;
        $offset = $this->faker->randomNumber;
        $newName = $this->faker->word;
        $newValue = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetFilterRulesResponse>
            <urn:filterRules>
                <urn:filterRule name="$name" active="true">
                    <urn:filterVariables index="$index">
                        <urn:filterVariable name="$name" value="$value" />
                    </urn:filterVariables>
                    <urn:filterTests condition="allof">
                        <urn:addressBookTest index="$index" negative="true" header="$header"/>
                        <urn:addressTest index="$index" negative="true" header="$header" part="all" stringComparison="is" caseSensitive="true" value="$value" valueComparison="eq" countComparison="eq" valueComparisonComparator="i;octet"/>
                        <urn:envelopeTest index="$index" negative="true" header="$header" part="all" stringComparison="is" caseSensitive="true" value="$value" valueComparison="eq" countComparison="eq" valueComparisonComparator="i;octet"/>
                        <urn:attachmentTest index="$index" negative="true"/>
                        <urn:bodyTest index="$index" negative="true" value="$value" caseSensitive="true"/>
                        <urn:bulkTest index="$index" negative="true"/>
                        <urn:contactRankingTest index="$index" negative="true" header="$header"/>
                        <urn:conversationTest index="$index" negative="true" where="$where"/>
                        <urn:currentDayOfWeekTest index="$index" negative="true" value="$value"/>
                        <urn:currentTimeTest index="$index" negative="true" dateComparison="before" time="$time"/>
                        <urn:dateTest index="$index" negative="true" dateComparison="before" date="$date"/>
                        <urn:facebookTest index="$index" negative="true"/>
                        <urn:flaggedTest index="$index" negative="true" flagName="$flag"/>
                        <urn:headerExistsTest index="$index" negative="true" header="$header"/>
                        <urn:headerTest index="$index" negative="true" header="$header" stringComparison="is" valueComparison="eq" countComparison="eq" valueComparisonComparator="i;octet" value="$value" caseSensitive="true"/>
                        <urn:importanceTest index="$index" negative="true" imp="high"/>
                        <urn:inviteTest index="$index" negative="true">
                            <urn:method>$method</urn:method>
                        </urn:inviteTest>
                        <urn:linkedinTest index="$index" negative="true"/>
                        <urn:listTest index="$index" negative="true"/>
                        <urn:meTest index="$index" negative="true" header="$header"/>
                        <urn:mimeHeaderTest index="$index" negative="true" header="$header" stringComparison="is" value="$value" caseSensitive="true"/>
                        <urn:sizeTest index="$index" negative="true" numberComparison="over" s="$size"/>
                        <urn:socialcastTest index="$index" negative="true"/>
                        <urn:trueTest index="$index" negative="true"/>
                        <urn:twitterTest index="$index" negative="true"/>
                        <urn:communityRequestsTest index="$index" negative="true"/>
                        <urn:communityContentTest index="$index" negative="true"/>
                        <urn:communityConnectionsTest index="$index" negative="true"/>
                    </urn:filterTests>
                    <urn:filterActions>
                        <urn:filterVariables index="$index">
                            <urn:filterVariable name="$name" value="$value" />
                        </urn:filterVariables>
                        <urn:actionKeep index="$index" />
                        <urn:actionDiscard index="$index" />
                        <urn:actionFileInto index="$index" folderPath="$folder" copy="true" />
                        <urn:actionFlag index="$index" flagName="$flag" />
                        <urn:actionTag index="$index" tagName="$tag" />
                        <urn:actionRedirect index="$index" a="$address" copy="true" />
                        <urn:actionReply index="$index">
                            <urn:content>$content</urn:content>
                        </urn:actionReply>
                        <urn:actionNotify index="$index" a="$address" su="$subject" maxBodySize="$maxBodySize" origHeaders="$origHeaders">
                            <urn:content>$content</urn:content>
                        </urn:actionNotify>
                        <urn:actionRFCCompliantNotify index="$index" from="$from" importance="$importance" options="$options" message="$message">
                            <urn:method>$method</urn:method>
                        </urn:actionRFCCompliantNotify>
                        <urn:actionStop index="$index" />
                        <urn:actionReject index="$index">$content</urn:actionReject>
                        <urn:actionEreject index="$index">$content</urn:actionEreject>
                        <urn:actionLog index="$index" level="info">$content</urn:actionLog>
                        <urn:actionAddheader index="$index" last="true">
                            <urn:headerName>$headerName</urn:headerName>
                            <urn:headerValue>$headerValue</urn:headerValue>
                        </urn:actionAddheader>
                        <urn:actionDeleteheader index="$index" last="true" offset="$offset">
                            <urn:test matchType="is" countComparator="true" valueComparator="true" relationalComparator="eq" comparator="i;octet">
                                <urn:headerName>$headerName</urn:headerName>
                                <urn:headerValue>$headerValue</urn:headerValue>
                            </urn:test>
                        </urn:actionDeleteheader>
                        <urn:actionReplaceheader index="$index" last="true" offset="$offset">
                            <urn:test matchType="is" countComparator="true" valueComparator="true" relationalComparator="eq" comparator="i;octet">
                                <urn:headerName>$headerName</urn:headerName>
                                <urn:headerValue>$headerValue</urn:headerValue>
                            </urn:test>
                            <urn:newName>$newName</urn:newName>
                            <urn:newValue>$newValue</urn:newValue>
                        </urn:actionReplaceheader>
                    </urn:filterActions>
                    <urn:nestedRule>
                        <urn:filterTests condition="allof" />
                    </urn:nestedRule>
                </urn:filterRule>
            </urn:filterRules>
        </urn:GetFilterRulesResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->getFilterRules();

        $filterVariables = new \Zimbra\Mail\Struct\FilterVariables($index, [new \Zimbra\Mail\Struct\FilterVariable($name, $value)]);

        $addressBookTest = new \Zimbra\Mail\Struct\AddressBookTest(
            $index, TRUE, $header
        );
        $addressTest = new \Zimbra\Mail\Struct\AddressTest(
            $index, TRUE, $header, \Zimbra\Common\Enum\AddressPart::ALL(), \Zimbra\Common\Enum\StringComparison::IS(), TRUE, $value, \Zimbra\Common\Enum\ValueComparison::EQUAL(), \Zimbra\Common\Enum\CountComparison::EQUAL(), \Zimbra\Common\Enum\ComparisonComparator::OCTET()
        );
        $envelopeTest = new \Zimbra\Mail\Struct\EnvelopeTest(
            $index, TRUE, $header, \Zimbra\Common\Enum\AddressPart::ALL(), \Zimbra\Common\Enum\StringComparison::IS(), TRUE, $value, \Zimbra\Common\Enum\ValueComparison::EQUAL(), \Zimbra\Common\Enum\CountComparison::EQUAL(), \Zimbra\Common\Enum\ComparisonComparator::OCTET()
        );
        $attachmentTest = new \Zimbra\Mail\Struct\AttachmentTest(
            $index, TRUE
        );
        $bodyTest = new \Zimbra\Mail\Struct\BodyTest(
            $index, TRUE, $value, TRUE
        );
        $bulkTest = new \Zimbra\Mail\Struct\BulkTest(
            $index, TRUE
        );
        $contactRankingTest = new \Zimbra\Mail\Struct\ContactRankingTest(
            $index, TRUE, $header
        );
        $conversationTest = new \Zimbra\Mail\Struct\ConversationTest(
            $index, TRUE, $where
        );
        $currentDayOfWeekTest = new \Zimbra\Mail\Struct\CurrentDayOfWeekTest(
            $index, TRUE, $value
        );
        $currentTimeTest = new \Zimbra\Mail\Struct\CurrentTimeTest(
            $index, TRUE, \Zimbra\Common\Enum\DateComparison::BEFORE(), $time
        );
        $dateTest = new \Zimbra\Mail\Struct\DateTest(
            $index, TRUE, \Zimbra\Common\Enum\DateComparison::BEFORE(), $date
        );
        $facebookTest = new \Zimbra\Mail\Struct\FacebookTest(
            $index, TRUE
        );
        $flaggedTest = new \Zimbra\Mail\Struct\FlaggedTest(
            $index, TRUE, $flag
        );
        $headerExistsTest = new \Zimbra\Mail\Struct\HeaderExistsTest(
            $index, TRUE, $header
        );
        $headerTest = new \Zimbra\Mail\Struct\HeaderTest(
            $index, TRUE, $header, \Zimbra\Common\Enum\StringComparison::IS(), \Zimbra\Common\Enum\ValueComparison::EQUAL(), \Zimbra\Common\Enum\CountComparison::EQUAL(), \Zimbra\Common\Enum\ComparisonComparator::OCTET(), $value, TRUE
        );
        $importanceTest = new \Zimbra\Mail\Struct\ImportanceTest(
            $index, TRUE, \Zimbra\Common\Enum\Importance::HIGH()
        );
        $inviteTest = new \Zimbra\Mail\Struct\InviteTest(
            $index, TRUE, [$method]
        );
        $linkedinTest = new \Zimbra\Mail\Struct\LinkedInTest(
            $index, TRUE
        );
        $listTest = new \Zimbra\Mail\Struct\ListTest(
            $index, TRUE
        );
        $meTest = new \Zimbra\Mail\Struct\MeTest(
            $index, TRUE, $header
        );
        $mimeHeaderTest = new \Zimbra\Mail\Struct\MimeHeaderTest(
            $index, TRUE, $header, \Zimbra\Common\Enum\StringComparison::IS(), $value, TRUE
        );
        $sizeTest = new \Zimbra\Mail\Struct\SizeTest(
            $index, TRUE, \Zimbra\Common\Enum\NumberComparison::OVER(), $size
        );
        $socialcastTest = new \Zimbra\Mail\Struct\SocialcastTest(
            $index, TRUE
        );
        $trueTest = new \Zimbra\Mail\Struct\TrueTest(
            $index, TRUE
        );
        $twitterTest = new \Zimbra\Mail\Struct\TwitterTest(
            $index, TRUE
        );
        $communityRequestsTest = new \Zimbra\Mail\Struct\CommunityRequestsTest(
            $index, TRUE
        );
        $communityContentTest = new \Zimbra\Mail\Struct\CommunityContentTest(
            $index, TRUE
        );
        $communityConnectionsTest = new \Zimbra\Mail\Struct\CommunityConnectionsTest(
            $index, TRUE
        );
        $filterTests = new \Zimbra\Mail\Struct\FilterTests(
            \Zimbra\Common\Enum\FilterCondition::ALL_OF(), [
                $addressBookTest,
                $addressTest,
                $envelopeTest,
                $attachmentTest,
                $bodyTest,
                $bulkTest,
                $contactRankingTest,
                $conversationTest,
                $currentDayOfWeekTest,
                $currentTimeTest,
                $dateTest,
                $facebookTest,
                $flaggedTest,
                $headerExistsTest,
                $headerTest,
                $importanceTest,
                $inviteTest,
                $linkedinTest,
                $listTest,
                $meTest,
                $mimeHeaderTest,
                $sizeTest,
                $socialcastTest,
                $trueTest,
                $twitterTest,
                $communityRequestsTest,
                $communityContentTest,
                $communityConnectionsTest,
            ]
        );

        $actionKeep = new \Zimbra\Mail\Struct\KeepAction($index);
        $actionDiscard = new \Zimbra\Mail\Struct\DiscardAction($index);
        $actionFileInto = new \Zimbra\Mail\Struct\FileIntoAction($index, $folder, TRUE);
        $actionFlag = new \Zimbra\Mail\Struct\FlagAction($index, $flag);
        $actionTag = new \Zimbra\Mail\Struct\TagAction($index, $tag, TRUE);
        $actionRedirect = new \Zimbra\Mail\Struct\RedirectAction($index, $address, TRUE);
        $actionReply = new \Zimbra\Mail\Struct\ReplyAction($index, $content, TRUE);
        $actionNotify = new \Zimbra\Mail\Struct\NotifyAction($index, $address, $subject, $maxBodySize, $content, $origHeaders);
        $actionRFCCompliantNotify = new \Zimbra\Mail\Struct\RFCCompliantNotifyAction($index, $from, $importance, $options, $message, $method);
        $actionStop = new \Zimbra\Mail\Struct\StopAction($index);
        $actionReject = new \Zimbra\Mail\Struct\RejectAction($index, $content);
        $actionEreject = new \Zimbra\Mail\Struct\ErejectAction($index, $content);
        $actionLog = new \Zimbra\Mail\Struct\LogAction($index, \Zimbra\Common\Enum\LoggingLevel::INFO(), $content);
        $actionAddheader = new \Zimbra\Mail\Struct\AddheaderAction($index, $headerName, $headerValue, TRUE);
        $actionDeleteheader = new \Zimbra\Mail\Struct\DeleteheaderAction(
            $index, TRUE, $offset
            , new \Zimbra\Mail\Struct\EditheaderTest(\Zimbra\Common\Enum\MatchType::IS(), TRUE, TRUE, \Zimbra\Common\Enum\RelationalComparator::EQUAL(), \Zimbra\Common\Enum\ComparisonComparator::OCTET(), $headerName, [$headerValue])
        );
        $actionReplaceheader = new \Zimbra\Mail\Struct\ReplaceheaderAction(
            $index, TRUE, $offset,
            new \Zimbra\Mail\Struct\EditheaderTest(\Zimbra\Common\Enum\MatchType::IS(), TRUE, TRUE, \Zimbra\Common\Enum\RelationalComparator::EQUAL(), \Zimbra\Common\Enum\ComparisonComparator::OCTET(), $headerName, [$headerValue]),
            $newName, $newValue
        );

        $child = new \Zimbra\Mail\Struct\NestedRule(new \Zimbra\Mail\Struct\FilterTests(\Zimbra\Common\Enum\FilterCondition::ALL_OF()));
        $filterRule = new \Zimbra\Mail\Struct\FilterRule($filterTests, $name, TRUE, $filterVariables, [
            $filterVariables,
            $actionKeep,
            $actionDiscard,
            $actionFileInto,
            $actionFlag,
            $actionTag,
            $actionRedirect,
            $actionReply,
            $actionNotify,
            $actionRFCCompliantNotify,
            $actionStop,
            $actionReject,
            $actionEreject,
            $actionLog,
            $actionAddheader,
            $actionDeleteheader,
            $actionReplaceheader,
        ], $child);

        $this->assertEquals([$filterRule], $response->getFilterRules());
    }

    public function testGetFolder()
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
        $view = \Zimbra\Common\Enum\ViewType::CONVERSATION();
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
        $perm = implode(',', [\Zimbra\Common\Enum\RemoteFolderAccess::CREATE(), \Zimbra\Common\Enum\RemoteFolderAccess::READ()]);
        $restUrl = $this->faker->word;
        $lifetime = $this->faker->word;
        $section = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->text;

        $internalGrantExpiry = $this->faker->randomNumber;
        $guestGrantExpiry = $this->faker->randomNumber;

        $grantRight = implode(',', [\Zimbra\Common\Enum\ActionGrantRight::READ(), \Zimbra\Common\Enum\ActionGrantRight::WRITE()]);
        $granteeType = \Zimbra\Common\Enum\GrantGranteeType::USR();
        $granteeId = $this->faker->uuid;
        $expiry = $this->faker->unixTime;
        $granteeName = $this->faker->name;
        $guestPassword = $this->faker->word;
        $accessKey = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
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

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->getFolder();

        $metadata = new \Zimbra\Mail\Struct\MailCustomMetadata($section, [new \Zimbra\Common\Struct\KeyValuePair($key, $value)]);
        $acl = new \Zimbra\Mail\Struct\Acl(
            $internalGrantExpiry, $guestGrantExpiry, [new \Zimbra\Mail\Struct\Grant(
                $grantRight, $granteeType, $granteeId, $expiry, $granteeName, $guestPassword, $accessKey
            )]
        );
        $retentionPolicy = new \Zimbra\Mail\Struct\RetentionPolicy(
            [new \Zimbra\Mail\Struct\Policy(\Zimbra\Common\Enum\Type::SYSTEM(), $id, $name, $lifetime)],
            [new \Zimbra\Mail\Struct\Policy(\Zimbra\Common\Enum\Type::USER(), $id, $name, $lifetime)]
        );
        $subFolder = new \Zimbra\Mail\Struct\Folder($id, $uuid);
        $mountpoint = new \Zimbra\Mail\Struct\Mountpoint($id, $uuid);
        $searchFolder = new \Zimbra\Mail\Struct\SearchFolder($id, $uuid);

        $folder = new \Zimbra\Mail\Struct\Folder(
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
        $this->assertEquals($folder, $response->getFolder());
    }

    public function testGetFreeBusy()
    {
        $startTime = $this->faker->unixTime;
        $endTime = $this->faker->unixTime;
        $id = $this->faker->uuid;
        $subject = $this->faker->text;
        $location = $this->faker->text;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetFreeBusyResponse>
            <urn:usr id="$id">
                <urn:f s="$startTime" e="$endTime" eventId="$id" subject="$subject" location="$location" isMeeting="true" isRecurring="true" isException="true" isReminderSet="true" isPrivate="true" hasPermission="true" />
                <urn:b s="$startTime" e="$endTime" eventId="$id" subject="$subject" location="$location" isMeeting="true" isRecurring="true" isException="true" isReminderSet="true" isPrivate="true" hasPermission="true" />
                <urn:t s="$startTime" e="$endTime" eventId="$id" subject="$subject" location="$location" isMeeting="true" isRecurring="true" isException="true" isReminderSet="true" isPrivate="true" hasPermission="true" />
                <urn:u s="$startTime" e="$endTime" eventId="$id" subject="$subject" location="$location" isMeeting="true" isRecurring="true" isException="true" isReminderSet="true" isPrivate="true" hasPermission="true" />
                <urn:n s="$startTime" e="$endTime" eventId="$id" subject="$subject" location="$location" isMeeting="true" isRecurring="true" isException="true" isReminderSet="true" isPrivate="true" hasPermission="true" />
            </urn:usr>
        </urn:GetFreeBusyResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->getFreeBusy($startTime, $endTime);

        $freeSlot = new \Zimbra\Mail\Struct\FreeBusyFREEslot(
            $startTime, $endTime, $id, $subject, $location, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE
        );
        $busySlot = new \Zimbra\Mail\Struct\FreeBusyBUSYslot(
            $startTime, $endTime, $id, $subject, $location, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE
        );
        $tentativeSlot = new \Zimbra\Mail\Struct\FreeBusyBUSYTENTATIVEslot(
            $startTime, $endTime, $id, $subject, $location, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE
        );
        $unavailableSlot = new \Zimbra\Mail\Struct\FreeBusyBUSYUNAVAILABLEslot(
            $startTime, $endTime, $id, $subject, $location, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE
        );
        $noDataSlot = new \Zimbra\Mail\Struct\FreeBusyNODATAslot(
            $startTime, $endTime, $id, $subject, $location, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE
        );
        $usr = new \Zimbra\Mail\Struct\FreeBusyUserInfo($id, [
            $freeSlot,
            $busySlot,
            $tentativeSlot,
            $unavailableSlot,
            $noDataSlot,
        ]);
        $this->assertEquals([$usr], $response->getFreebusyUsers());
    }

    public function testGetICal()
    {
        $id = $this->faker->uuid;
        $ical = $this->faker->text;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetICalResponse>
            <urn:ical id="$id">$ical</urn:ical>
        </urn:GetICalResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->getICal();
        $content = new \Zimbra\Mail\Struct\ICalContent(
            $id, $ical
        );
        $this->assertEquals($content, $response->getContent());
    }

    public function testGetIMAPRecentCutoff()
    {
        $cutoff = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetIMAPRecentCutoffResponse cutoff="$cutoff" />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->getIMAPRecentCutoff($this->faker->uuid);
        $this->assertSame($cutoff, $response->getCutoff());
    }

    public function testGetIMAPRecent()
    {
        $id = $this->faker->uuid;
        $num = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetIMAPRecentResponse n="$num" />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->getIMAPRecent($this->faker->uuid);
        $this->assertSame($num, $response->getNum());
    }

    public function testGetImportStatus()
    {
        $id = $this->faker->uuid;
        $error = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetImportStatusResponse>
            <urn:imap id="$id" isRunning="true" success="true" error="$error" />
            <urn:pop3 id="$id" isRunning="true" success="true" error="$error" />
            <urn:caldav id="$id" isRunning="true" success="true" error="$error" />
            <urn:yab id="$id" isRunning="true" success="true" error="$error" />
            <urn:rss id="$id" isRunning="true" success="true" error="$error" />
            <urn:gal id="$id" isRunning="true" success="true" error="$error" />
            <urn:cal id="$id" isRunning="true" success="true" error="$error" />
            <urn:unknown id="$id" isRunning="true" success="true" error="$error" />
        </urn:GetImportStatusResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->getImportStatus();

        $this->assertEquals([
            new \Zimbra\Mail\Struct\ImapImportStatusInfo(
                $id, TRUE, TRUE, $error
            ),
            new \Zimbra\Mail\Struct\Pop3ImportStatusInfo(
                $id, TRUE, TRUE, $error
            ),
            new \Zimbra\Mail\Struct\CaldavImportStatusInfo(
                $id, TRUE, TRUE, $error
            ),
            new \Zimbra\Mail\Struct\YabImportStatusInfo(
                $id, TRUE, TRUE, $error
            ),
            new \Zimbra\Mail\Struct\RssImportStatusInfo(
                $id, TRUE, TRUE, $error
            ),
            new \Zimbra\Mail\Struct\GalImportStatusInfo(
                $id, TRUE, TRUE, $error
            ),
            new \Zimbra\Mail\Struct\CalImportStatusInfo(
                $id, TRUE, TRUE, $error
            ),
            new \Zimbra\Mail\Struct\UnknownImportStatusInfo(
                $id, TRUE, TRUE, $error
            ),
        ], $response->getStatuses());
    }

    public function testGetItem()
    {
        $id = $this->faker->uuid;
        $uuid = $this->faker->uuid;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetItemResponse>
            <urn:folder id="$id" uuid="$uuid" />
        </urn:GetItemResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->getItem(new \Zimbra\Mail\Struct\ItemSpec());
        $folder = new \Zimbra\Mail\Struct\Folder($id, $uuid);
        $this->assertEquals($folder, $response->getFolderItem());
    }

    public function testGetLastItemIdInMailbox()
    {
        $id = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetLastItemIdInMailboxResponse>
            <urn:id>$id</urn:id>
        </urn:GetLastItemIdInMailboxResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->getLastItemIdInMailbox();
        $this->assertSame($id, $response->getId());
    }

    public function testGetMailboxMetadata()
    {
        $section = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->text;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetMailboxMetadataResponse>
            <urn:meta section="$section">
                <urn:a n="$key">$value</urn:a>
            </urn:meta>
        </urn:GetMailboxMetadataResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->getMailboxMetadata(new \Zimbra\Common\Struct\SectionAttr());
        $meta = new \Zimbra\Mail\Struct\MailCustomMetadata(
            $section, [new \Zimbra\Common\Struct\KeyValuePair($key, $value)]
        );
        $this->assertEquals($meta, $response->getMetadata());
    }

    public function testGetMiniCal()
    {
        $id = $this->faker->uuid;
        $startTime = $this->faker->unixTime;
        $endTime = $this->faker->unixTime;
        $code = $this->faker->word;
        $errorMessage = $this->faker->word;
        $date1 = $this->faker->date('Y/m/d');
        $date2 = $this->faker->date('Y/m/d');

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetMiniCalResponse>
            <urn:date>$date1</urn:date>
            <urn:date>$date2</urn:date>
            <urn:error id="$id" code="$code">$errorMessage</urn:error>
        </urn:GetMiniCalResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->getMiniCal($startTime, $endTime);

        $error = new \Zimbra\Mail\Struct\MiniCalError(
            $id, $code, $errorMessage
        );
        $this->assertSame([$date1, $date2], $response->getBusyDates());
        $this->assertEquals([$error], $response->getErrors());
    }

    public function testGetModifiedItemsIDs()
    {
        $folderId = $this->faker->randomNumber;
        $modSeq = $this->faker->randomNumber;
        $id1 = $this->faker->unique->randomNumber;
        $id2 = $this->faker->unique->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetModifiedItemsIDsResponse>
            <urn:ids>$id1</urn:ids>
            <urn:ids>$id2</urn:ids>
        </urn:GetModifiedItemsIDsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->getModifiedItemsIDs($folderId, $modSeq);
        $this->assertSame([$id1, $id2], $response->getIds());
    }

    public function testGetMsgMetadata()
    {
        $id = $this->faker->uuid;
        $autoSendTime = $this->faker->unixTime;
        $subject = $this->faker->text;
        $fragment = $this->faker->text;

        $address = $this->faker->email;
        $display = $this->faker->name;
        $personal = $this->faker->word;
        $addressType = \Zimbra\Common\Enum\AddressType::TO();
        $calItemType = \Zimbra\Common\Enum\InviteType::TASK();

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetMsgMetadataResponse>
            <urn:chat id="$id" autoSendTime="$autoSendTime">
                <urn:e a="$address" d="$display" p="$personal" t="t" />
                <urn:su>$subject</urn:su>
                <urn:fr>$fragment</urn:fr>
                <urn:inv type="task" />
            </urn:chat>
            <urn:m id="$id" autoSendTime="$autoSendTime">
                <urn:e a="$address" d="$display" p="$personal" t="t" />
                <urn:su>$subject</urn:su>
                <urn:fr>$fragment</urn:fr>
                <urn:inv type="task" />
            </urn:m>
        </urn:GetMsgMetadataResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->getMsgMetadata(new \Zimbra\Mail\Struct\IdsAttr());

        $email = new \Zimbra\Mail\Struct\EmailInfo($address, $display, $personal, $addressType);
        $invite = new \Zimbra\Mail\Struct\InviteInfo($calItemType);
        $chat = new \Zimbra\Mail\Struct\ChatSummary($id, $autoSendTime, [$email], $subject, $fragment, $invite);
        $msg = new \Zimbra\Mail\Struct\MessageSummary($id, $autoSendTime, [$email], $subject, $fragment, $invite);

        $this->assertEquals([$chat], $response->getChatMessages());
        $this->assertEquals([$msg], $response->getMsgMessages());
    }

    public function testGetMsg()
    {
        $id = $this->faker->uuid;
        $imapUid = $this->faker->randomNumber;
        $calendarIntendedFor = $this->faker->word;
        $origId = $this->faker->uuid;
        $draftReplyType = \Zimbra\Common\Enum\ReplyType::REPLIED();
        $identityId = $this->faker->uuid;
        $draftAccountId = $this->faker->email;
        $draftAutoSendTime = $this->faker->unixTime;
        $sentDate = $this->faker->unixTime;
        $resentDate = $this->faker->unixTime;
        $part = $this->faker->word;
        $fragment = $this->faker->word;
        $subject = $this->faker->word;
        $messageIdHeader = $this->faker->uuid;
        $inReplyTo = $this->faker->uuid;
        $key = $this->faker->name;
        $value = $this->faker->word;

        $address = $this->faker->email;
        $display = $this->faker->name;
        $personal = $this->faker->word;
        $addressType = \Zimbra\Common\Enum\AddressType::TO();

        $calItemType = \Zimbra\Common\Enum\InviteType::TASK();
        $tzStdOffset = $this->faker->randomNumber;
        $tzDayOffset = $this->faker->randomNumber;
        $method = $this->faker->word;
        $componentNum = $this->faker->randomNumber;

        $seq = $this->faker->randomNumber;
        $date = $this->faker->unixTime;
        $attendee = $this->faker->email;
        $rangeType = $this->faker->numberBetween(1, 3);
        $recurId = $this->faker->uuid;
        $contentType = $this->faker->mimeType;
        $content = $this->faker->text;
        $contentId = $this->faker->uuid;
        $url = $this->faker->url;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetMsgResponse>
            <urn:m id="$id" i4uid="$imapUid" cif="$calendarIntendedFor" origid="$origId" rt="r" idnt="$identityId" forAcct="$draftAccountId" autoSendTime="$draftAutoSendTime" sd="$sentDate" rd="$resentDate" part="$part">
                <urn:fr>$fragment</urn:fr>
                <urn:e a="$address" d="$display" p="$personal" t="t" isGroup="true" exp="true" />
                <urn:su>$subject</urn:su>
                <urn:mid>$messageIdHeader</urn:mid>
                <urn:irt>$inReplyTo</urn:irt>
                <urn:inv type="task">
                    <urn:tz id="$id" stdoff="$tzStdOffset" dayoff="$tzDayOffset" />
                    <urn:comp method="$method" compNum="$componentNum" rsvp="true" />
                    <urn:replies>
                        <urn:reply rangeType="$rangeType" recurId="$recurId" seq="$seq" d="$date" at="$attendee" />
                    </urn:replies>
                </urn:inv>
                <urn:header n="$key">$value</urn:header>
                <urn:mp ct="$contentType" content="$content" ci="$contentId" />
                <urn:shr truncated="true">
                    <urn:content>$content</urn:content>
                </urn:shr>
                <urn:dlSubs truncated="true">
                    <urn:content>$content</urn:content>
                </urn:dlSubs>
                <urn:content url="$url">$value</urn:content>
            </urn:m>
        </urn:GetMsgResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->getMsg(new \Zimbra\Mail\Struct\MsgSpec());

        $timezone = new \Zimbra\Mail\Struct\CalTZInfo($id, $tzStdOffset, $tzDayOffset);
        $inviteComponent = new \Zimbra\Mail\Struct\InviteComponentWithGroupInfo($method, $componentNum, TRUE);
        $calendarReply = new \Zimbra\Mail\Struct\CalendarReply($rangeType, $recurId, $seq, $date, $attendee);
        $email = new \Zimbra\Mail\Struct\EmailInfo($address, $display, $personal, $addressType, TRUE, TRUE);
        $invite = new \Zimbra\Mail\Struct\InviteWithGroupInfo(
            $calItemType, [$timezone], [$inviteComponent], [$calendarReply]
        );
        $header = new \Zimbra\Common\Struct\KeyValuePair($key, $value);
        $mimePart = new \Zimbra\Mail\Struct\MimePartInfo($contentType, $content, $contentId);
        $shr = new \Zimbra\Mail\Struct\ShareNotification(TRUE, $content);
        $dlSubs = new \Zimbra\Mail\Struct\DLSubscriptionNotification(TRUE, $content);
        $urlValue = new \Zimbra\Common\Struct\UrlAndValue($url, $value);
        $msg = new \Zimbra\Mail\Struct\MsgWithGroupInfo(
            $id, $imapUid, $calendarIntendedFor, $origId, $draftReplyType, $identityId, $draftAccountId, $draftAutoSendTime, $sentDate, $resentDate, $part, $fragment, [$email], $subject, $messageIdHeader, $inReplyTo, $invite, [$header], $mimePart, $shr, $dlSubs, $urlValue
        );
        $this->assertEquals($msg, $response->getMsg());
    }

    public function testGetNote()
    {
        $id = $this->faker->uuid;
        $parentId = $this->faker->uuid;
        $revision =  $this->faker->randomNumber;
        $folder = $this->faker->uuid;
        $date = $this->faker->randomNumber;
        $flags = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;
        $bounds = $this->faker->word;
        $color = $this->faker->numberBetween(0, 127);
        $rgb = $this->faker->hexcolor;
        $changeDate =  $this->faker->unixTime;
        $modifiedSequence =  $this->faker->randomNumber;
        $content = $this->faker->word;
        $section = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->text;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetNoteResponse>
            <urn:note id="$id" rev="$revision" l="$folder" d="$date" f="$flags" t="$tags" tn="$tagNames" pos="$bounds" color="$color" rgb="$rgb" md="$changeDate" ms="$modifiedSequence">
                <urn:content>$content</urn:content>
                <urn:meta section="$section">
                    <urn:a n="$key">$value</urn:a>
                </urn:meta>
            </urn:note>
        </urn:GetNoteResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->getNote(new \Zimbra\Common\Struct\Id());

        $metadata = new \Zimbra\Mail\Struct\MailCustomMetadata(
            $section, [new \Zimbra\Common\Struct\KeyValuePair($key, $value)]
        );
        $note = new \Zimbra\Mail\Struct\NoteInfo(
            $id,
            $revision,
            $folder,
            $date,
            $flags,
            $tags,
            $tagNames,
            $bounds,
            $color,
            $rgb,
            $changeDate,
            $modifiedSequence,
            $content,
            [$metadata]
        );
        $this->assertEquals($note, $response->getNote());
    }

    public function testGetOutgoingFilterRules()
    {
        $index = $this->faker->randomNumber;
        $header = $this->faker->word;
        $name = $this->faker->word;
        $value = $this->faker->word;
        $where = $this->faker->word;
        $time = $this->faker->time;
        $date = $this->faker->unixTime;
        $flag = $this->faker->word;
        $tag = $this->faker->word;
        $method = $this->faker->word;
        $size = $this->faker->word;
        $folder = $this->faker->word;
        $address = $this->faker->word;
        $content = $this->faker->word;
        $subject = $this->faker->word;
        $maxBodySize = $this->faker->randomNumber;
        $origHeaders = $this->faker->word;
        $from = $this->faker->word;
        $importance = $this->faker->word;
        $options = $this->faker->word;
        $message = $this->faker->word;
        $headerName = $this->faker->word;
        $headerValue = $this->faker->word;
        $offset = $this->faker->randomNumber;
        $newName = $this->faker->word;
        $newValue = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetOutgoingFilterRulesResponse>
            <urn:filterRules>
                <urn:filterRule name="$name" active="true">
                    <urn:filterVariables index="$index">
                        <urn:filterVariable name="$name" value="$value" />
                    </urn:filterVariables>
                    <urn:filterTests condition="allof">
                        <urn:addressBookTest index="$index" negative="true" header="$header"/>
                        <urn:addressTest index="$index" negative="true" header="$header" part="all" stringComparison="is" caseSensitive="true" value="$value" valueComparison="eq" countComparison="eq" valueComparisonComparator="i;octet"/>
                        <urn:envelopeTest index="$index" negative="true" header="$header" part="all" stringComparison="is" caseSensitive="true" value="$value" valueComparison="eq" countComparison="eq" valueComparisonComparator="i;octet"/>
                        <urn:attachmentTest index="$index" negative="true"/>
                        <urn:bodyTest index="$index" negative="true" value="$value" caseSensitive="true"/>
                        <urn:bulkTest index="$index" negative="true"/>
                        <urn:contactRankingTest index="$index" negative="true" header="$header"/>
                        <urn:conversationTest index="$index" negative="true" where="$where"/>
                        <urn:currentDayOfWeekTest index="$index" negative="true" value="$value"/>
                        <urn:currentTimeTest index="$index" negative="true" dateComparison="before" time="$time"/>
                        <urn:dateTest index="$index" negative="true" dateComparison="before" date="$date"/>
                        <urn:facebookTest index="$index" negative="true"/>
                        <urn:flaggedTest index="$index" negative="true" flagName="$flag"/>
                        <urn:headerExistsTest index="$index" negative="true" header="$header"/>
                        <urn:headerTest index="$index" negative="true" header="$header" stringComparison="is" valueComparison="eq" countComparison="eq" valueComparisonComparator="i;octet" value="$value" caseSensitive="true"/>
                        <urn:importanceTest index="$index" negative="true" imp="high"/>
                        <urn:inviteTest index="$index" negative="true">
                            <urn:method>$method</urn:method>
                        </urn:inviteTest>
                        <urn:linkedinTest index="$index" negative="true"/>
                        <urn:listTest index="$index" negative="true"/>
                        <urn:meTest index="$index" negative="true" header="$header"/>
                        <urn:mimeHeaderTest index="$index" negative="true" header="$header" stringComparison="is" value="$value" caseSensitive="true"/>
                        <urn:sizeTest index="$index" negative="true" numberComparison="over" s="$size"/>
                        <urn:socialcastTest index="$index" negative="true"/>
                        <urn:trueTest index="$index" negative="true"/>
                        <urn:twitterTest index="$index" negative="true"/>
                        <urn:communityRequestsTest index="$index" negative="true"/>
                        <urn:communityContentTest index="$index" negative="true"/>
                        <urn:communityConnectionsTest index="$index" negative="true"/>
                    </urn:filterTests>
                    <urn:filterActions>
                        <urn:filterVariables index="$index">
                            <urn:filterVariable name="$name" value="$value" />
                        </urn:filterVariables>
                        <urn:actionKeep index="$index" />
                        <urn:actionDiscard index="$index" />
                        <urn:actionFileInto index="$index" folderPath="$folder" copy="true" />
                        <urn:actionFlag index="$index" flagName="$flag" />
                        <urn:actionTag index="$index" tagName="$tag" />
                        <urn:actionRedirect index="$index" a="$address" copy="true" />
                        <urn:actionReply index="$index">
                            <urn:content>$content</urn:content>
                        </urn:actionReply>
                        <urn:actionNotify index="$index" a="$address" su="$subject" maxBodySize="$maxBodySize" origHeaders="$origHeaders">
                            <urn:content>$content</urn:content>
                        </urn:actionNotify>
                        <urn:actionRFCCompliantNotify index="$index" from="$from" importance="$importance" options="$options" message="$message">
                            <urn:method>$method</urn:method>
                        </urn:actionRFCCompliantNotify>
                        <urn:actionStop index="$index" />
                        <urn:actionReject index="$index">$content</urn:actionReject>
                        <urn:actionEreject index="$index">$content</urn:actionEreject>
                        <urn:actionLog index="$index" level="info">$content</urn:actionLog>
                        <urn:actionAddheader index="$index" last="true">
                            <urn:headerName>$headerName</urn:headerName>
                            <urn:headerValue>$headerValue</urn:headerValue>
                        </urn:actionAddheader>
                        <urn:actionDeleteheader index="$index" last="true" offset="$offset">
                            <urn:test matchType="is" countComparator="true" valueComparator="true" relationalComparator="eq" comparator="i;octet">
                                <urn:headerName>$headerName</urn:headerName>
                                <urn:headerValue>$headerValue</urn:headerValue>
                            </urn:test>
                        </urn:actionDeleteheader>
                        <urn:actionReplaceheader index="$index" last="true" offset="$offset">
                            <urn:test matchType="is" countComparator="true" valueComparator="true" relationalComparator="eq" comparator="i;octet">
                                <urn:headerName>$headerName</urn:headerName>
                                <urn:headerValue>$headerValue</urn:headerValue>
                            </urn:test>
                            <urn:newName>$newName</urn:newName>
                            <urn:newValue>$newValue</urn:newValue>
                        </urn:actionReplaceheader>
                    </urn:filterActions>
                    <urn:nestedRule>
                        <urn:filterTests condition="allof" />
                    </urn:nestedRule>
                </urn:filterRule>
            </urn:filterRules>
        </urn:GetOutgoingFilterRulesResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->getOutgoingFilterRules();

        $filterVariables = new \Zimbra\Mail\Struct\FilterVariables($index, [new \Zimbra\Mail\Struct\FilterVariable($name, $value)]);

        $addressBookTest = new \Zimbra\Mail\Struct\AddressBookTest(
            $index, TRUE, $header
        );
        $addressTest = new \Zimbra\Mail\Struct\AddressTest(
            $index, TRUE, $header, \Zimbra\Common\Enum\AddressPart::ALL(), \Zimbra\Common\Enum\StringComparison::IS(), TRUE, $value, \Zimbra\Common\Enum\ValueComparison::EQUAL(), \Zimbra\Common\Enum\CountComparison::EQUAL(), \Zimbra\Common\Enum\ComparisonComparator::OCTET()
        );
        $envelopeTest = new \Zimbra\Mail\Struct\EnvelopeTest(
            $index, TRUE, $header, \Zimbra\Common\Enum\AddressPart::ALL(), \Zimbra\Common\Enum\StringComparison::IS(), TRUE, $value, \Zimbra\Common\Enum\ValueComparison::EQUAL(), \Zimbra\Common\Enum\CountComparison::EQUAL(), \Zimbra\Common\Enum\ComparisonComparator::OCTET()
        );
        $attachmentTest = new \Zimbra\Mail\Struct\AttachmentTest(
            $index, TRUE
        );
        $bodyTest = new \Zimbra\Mail\Struct\BodyTest(
            $index, TRUE, $value, TRUE
        );
        $bulkTest = new \Zimbra\Mail\Struct\BulkTest(
            $index, TRUE
        );
        $contactRankingTest = new \Zimbra\Mail\Struct\ContactRankingTest(
            $index, TRUE, $header
        );
        $conversationTest = new \Zimbra\Mail\Struct\ConversationTest(
            $index, TRUE, $where
        );
        $currentDayOfWeekTest = new \Zimbra\Mail\Struct\CurrentDayOfWeekTest(
            $index, TRUE, $value
        );
        $currentTimeTest = new \Zimbra\Mail\Struct\CurrentTimeTest(
            $index, TRUE, \Zimbra\Common\Enum\DateComparison::BEFORE(), $time
        );
        $dateTest = new \Zimbra\Mail\Struct\DateTest(
            $index, TRUE, \Zimbra\Common\Enum\DateComparison::BEFORE(), $date
        );
        $facebookTest = new \Zimbra\Mail\Struct\FacebookTest(
            $index, TRUE
        );
        $flaggedTest = new \Zimbra\Mail\Struct\FlaggedTest(
            $index, TRUE, $flag
        );
        $headerExistsTest = new \Zimbra\Mail\Struct\HeaderExistsTest(
            $index, TRUE, $header
        );
        $headerTest = new \Zimbra\Mail\Struct\HeaderTest(
            $index, TRUE, $header, \Zimbra\Common\Enum\StringComparison::IS(), \Zimbra\Common\Enum\ValueComparison::EQUAL(), \Zimbra\Common\Enum\CountComparison::EQUAL(), \Zimbra\Common\Enum\ComparisonComparator::OCTET(), $value, TRUE
        );
        $importanceTest = new \Zimbra\Mail\Struct\ImportanceTest(
            $index, TRUE, \Zimbra\Common\Enum\Importance::HIGH()
        );
        $inviteTest = new \Zimbra\Mail\Struct\InviteTest(
            $index, TRUE, [$method]
        );
        $linkedinTest = new \Zimbra\Mail\Struct\LinkedInTest(
            $index, TRUE
        );
        $listTest = new \Zimbra\Mail\Struct\ListTest(
            $index, TRUE
        );
        $meTest = new \Zimbra\Mail\Struct\MeTest(
            $index, TRUE, $header
        );
        $mimeHeaderTest = new \Zimbra\Mail\Struct\MimeHeaderTest(
            $index, TRUE, $header, \Zimbra\Common\Enum\StringComparison::IS(), $value, TRUE
        );
        $sizeTest = new \Zimbra\Mail\Struct\SizeTest(
            $index, TRUE, \Zimbra\Common\Enum\NumberComparison::OVER(), $size
        );
        $socialcastTest = new \Zimbra\Mail\Struct\SocialcastTest(
            $index, TRUE
        );
        $trueTest = new \Zimbra\Mail\Struct\TrueTest(
            $index, TRUE
        );
        $twitterTest = new \Zimbra\Mail\Struct\TwitterTest(
            $index, TRUE
        );
        $communityRequestsTest = new \Zimbra\Mail\Struct\CommunityRequestsTest(
            $index, TRUE
        );
        $communityContentTest = new \Zimbra\Mail\Struct\CommunityContentTest(
            $index, TRUE
        );
        $communityConnectionsTest = new \Zimbra\Mail\Struct\CommunityConnectionsTest(
            $index, TRUE
        );
        $filterTests = new \Zimbra\Mail\Struct\FilterTests(
            \Zimbra\Common\Enum\FilterCondition::ALL_OF(), [
                $addressBookTest,
                $addressTest,
                $envelopeTest,
                $attachmentTest,
                $bodyTest,
                $bulkTest,
                $contactRankingTest,
                $conversationTest,
                $currentDayOfWeekTest,
                $currentTimeTest,
                $dateTest,
                $facebookTest,
                $flaggedTest,
                $headerExistsTest,
                $headerTest,
                $importanceTest,
                $inviteTest,
                $linkedinTest,
                $listTest,
                $meTest,
                $mimeHeaderTest,
                $sizeTest,
                $socialcastTest,
                $trueTest,
                $twitterTest,
                $communityRequestsTest,
                $communityContentTest,
                $communityConnectionsTest,
            ]
        );

        $actionKeep = new \Zimbra\Mail\Struct\KeepAction($index);
        $actionDiscard = new \Zimbra\Mail\Struct\DiscardAction($index);
        $actionFileInto = new \Zimbra\Mail\Struct\FileIntoAction($index, $folder, TRUE);
        $actionFlag = new \Zimbra\Mail\Struct\FlagAction($index, $flag);
        $actionTag = new \Zimbra\Mail\Struct\TagAction($index, $tag, TRUE);
        $actionRedirect = new \Zimbra\Mail\Struct\RedirectAction($index, $address, TRUE);
        $actionReply = new \Zimbra\Mail\Struct\ReplyAction($index, $content, TRUE);
        $actionNotify = new \Zimbra\Mail\Struct\NotifyAction($index, $address, $subject, $maxBodySize, $content, $origHeaders);
        $actionRFCCompliantNotify = new \Zimbra\Mail\Struct\RFCCompliantNotifyAction($index, $from, $importance, $options, $message, $method);
        $actionStop = new \Zimbra\Mail\Struct\StopAction($index);
        $actionReject = new \Zimbra\Mail\Struct\RejectAction($index, $content);
        $actionEreject = new \Zimbra\Mail\Struct\ErejectAction($index, $content);
        $actionLog = new \Zimbra\Mail\Struct\LogAction($index, \Zimbra\Common\Enum\LoggingLevel::INFO(), $content);
        $actionAddheader = new \Zimbra\Mail\Struct\AddheaderAction($index, $headerName, $headerValue, TRUE);
        $actionDeleteheader = new \Zimbra\Mail\Struct\DeleteheaderAction(
            $index, TRUE, $offset
            , new \Zimbra\Mail\Struct\EditheaderTest(\Zimbra\Common\Enum\MatchType::IS(), TRUE, TRUE, \Zimbra\Common\Enum\RelationalComparator::EQUAL(), \Zimbra\Common\Enum\ComparisonComparator::OCTET(), $headerName, [$headerValue])
        );
        $actionReplaceheader = new \Zimbra\Mail\Struct\ReplaceheaderAction(
            $index, TRUE, $offset,
            new \Zimbra\Mail\Struct\EditheaderTest(\Zimbra\Common\Enum\MatchType::IS(), TRUE, TRUE, \Zimbra\Common\Enum\RelationalComparator::EQUAL(), \Zimbra\Common\Enum\ComparisonComparator::OCTET(), $headerName, [$headerValue]),
            $newName, $newValue
        );

        $child = new \Zimbra\Mail\Struct\NestedRule(new \Zimbra\Mail\Struct\FilterTests(\Zimbra\Common\Enum\FilterCondition::ALL_OF()));
        $filterRule = new \Zimbra\Mail\Struct\FilterRule($filterTests, $name, TRUE, $filterVariables, [
            $filterVariables,
            $actionKeep,
            $actionDiscard,
            $actionFileInto,
            $actionFlag,
            $actionTag,
            $actionRedirect,
            $actionReply,
            $actionNotify,
            $actionRFCCompliantNotify,
            $actionStop,
            $actionReject,
            $actionEreject,
            $actionLog,
            $actionAddheader,
            $actionDeleteheader,
            $actionReplaceheader,
        ], $child);

        $this->assertEquals([$filterRule], $response->getFilterRules());
    }

    public function testGetPermission()
    {
        $name = $this->faker->name;
        $zimbraId = $this->faker->uuid;
        $displayName = $this->faker->name;
        $accessKey = $this->faker->word;
        $password = $this->faker->sha256;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetPermissionResponse>
            <urn:ace gt="usr" right="invite" zid="$zimbraId" d="$displayName" key="$accessKey" pw="$password" deny="true" />
        </urn:GetPermissionResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->getPermission();

        $ace = new \Zimbra\Mail\Struct\AccountACEInfo(
            \Zimbra\Common\Enum\GranteeType::USR(), \Zimbra\Common\Enum\AceRightType::INVITE()->getValue(), $zimbraId, $displayName, $accessKey, $password, TRUE
        );
        $this->assertEquals([$ace], $response->getAces());
    }

    public function testGetRecur()
    {
        $id = $this->faker->uuid;
        $tzStdOffset = $this->faker->randomNumber;
        $tzDayOffset = $this->faker->randomNumber;
        $standardTZName = $this->faker->word;
        $daylightTZName = $this->faker->word;

        $mon = $this->faker->numberBetween(1, 12);
        $hour = $this->faker->numberBetween(0, 23);
        $min = $this->faker->numberBetween(0, 59);
        $sec = $this->faker->numberBetween(0, 59);
        $mday = $this->faker->numberBetween(1, 31);
        $week = $this->faker->numberBetween(1, 4);
        $wkday = $this->faker->numberBetween(1, 7);

        $dateTime = $this->faker->date;
        $timezone = $this->faker->timezone;
        $recurrenceRangeType = $this->faker->numberBetween(1, 3);
        $utcTime = $this->faker->unixTime;
        $weeks = $this->faker->numberBetween(1, 100);
        $days = $this->faker->numberBetween(1, 30);
        $hours = $this->faker->numberBetween(0, 23);
        $minutes = $this->faker->numberBetween(0, 59);
        $seconds = $this->faker->numberBetween(0, 59);

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetRecurResponse>
            <urn:tz id="$id" stdoff="$tzStdOffset" dayoff="$tzDayOffset" stdname="$standardTZName" dayname="$daylightTZName">
                <urn:standard mon="$mon" hour="$hour" min="$min" sec="$sec" mday="$mday" week="$week" wkday="$wkday" />
                <urn:daylight mon="$mon" hour="$hour" min="$min" sec="$sec" mday="$mday" week="$week" wkday="$wkday" />
            </urn:tz>
            <urn:cancel>
                <urn:exceptId d="$dateTime" tz="$timezone" rangeType="$recurrenceRangeType" />
                <urn:s d="$dateTime" tz="$timezone" u="$utcTime" />
                <urn:e d="$dateTime" tz="$timezone" u="$utcTime" />
                <urn:dur w="$weeks" d="$days" h="$hours" m="$minutes" s="$seconds" />
                <urn:recur>
                    <urn:rule freq="HOU" />
                </urn:recur>
            </urn:cancel>
            <urn:except>
                <urn:exceptId d="$dateTime" tz="$timezone" rangeType="$recurrenceRangeType" />
                <urn:s d="$dateTime" tz="$timezone" u="$utcTime" />
                <urn:e d="$dateTime" tz="$timezone" u="$utcTime" />
                <urn:dur w="$weeks" d="$days" h="$hours" m="$minutes" s="$seconds" />
                <urn:recur>
                    <urn:rule freq="HOU" />
                </urn:recur>
            </urn:except>
            <urn:comp>
                <urn:exceptId d="$dateTime" tz="$timezone" rangeType="$recurrenceRangeType" />
                <urn:s d="$dateTime" tz="$timezone" u="$utcTime" />
                <urn:e d="$dateTime" tz="$timezone" u="$utcTime" />
                <urn:dur w="$weeks" d="$days" h="$hours" m="$minutes" s="$seconds" />
                <urn:recur>
                    <urn:rule freq="HOU" />
                </urn:recur>
            </urn:comp>
        </urn:GetRecurResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->getRecur($id);

        $standardTzOnset = new \Zimbra\Common\Struct\TzOnsetInfo($mon, $hour, $min, $sec, $mday, $week, $wkday);
        $daylightTzOnset = new \Zimbra\Common\Struct\TzOnsetInfo($mon, $hour, $min, $sec, $mday, $week, $wkday);
        $tz = new \Zimbra\Mail\Struct\CalTZInfo(
            $id, $tzStdOffset, $tzDayOffset, $standardTzOnset, $daylightTzOnset, $standardTZName, $daylightTZName
        );

        $exceptionId = new \Zimbra\Mail\Struct\ExceptionRecurIdInfo($dateTime, $timezone, $recurrenceRangeType);
        $dtStart = new \Zimbra\Mail\Struct\DtTimeInfo($dateTime, $timezone, $utcTime);
        $dtEnd = new \Zimbra\Mail\Struct\DtTimeInfo($dateTime, $timezone, $utcTime);
        $duration = new \Zimbra\Mail\Struct\DurationInfo($weeks, $days, $hours, $minutes, $seconds);
        $recurrence = new \Zimbra\Mail\Struct\RecurrenceInfo([new \Zimbra\Mail\Struct\SimpleRepeatingRule(\Zimbra\Common\Enum\Frequency::HOUR())]);
        $cancel = new \Zimbra\Mail\Struct\CancelItemRecur($exceptionId, $dtStart, $dtEnd, $duration, $recurrence);
        $except = new \Zimbra\Mail\Struct\ExceptionItemRecur($exceptionId, $dtStart, $dtEnd, $duration, $recurrence);
        $invite = new \Zimbra\Mail\Struct\InviteItemRecur($exceptionId, $dtStart, $dtEnd, $duration, $recurrence);

        $this->assertEquals($tz, $response->getTimezone());
        $this->assertEquals($cancel, $response->getCancelComponent());
        $this->assertEquals($except, $response->getExceptComponent());
        $this->assertEquals($invite, $response->getInviteComponent());
    }

    public function testGetSearchFolder()
    {
        $id = $this->faker->uuid;
        $uuid = $this->faker->uuid;
        $query = $this->faker->word;
        $sortBy = \Zimbra\Common\Enum\SearchSortBy::DATE_DESC();
        $types = implode(',', [\Zimbra\Common\Enum\ItemType::MESSAGE(), \Zimbra\Common\Enum\ItemType::CONVERSATION()]);

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetSearchFolderResponse>
            <urn:search id="$id" uuid="$uuid" query="$query" sortBy="dateDesc" types="$types" />
        </urn:GetSearchFolderResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->getSearchFolder();
        $search = new \Zimbra\Mail\Struct\SearchFolder(
            $id,
            $uuid,
            $query,
            $sortBy,
            $types
        );
        $this->assertEquals([$search], $response->getSearchFolders());
    }

    public function testGetShareNotifications()
    {
        $id = $this->faker->uuid;
        $uuid = $this->faker->uuid;
        $date = $this->faker->unixTime;
        $status = $this->faker->word;
        $email = $this->faker->email;
        $name = $this->faker->name;
        $defaultView = $this->faker->word;
        $rights = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetShareNotificationsResponse>
            <urn:share status="$status" id="$id" d="$date">
                <urn:grantor id="$id" email="$email" name="$name" />
                <urn:link id="$id" uuid="$uuid" name="$name" view="$defaultView" perm="$rights" />
            </urn:share>
        </urn:GetShareNotificationsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->getShareNotifications();

        $share = new \Zimbra\Mail\Struct\ShareNotificationInfo(
            $status, $id, $date, new \Zimbra\Mail\Struct\Grantor($id, $email, $name), new \Zimbra\Mail\Struct\LinkInfo($id, $uuid, $name, $defaultView, $rights)
        );
        $this->assertEquals([$share], $response->getShares());
    }

    public function testGetSpellDictionaries()
    {
        $dictionary1 = $this->faker->unique->word;
        $dictionary2 = $this->faker->unique->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetSpellDictionariesResponse>
            <urn:dictionary>$dictionary1</urn:dictionary>
            <urn:dictionary>$dictionary2</urn:dictionary>
        </urn:GetSpellDictionariesResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->getSpellDictionaries();
        $this->assertSame([$dictionary1, $dictionary2], $response->getDictionaries());
    }

    public function testGetSystemRetentionPolicy()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $lifetime = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetSystemRetentionPolicyResponse>
            <urn:retentionPolicy>
                <urn:keep>
                    <urn:policy type="system" id="$id" name="$name" lifetime="$lifetime" />
                </urn:keep>
                <urn:purge>
                    <urn:policy type="user" id="$id" name="$name" lifetime="$lifetime" />
                </urn:purge>
            </urn:retentionPolicy>
        </urn:GetSystemRetentionPolicyResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->getSystemRetentionPolicy();

        $retention = new \Zimbra\Mail\Struct\RetentionPolicy(
            [new \Zimbra\Mail\Struct\Policy(\Zimbra\Common\Enum\Type::SYSTEM(), $id, $name, $lifetime)],
            [new \Zimbra\Mail\Struct\Policy(\Zimbra\Common\Enum\Type::USER(), $id, $name, $lifetime)]
        );
        $this->assertEquals($retention, $response->getRetentionPolicy());
    }

    public function testGetTag()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $color = $this->faker->numberBetween(0, 127);
        $rgb = $this->faker->hexcolor;
        $unread = $this->faker->randomNumber;
        $count = $this->faker->randomNumber;
        $date = $this->faker->unixTime;
        $revision = $this->faker->randomNumber;
        $changeDate = $this->faker->unixTime;
        $modifiedSequence = $this->faker->randomNumber;

        $lifetime = $this->faker->word;
        $section = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->text;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetTagResponse>
            <urn:tag id="$id" name="$name" color="$color" rgb="$rgb" u="$unread" n="$count" d="$date" rev="$revision" md="$changeDate" ms="$modifiedSequence" xmlns:urn="urn:zimbraMail">
                <urn:meta section="$section">
                    <urn:a n="$key">$value</urn:a>
                </urn:meta>
                <urn:retentionPolicy>
                    <urn:keep>
                        <urn:policy type="system" id="$id" name="$name" lifetime="$lifetime" />
                    </urn:keep>
                    <urn:purge>
                        <urn:policy type="user" id="$id" name="$name" lifetime="$lifetime" />
                    </urn:purge>
                </urn:retentionPolicy>
            </urn:tag>
        </urn:GetTagResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->getTag();

        $metadata = new \Zimbra\Mail\Struct\MailCustomMetadata(
            $section, [new \Zimbra\Common\Struct\KeyValuePair($key, $value)]
        );
        $retentionPolicy = new \Zimbra\Mail\Struct\RetentionPolicy(
            [new \Zimbra\Mail\Struct\Policy(\Zimbra\Common\Enum\Type::SYSTEM(), $id, $name, $lifetime)],
            [new \Zimbra\Mail\Struct\Policy(\Zimbra\Common\Enum\Type::USER(), $id, $name, $lifetime)]
        );
        $tag = new \Zimbra\Mail\Struct\TagInfo(
            $id,
            $name,
            $color,
            $rgb,
            $unread,
            $count,
            $date,
            $revision,
            $changeDate,
            $modifiedSequence,
            [$metadata],
            $retentionPolicy
        );
        $this->assertEquals([$tag], $response->getTags());
    }

    public function testGetTask()
    {
        $flags = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;
        $uid = $this->faker->uuid;
        $id = $this->faker->uuid;
        $revision = $this->faker->randomNumber;
        $size = $this->faker->randomNumber;
        $date = $this->faker->randomNumber;
        $folder = $this->faker->uuid;
        $changeDate = $this->faker->randomNumber;
        $modifiedSequence = $this->faker->randomNumber;
        $nextAlarm = $this->faker->randomNumber;

        $calItemType = $this->faker->word;
        $sequence = $this->faker->randomNumber;
        $intId = $this->faker->randomNumber;
        $componentNum = $this->faker->randomNumber;
        $recurrenceId = $this->faker->uuid;

        $tzStdOffset = $this->faker->randomNumber;
        $tzDayOffset = $this->faker->randomNumber;
        $standardTZName = $this->faker->word;
        $daylightTZName = $this->faker->word;

        $mon = mt_rand(1, 12);
        $hour = mt_rand(0, 23);
        $min = mt_rand(0, 59);
        $sec = mt_rand(0, 59);
        $mday = mt_rand(1, 31);
        $week = mt_rand(1, 4);
        $wkday = mt_rand(1, 7);

        $method = $this->faker->word;
        $part = $this->faker->word;
        $contentType = $this->faker->mimeType;
        $contentDisposition = $this->faker->word;
        $contentFilename = $this->faker->word;
        $contentId = $this->faker->word;
        $location = $this->faker->word;
        $content = $this->faker->text;

        $seq = $this->faker->randomNumber;
        $date = $this->faker->unixTime;
        $attendee = $this->faker->email;
        $sentBy = $this->faker->email;
        $partStat = \Zimbra\Common\Enum\ParticipationStatus::ACCEPT();
        $rangeType = $this->faker->numberBetween(1, 3);
        $recurId = $this->faker->uuid;

        $section = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->text;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetTaskResponse>
            <urn:appt f="$flags" t="$tags" tn="$tagNames" uid="$uid" id="$id" rev="$revision" s="$size" d="$date" l="$folder" md="$changeDate" ms="$modifiedSequence" nextAlarm="$nextAlarm" orphan="true">
                <urn:inv type="$calItemType" seq="$sequence" id="$intId" compNum="$componentNum" recurId="$recurrenceId">
                    <urn:tz id="$id" stdoff="$tzStdOffset" dayoff="$tzDayOffset" stdname="$standardTZName" dayname="$daylightTZName">
                        <urn:standard mon="$mon" hour="$hour" min="$min" sec="$sec" mday="$mday" week="$week" wkday="$wkday" />
                        <urn:daylight mon="$mon" hour="$hour" min="$min" sec="$sec" mday="$mday" week="$week" wkday="$wkday" />
                    </urn:tz>
                    <urn:comp method="$method" compNum="$componentNum" rsvp="true" />
                    <urn:mp part="$part" ct="$contentType" s="$size" cd="$contentDisposition" filename="$contentFilename" ci="$contentId" cl="$location" body="true" truncated="true">
                        <urn:content>$content</urn:content>
                        <urn:mp part="$part" ct="$contentType" />
                    </urn:mp>
                    <urn:shr truncated="true">
                        <urn:content>$content</urn:content>
                    </urn:shr>
                    <urn:dlSubs truncated="true">
                        <urn:content>$content</urn:content>
                    </urn:dlSubs>
                </urn:inv>
                <urn:replies>
                    <urn:reply rangeType="$rangeType" recurId="$recurId" seq="$seq" d="$date" at="$attendee" sentBy="$sentBy" ptst="AC" />
                </urn:replies>
                <urn:meta section="$section">
                    <urn:a n="$key">$value</urn:a>
                </urn:meta>
            </urn:appt>
            <urn:task f="$flags" t="$tags" tn="$tagNames" uid="$uid" id="$id" rev="$revision" s="$size" d="$date" l="$folder" md="$changeDate" ms="$modifiedSequence" nextAlarm="$nextAlarm" orphan="true">
                <urn:inv type="$calItemType" seq="$sequence" id="$intId" compNum="$componentNum" recurId="$recurrenceId">
                    <urn:tz id="$id" stdoff="$tzStdOffset" dayoff="$tzDayOffset" stdname="$standardTZName" dayname="$daylightTZName">
                        <urn:standard mon="$mon" hour="$hour" min="$min" sec="$sec" mday="$mday" week="$week" wkday="$wkday" />
                        <urn:daylight mon="$mon" hour="$hour" min="$min" sec="$sec" mday="$mday" week="$week" wkday="$wkday" />
                    </urn:tz>
                    <urn:comp method="$method" compNum="$componentNum" rsvp="true" />
                    <urn:mp part="$part" ct="$contentType" s="$size" cd="$contentDisposition" filename="$contentFilename" ci="$contentId" cl="$location" body="true" truncated="true">
                        <urn:content>$content</urn:content>
                        <urn:mp part="$part" ct="$contentType" />
                    </urn:mp>
                    <urn:shr truncated="true">
                        <urn:content>$content</urn:content>
                    </urn:shr>
                    <urn:dlSubs truncated="true">
                        <urn:content>$content</urn:content>
                    </urn:dlSubs>
                </urn:inv>
                <urn:replies>
                    <urn:reply rangeType="$rangeType" recurId="$recurId" seq="$seq" d="$date" at="$attendee" sentBy="$sentBy" ptst="AC" />
                </urn:replies>
                <urn:meta section="$section">
                    <urn:a n="$key">$value</urn:a>
                </urn:meta>
            </urn:task>
        </urn:GetTaskResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->getTask();

        $standardTzOnset = new \Zimbra\Common\Struct\TzOnsetInfo($mon, $hour, $min, $sec, $mday, $week, $wkday);
        $daylightTzOnset = new \Zimbra\Common\Struct\TzOnsetInfo($mon, $hour, $min, $sec, $mday, $week, $wkday);
        $tz = new \Zimbra\Mail\Struct\CalTZInfo(
            $id, $tzStdOffset, $tzDayOffset, $standardTzOnset, $daylightTzOnset, $standardTZName, $daylightTZName
        );
        $comp = new \Zimbra\Mail\Struct\InviteComponent($method, $componentNum, TRUE);
        $mimePart = new \Zimbra\Mail\Struct\PartInfo($part, $contentType);
        $mp = new \Zimbra\Mail\Struct\PartInfo(
            $part, $contentType, $size, $contentDisposition, $contentFilename, $contentId, $location, TRUE, TRUE, $content, [$mimePart]
        );
        $shr = new \Zimbra\Mail\Struct\ShareNotification(TRUE, $content);
        $dlSubs = new \Zimbra\Mail\Struct\DLSubscriptionNotification(TRUE, $content);
        $inv = new \Zimbra\Mail\Struct\Invitation(
            $calItemType, $sequence, $intId, $componentNum, $recurrenceId, [$tz], $comp, [$mp], [$shr], [$dlSubs]
        );
        $reply = new \Zimbra\Mail\Struct\CalendarReply(
            $rangeType, $recurId, $seq, $date, $attendee, $sentBy, $partStat
        );
        $meta = new \Zimbra\Mail\Struct\MailCustomMetadata($section, [new \Zimbra\Common\Struct\KeyValuePair($key, $value)]);
        $appt = new \Zimbra\Mail\Struct\CalendarItemInfo(
            $flags, $tags, $tagNames, $uid, $id, $revision, $size, $date, $folder, $changeDate, $modifiedSequence, $nextAlarm, TRUE, [$inv], [$reply], [$meta]
        );
        $task = new \Zimbra\Mail\Struct\TaskItemInfo(
            $flags, $tags, $tagNames, $uid, $id, $revision, $size, $date, $folder, $changeDate, $modifiedSequence, $nextAlarm, TRUE, [$inv], [$reply], [$meta]
        );

        $this->assertEquals($appt, $response->getApptItem());
        $this->assertEquals($task, $response->getTaskItem());
    }

    public function testGetTaskSummaries()
    {
        $startTime = $this->faker->randomNumber;
        $endTime = $this->faker->randomNumber;

        $xUid = $this->faker->uuid;
        $uid = $this->faker->uuid;
        $category1 = $this->faker->unique->word;
        $category2 = $this->faker->unique->word;
        $latitude = (string) $this->faker->latitude;
        $longitude = (string) $this->faker->longitude;
        $fragment = $this->faker->text;

        $name = $this->faker->name;
        $value = $this->faker->word;
        $address = $this->faker->email;
        $displayName = $this->faker->name;
        $url = $this->faker->url;
        $sentBy = $this->faker->email;
        $dir = $this->faker->word;
        $language = $this->faker->locale;

        $nextAlarm = $this->faker->randomNumber;
        $alarmInstanceStart = $this->faker->randomNumber;
        $invId = $this->faker->randomNumber;
        $componentNum = $this->faker->randomNumber;

        $action = \Zimbra\Common\Enum\AlarmAction::DISPLAY();
        $date = $this->faker->date;
        $weeks = mt_rand(1, 100);
        $days = mt_rand(1, 30);
        $hours = mt_rand(0, 23);
        $minutes = mt_rand(0, 59);
        $seconds = mt_rand(0, 59);
        $uri = $this->faker->url;
        $contentType = $this->faker->mimeType;
        $binaryB64Data = base64_encode($this->faker->text);
        $description = $this->faker->text;
        $summary = $this->faker->text;
        $location = $this->faker->text;
        $role = $this->faker->word;
        $partStat = \Zimbra\Common\Enum\ParticipationStatus::ACCEPT();

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetTaskSummariesResponse>
            <urn:appt x_uid="$xUid" uid="$uid">
                <urn:or a="$address" url="$url" d="$displayName" sentBy="$sentBy" dir="$dir" lang="$language">
                    <urn:xparam name="$name" value="$value" />
                </urn:or>
                <urn:category>$category1</urn:category>
                <urn:category>$category2</urn:category>
                <urn:geo lat="$latitude" lon="$longitude" />
                <urn:fr>$fragment</urn:fr>
                <urn:inst s="$startTime" ex="true">
                    <urn:or a="$address" url="$url" d="$displayName" sentBy="$sentBy" dir="$dir" lang="$language">
                        <urn:xparam name="$name" value="$value" />
                    </urn:or>
                    <urn:category>$category1</urn:category>
                    <urn:category>$category2</urn:category>
                    <urn:geo lat="$latitude" lon="$longitude" />
                    <urn:fr>$fragment</urn:fr>
                </urn:inst>
                <urn:alarmData nextAlarm="$nextAlarm" alarmInstStart="$alarmInstanceStart" invId="$invId" compNum="$componentNum" name="$name" loc="$location">
                    <urn:alarm action="DISPLAY">
                        <urn:trigger>
                            <urn:abs d="$date" />
                            <urn:rel w="$weeks" d="$days" h="$hours" m="$minutes" s="$seconds" />
                        </urn:trigger>
                        <urn:repeat w="$weeks" d="$days" h="$hours" m="$minutes" s="$seconds" />
                        <urn:desc>$description</urn:desc>
                        <urn:attach uri="$uri" ct="$contentType">$binaryB64Data</urn:attach>
                        <urn:summary>$summary</urn:summary>
                        <urn:at a="$address" d="$displayName" role="$role" ptst="AC" rsvp="true">
                            <urn:xparam name="$name" value="$value" />
                        </urn:at>
                        <urn:xprop name="$name" value="$value">
                            <urn:xparam name="$name" value="$value" />
                        </urn:xprop>
                    </urn:alarm>
                </urn:alarmData>
            </urn:appt>
            <urn:task x_uid="$xUid" uid="$uid">
                <urn:or a="$address" url="$url" d="$displayName" sentBy="$sentBy" dir="$dir" lang="$language">
                    <urn:xparam name="$name" value="$value" />
                </urn:or>
                <urn:category>$category1</urn:category>
                <urn:category>$category2</urn:category>
                <urn:geo lat="$latitude" lon="$longitude" />
                <urn:fr>$fragment</urn:fr>
                <urn:inst s="$startTime" ex="true">
                    <urn:or a="$address" url="$url" d="$displayName" sentBy="$sentBy" dir="$dir" lang="$language">
                        <urn:xparam name="$name" value="$value" />
                    </urn:or>
                    <urn:category>$category1</urn:category>
                    <urn:category>$category2</urn:category>
                    <urn:geo lat="$latitude" lon="$longitude" />
                    <urn:fr>$fragment</urn:fr>
                </urn:inst>
                <urn:alarmData nextAlarm="$nextAlarm" alarmInstStart="$alarmInstanceStart" invId="$invId" compNum="$componentNum" name="$name" loc="$location">
                    <urn:alarm action="DISPLAY">
                        <urn:trigger>
                            <urn:abs d="$date" />
                            <urn:rel w="$weeks" d="$days" h="$hours" m="$minutes" s="$seconds" />
                        </urn:trigger>
                        <urn:repeat w="$weeks" d="$days" h="$hours" m="$minutes" s="$seconds" />
                        <urn:desc>$description</urn:desc>
                        <urn:attach uri="$uri" ct="$contentType">$binaryB64Data</urn:attach>
                        <urn:summary>$summary</urn:summary>
                        <urn:at a="$address" d="$displayName" role="$role" ptst="AC" rsvp="true">
                            <urn:xparam name="$name" value="$value" />
                        </urn:at>
                        <urn:xprop name="$name" value="$value">
                            <urn:xparam name="$name" value="$value" />
                        </urn:xprop>
                    </urn:alarm>
                </urn:alarmData>
            </urn:task>
        </urn:GetTaskSummariesResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->getTaskSummaries($startTime, $endTime);

        $trigger = new \Zimbra\Mail\Struct\AlarmTriggerInfo(
            new \Zimbra\Mail\Struct\DateAttr($date), new \Zimbra\Mail\Struct\DurationInfo($weeks, $days, $hours, $minutes, $seconds)
        );
        $repeat = new \Zimbra\Mail\Struct\DurationInfo($weeks, $days, $hours, $minutes, $seconds);
        $attach = new \Zimbra\Mail\Struct\CalendarAttach($uri, $contentType, $binaryB64Data);
        $at = new \Zimbra\Mail\Struct\CalendarAttendee($address, $displayName, $role, $partStat, TRUE, [new \Zimbra\Mail\Struct\XParam($name, $value)]);
        $xprop = new \Zimbra\Mail\Struct\XProp($name, $value, [new \Zimbra\Mail\Struct\XParam($name, $value)]);
        $alarm = new \Zimbra\Mail\Struct\AlarmInfo($action, $trigger, $repeat, $description, $attach, $summary, [$at], [$xprop]);
        $alarmData = new \Zimbra\Mail\Struct\AlarmDataInfo(
            $nextAlarm, $alarmInstanceStart, $invId, $componentNum, $name, $location, $alarm
        );

        $geo = new \Zimbra\Mail\Struct\GeoInfo($latitude, $longitude);
        $organizer = new \Zimbra\Mail\Struct\CalOrganizer($address, $url, $displayName, $sentBy, $dir, $language, [new \Zimbra\Mail\Struct\XParam($name, $value)]);
        $inst = new \Zimbra\Mail\Struct\LegacyInstanceDataInfo(
            $startTime, TRUE, $organizer, [$category1, $category2], $geo, $fragment
        );

        $appt = new \Zimbra\Mail\Struct\LegacyAppointmentData(
            $xUid, $uid, $organizer, [$category1, $category2], $geo, $fragment, [$inst], $alarmData
        );
        $task = new \Zimbra\Mail\Struct\LegacyTaskData(
            $xUid, $uid, $organizer, [$category1, $category2], $geo, $fragment, [$inst], $alarmData
        );

        $this->assertEquals([$appt], $response->getApptEntries());
        $this->assertEquals([$task], $response->getTaskEntries());
    }

    public function testGetWorkingHours()
    {
        $startTime = $this->faker->unixTime;
        $endTime = $this->faker->unixTime;
        $id = $this->faker->uuid;
        $subject = $this->faker->text;
        $location = $this->faker->text;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetWorkingHoursResponse>
            <urn:usr id="$id">
                <urn:f s="$startTime" e="$endTime" eventId="$id" subject="$subject" location="$location" isMeeting="true" isRecurring="true" isException="true" isReminderSet="true" isPrivate="true" hasPermission="true" />
                <urn:b s="$startTime" e="$endTime" eventId="$id" subject="$subject" location="$location" isMeeting="true" isRecurring="true" isException="true" isReminderSet="true" isPrivate="true" hasPermission="true" />
                <urn:t s="$startTime" e="$endTime" eventId="$id" subject="$subject" location="$location" isMeeting="true" isRecurring="true" isException="true" isReminderSet="true" isPrivate="true" hasPermission="true" />
                <urn:u s="$startTime" e="$endTime" eventId="$id" subject="$subject" location="$location" isMeeting="true" isRecurring="true" isException="true" isReminderSet="true" isPrivate="true" hasPermission="true" />
                <urn:n s="$startTime" e="$endTime" eventId="$id" subject="$subject" location="$location" isMeeting="true" isRecurring="true" isException="true" isReminderSet="true" isPrivate="true" hasPermission="true" />
            </urn:usr>
        </urn:GetWorkingHoursResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->getWorkingHours($startTime, $endTime);

        $freeSlot = new \Zimbra\Mail\Struct\FreeBusyFREEslot(
            $startTime, $endTime, $id, $subject, $location, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE
        );
        $busySlot = new \Zimbra\Mail\Struct\FreeBusyBUSYslot(
            $startTime, $endTime, $id, $subject, $location, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE
        );
        $tentativeSlot = new \Zimbra\Mail\Struct\FreeBusyBUSYTENTATIVEslot(
            $startTime, $endTime, $id, $subject, $location, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE
        );
        $unavailableSlot = new \Zimbra\Mail\Struct\FreeBusyBUSYUNAVAILABLEslot(
            $startTime, $endTime, $id, $subject, $location, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE
        );
        $noDataSlot = new \Zimbra\Mail\Struct\FreeBusyNODATAslot(
            $startTime, $endTime, $id, $subject, $location, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE
        );
        $usr = new \Zimbra\Mail\Struct\FreeBusyUserInfo($id, [
            $freeSlot,
            $busySlot,
            $tentativeSlot,
            $unavailableSlot,
            $noDataSlot,
        ]);
        $this->assertEquals([$usr], $response->getFreebusyUsers());
    }

    public function testGetYahooAuthToken()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetYahooAuthTokenResponse failed="true" />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->getYahooAuthToken($this->faker->email, $this->faker->word);
        $this->assertTrue($response->getFailed());
    }

    public function testGetYahooCookie()
    {
        $error = $this->faker->word;
        $crumb = $this->faker->word;
        $y = $this->faker->word;
        $t = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetYahooCookieResponse error="$error" crumb="$crumb" y="$y" t="$t" />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->getYahooCookie($this->faker->email);
        $this->assertSame($error, $response->getError());
        $this->assertSame($crumb, $response->getCrumb());
        $this->assertSame($y, $response->getY());
        $this->assertSame($t, $response->getT());
    }

    public function testGrantPermission()
    {
        $zimbraId = $this->faker->uuid;
        $displayName = $this->faker->name;
        $accessKey = $this->faker->word;
        $password = $this->faker->sha256;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GrantPermissionResponse>
            <urn:ace gt="usr" right="invite" zid="$zimbraId" d="$displayName" key="$accessKey" pw="$password" deny="true" />
        </urn:GrantPermissionResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->grantPermission();

        $ace = new \Zimbra\Mail\Struct\AccountACEInfo(
            \Zimbra\Common\Enum\GranteeType::USR(), \Zimbra\Common\Enum\AceRightType::INVITE()->getValue(), $zimbraId, $displayName, $accessKey, $password, TRUE
        );
        $this->assertEquals([$ace], $response->getAces());
    }

    public function testICalReply()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ICalReplyResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->iCalReply($this->faker->text);
        $this->assertInstanceOf(\Zimbra\Mail\Message\ICalReplyResponse::class, $response);
    }

    public function testIMAPCopy()
    {
        $id = $this->faker->randomNumber;
        $imapUid = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:IMAPCopyResponse>
            <urn:item id="$id" i4uid="$imapUid" />
        </urn:IMAPCopyResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->imapCopy($this->faker->uuid);
        $item = new \Zimbra\Mail\Struct\IMAPItemInfo($id, $imapUid);
        $this->assertEquals([$item], $response->getItems());
    }

    public function testImportAppointments()
    {
        $ids = $this->faker->word;
        $num = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ImportAppointmentsResponse ids="$ids" n="$num" />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->importAppointments(new \Zimbra\Mail\Struct\ContentSpec());
        $this->assertSame($ids, $response->getIds());
        $this->assertSame($num, $response->getNum());
    }

    public function testImportContacts()
    {
        $listOfCreatedIds = $this->faker->word;
        $numImported = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ImportContactsResponse>
            <urn:cn ids="$listOfCreatedIds" n="$numImported" />
        </urn:ImportContactsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->importContacts(new \Zimbra\Mail\Struct\Content());
        $contact = new \Zimbra\Mail\Struct\ImportContact($listOfCreatedIds, $numImported);
        $this->assertEquals($contact, $response->getContact());
    }

    public function testImportData()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ImportDataResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->importData();
        $this->assertInstanceOf(\Zimbra\Mail\Message\ImportDataResponse::class, $response);
    }

    public function testInvalidateReminderDevice()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:InvalidateReminderDeviceResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->invalidateReminderDevice($this->faker->email);
        $this->assertInstanceOf(\Zimbra\Mail\Message\InvalidateReminderDeviceResponse::class, $response);
    }

    public function testItemAction()
    {
        $id = $this->faker->uuid;
        $operation = $this->faker->word;
        $nonExistentIds = $this->faker->uuid;
        $newlyCreatedIds = $this->faker->uuid;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ItemActionResponse>
            <urn:action id="$id" op="$operation" nei="$nonExistentIds" nci="$newlyCreatedIds" />
        </urn:ItemActionResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->itemAction(new \Zimbra\Mail\Struct\ActionSelector($operation));

        $action = new \Zimbra\Mail\Struct\ActionResult($id, $operation, $nonExistentIds, $newlyCreatedIds);
        $this->assertEquals($action, $response->getAction());
    }

    public function testListDocumentRevisions()
    {
        $id = $this->faker->uuid;
        $lockOwnerId = $this->faker->uuid;
        $lockOwnerEmail = $this->faker->email;
        $lockOwnerTimestamp = (string) $this->faker->unixTime;
        $email = $this->faker->email;
        $name = $this->faker->name;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ListDocumentRevisionsResponse>
            <urn:doc id="$id" loid="$lockOwnerId" loe="$lockOwnerEmail" lt="$lockOwnerTimestamp" />
            <urn:user id="$id" email="$email" name="$name" />
        </urn:ListDocumentRevisionsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->listDocumentRevisions(new \Zimbra\Mail\Struct\ListDocumentRevisionsSpec());

        $revision = new \Zimbra\Mail\Struct\DocumentInfo(
            $id, $lockOwnerId, $lockOwnerEmail, $lockOwnerTimestamp
        );
        $user = new \Zimbra\Mail\Struct\IdEmailName(
            $id, $email, $name
        );
        $this->assertEquals([$revision], $response->getRevisions());
        $this->assertEquals([$user], $response->getUsers());
    }

    public function testListIMAPSubscriptions()
    {
        $subscription1 = $this->faker->unique->word;
        $subscription2 = $this->faker->unique->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ListIMAPSubscriptionsResponse>
            <urn:sub>$subscription1</urn:sub>
            <urn:sub>$subscription2</urn:sub>
        </urn:ListIMAPSubscriptionsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->listIMAPSubscriptions();
        $this->assertSame([$subscription1, $subscription2], $response->getSubscriptions());
    }

    public function testModifyAppointment()
    {
        $id = $this->faker->uuid;
        $modifiedSequence = $this->faker->randomNumber;
        $revision = $this->faker->randomNumber;

        $subject = $this->faker->text;
        $content = $this->faker->text;
        $contentType = $this->faker->word;
        $contentId = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $address = $this->faker->email;
        $personal = $this->faker->word;

        $calItemId = $this->faker->uuid;
        $deprecatedApptId = $this->faker->uuid;
        $calInvId = $this->faker->uuid;

        $part = $this->faker->word;
        $sentDate = $this->faker->unixTime;
        $messageIdHeader = $this->faker->uuid;

        $display = $this->faker->name;
        $addressType = \Zimbra\Common\Enum\AddressType::TO();
        $calItemType = \Zimbra\Common\Enum\InviteType::TASK();

        $size = $this->faker->randomNumber;
        $contentDisposition = $this->faker->word;
        $contentFilename = $this->faker->word;
        $location = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ModifyAppointmentResponse calItemId="$calItemId" apptId="$deprecatedApptId" invId="$calInvId" ms="$modifiedSequence" rev="$revision">
            <urn:m id="$id" />
            <urn:echo>
                <urn:m id="$id" part="$part" sd="$sentDate">
                    <urn:e a="$address" d="$display" p="$personal" t="t" />
                    <urn:su>$subject</urn:su>
                    <urn:mid>$messageIdHeader</urn:mid>
                    <urn:inv type="task" />
                    <urn:header n="$key">$value</urn:header>
                    <urn:mp part="$part" ct="$contentType" s="$size" cd="$contentDisposition" filename="$contentFilename" ci="$contentId" cl="$location" body="true" truncated="true">
                        <urn:content>$content</urn:content>
                    </urn:mp>
                    <urn:shr truncated="true">
                        <urn:content>$content</urn:content>
                    </urn:shr>
                    <urn:dlSubs truncated="true">
                        <urn:content>$content</urn:content>
                    </urn:dlSubs>
                </urn:m>
            </urn:echo>
        </urn:ModifyAppointmentResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->modifyAppointment();

        $contentElems = [
            new \Zimbra\Mail\Struct\PartInfo(
                $part, $contentType, $size, $contentDisposition, $contentFilename, $contentId, $location, TRUE, TRUE, $content
            ),
            new \Zimbra\Mail\Struct\ShareNotification(TRUE, $content),
            new \Zimbra\Mail\Struct\DLSubscriptionNotification(TRUE, $content),
        ];
        $invite = new \Zimbra\Mail\Struct\InviteAsMP(
            $id, $part, $sentDate,
            [new \Zimbra\Mail\Struct\EmailInfo($address, $display, $personal, $addressType)],
            $subject, $messageIdHeader,
            new \Zimbra\Mail\Struct\MPInviteInfo($calItemType), [new \Zimbra\Common\Struct\KeyValuePair($key, $value)],
            $contentElems
        );
        $msg = new \Zimbra\Common\Struct\Id($id);
        $echo = new \Zimbra\Mail\Struct\CalEcho($invite);

        $this->assertSame($calItemId, $response->getCalItemId());
        $this->assertSame($deprecatedApptId, $response->getDeprecatedApptId());
        $this->assertSame($calInvId, $response->getCalInvId());
        $this->assertSame($modifiedSequence, $response->getModifiedSequence());
        $this->assertSame($revision, $response->getRevision());
        $this->assertEquals($msg, $response->getMsg());
        $this->assertEquals($echo, $response->getEcho());
    }

    public function testModifyContact()
    {
        $folder = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;
        $section = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->text;
        $part = $this->faker->word;

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

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
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

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->modifyContact(new \Zimbra\Mail\Struct\ModifyContactSpec());

        $contact = new \Zimbra\Mail\Struct\ContactInfo(
            $uuid, $sortField, TRUE, $imapUid, $folder, $flags, $tags, $tagNames, $changeDate,
            $modifiedSequenceId, $date, $revisionId, $fileAs, $email, $email2, $email3, $type, $dlist, $reference, FALSE,
            [new \Zimbra\Mail\Struct\MailCustomMetadata($section)],
            [new \Zimbra\Common\Struct\ContactAttr($key, $value, $part, $contentType, $size, $contentFilename)],
            [new \Zimbra\Mail\Struct\ContactGroupMember(\Zimbra\Common\Enum\MemberType::CONTACT(), $value)],
            $memberOf
        );
        $this->assertEquals($contact, $response->getContact());
    }

    public function testModifyDataSource()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ModifyDataSourceResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->modifyDataSource(new \Zimbra\Mail\Struct\MailImapDataSource($this->faker->uuid));
        $this->assertInstanceOf(\Zimbra\Mail\Message\ModifyDataSourceResponse::class, $response);
    }

    public function testModifyFilterRules()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ModifyFilterRulesResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->modifyFilterRules();
        $this->assertInstanceOf(\Zimbra\Mail\Message\ModifyFilterRulesResponse::class, $response);
    }

    public function testModifyMailboxMetadata()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ModifyMailboxMetadataResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->modifyMailboxMetadata(new \Zimbra\Mail\Struct\MailCustomMetadata());
        $this->assertInstanceOf(\Zimbra\Mail\Message\ModifyMailboxMetadataResponse::class, $response);
    }

    public function testModifyOutgoingFilterRules()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ModifyOutgoingFilterRulesResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->modifyOutgoingFilterRules();
        $this->assertInstanceOf(\Zimbra\Mail\Message\ModifyOutgoingFilterRulesResponse::class, $response);
    }

    public function testModifyProfileImage()
    {
        $itemId = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ModifyProfileImageResponse itemId="$itemId" />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->modifyProfileImage();
        $this->assertSame($itemId, $response->getItemId());
    }

    public function testModifySearchFolder()
    {
        $id = $this->faker->uuid;
        $uuid = $this->faker->uuid;
        $query = $this->faker->word;
        $searchTypes = implode(',', [\Zimbra\Common\Enum\ItemType::MESSAGE(), \Zimbra\Common\Enum\ItemType::CONVERSATION()]);
        $sortBy = \Zimbra\Common\Enum\SearchSortBy::DATE_DESC();

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ModifySearchFolderResponse>
            <urn:search id="$id" uuid="$uuid" query="$query" sortBy="dateDesc" types="$searchTypes" />
        </urn:ModifySearchFolderResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->modifySearchFolder(new \Zimbra\Mail\Struct\ModifySearchFolderSpec());

        $search = new \Zimbra\Mail\Struct\SearchFolder(
            $id,
            $uuid,
            $query,
            $sortBy,
            $searchTypes
        );
        $this->assertEquals($search, $response->getSearchFolder());
    }

    public function testModifyTask()
    {
        $id = $this->faker->uuid;
        $modifiedSequence = $this->faker->randomNumber;
        $revision = $this->faker->randomNumber;

        $subject = $this->faker->text;
        $content = $this->faker->text;
        $contentType = $this->faker->word;
        $contentId = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $address = $this->faker->email;
        $personal = $this->faker->word;

        $calItemId = $this->faker->uuid;
        $deprecatedApptId = $this->faker->uuid;
        $calInvId = $this->faker->uuid;

        $part = $this->faker->word;
        $sentDate = $this->faker->unixTime;
        $messageIdHeader = $this->faker->uuid;

        $display = $this->faker->name;
        $addressType = \Zimbra\Common\Enum\AddressType::TO();
        $calItemType = \Zimbra\Common\Enum\InviteType::TASK();

        $size = $this->faker->randomNumber;
        $contentDisposition = $this->faker->word;
        $contentFilename = $this->faker->word;
        $location = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ModifyTaskResponse calItemId="$calItemId" apptId="$deprecatedApptId" invId="$calInvId" ms="$modifiedSequence" rev="$revision">
            <urn:m id="$id" />
            <urn:echo>
                <urn:m id="$id" part="$part" sd="$sentDate">
                    <urn:e a="$address" d="$display" p="$personal" t="t" />
                    <urn:su>$subject</urn:su>
                    <urn:mid>$messageIdHeader</urn:mid>
                    <urn:inv type="task" />
                    <urn:header n="$key">$value</urn:header>
                    <urn:mp part="$part" ct="$contentType" s="$size" cd="$contentDisposition" filename="$contentFilename" ci="$contentId" cl="$location" body="true" truncated="true">
                        <urn:content>$content</urn:content>
                    </urn:mp>
                    <urn:shr truncated="true">
                        <urn:content>$content</urn:content>
                    </urn:shr>
                    <urn:dlSubs truncated="true">
                        <urn:content>$content</urn:content>
                    </urn:dlSubs>
                </urn:m>
            </urn:echo>
        </urn:ModifyTaskResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->modifyTask();

        $contentElems = [
            new \Zimbra\Mail\Struct\PartInfo(
                $part, $contentType, $size, $contentDisposition, $contentFilename, $contentId, $location, TRUE, TRUE, $content
            ),
            new \Zimbra\Mail\Struct\ShareNotification(TRUE, $content),
            new \Zimbra\Mail\Struct\DLSubscriptionNotification(TRUE, $content),
        ];
        $invite = new \Zimbra\Mail\Struct\InviteAsMP(
            $id, $part, $sentDate,
            [new \Zimbra\Mail\Struct\EmailInfo($address, $display, $personal, $addressType)],
            $subject, $messageIdHeader,
            new \Zimbra\Mail\Struct\MPInviteInfo($calItemType), [new \Zimbra\Common\Struct\KeyValuePair($key, $value)],
            $contentElems
        );
        $msg = new \Zimbra\Common\Struct\Id($id);
        $echo = new \Zimbra\Mail\Struct\CalEcho($invite);

        $this->assertSame($calItemId, $response->getCalItemId());
        $this->assertSame($deprecatedApptId, $response->getDeprecatedApptId());
        $this->assertSame($calInvId, $response->getCalInvId());
        $this->assertSame($modifiedSequence, $response->getModifiedSequence());
        $this->assertSame($revision, $response->getRevision());
        $this->assertEquals($msg, $response->getMsg());
        $this->assertEquals($echo, $response->getEcho());
    }

    public function testMsgAction()
    {
        $id = $this->faker->uuid;
        $operation = $this->faker->word;
        $nonExistentIds = $this->faker->uuid;
        $newlyCreatedIds = $this->faker->uuid;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:MsgActionResponse>
            <urn:action id="$id" op="$operation" nei="$nonExistentIds" nci="$newlyCreatedIds" />
        </urn:MsgActionResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->msgAction(new \Zimbra\Mail\Struct\ActionSelector($operation));

        $action = new \Zimbra\Mail\Struct\ActionResult($id, $operation, $nonExistentIds, $newlyCreatedIds);
        $this->assertEquals($action, $response->getAction());
    }

    public function testNoOp()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:NoOpResponse waitDisallowed="true" />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->noOp();
        $this->assertTrue($response->getWaitDisallowed());
    }

    public function testNoteAction()
    {
        $operation = $this->faker->word;
        $id = $this->faker->uuid;
        $nonExistentIds = $this->faker->uuid;
        $newlyCreatedIds = $this->faker->uuid;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:NoteActionResponse>
            <urn:action id="$id" op="$operation" nei="$nonExistentIds" nci="$newlyCreatedIds" />
        </urn:NoteActionResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->noteAction(new \Zimbra\Mail\Struct\NoteActionSelector($operation));

        $action = new \Zimbra\Mail\Struct\ActionResult($id, $operation, $nonExistentIds, $newlyCreatedIds);
        $this->assertEquals($action, $response->getAction());
    }

    public function testOpenIMAPFolder()
    {
        $id = $this->faker->word;
        $imapId = $this->faker->randomNumber;
        $imapUid = $this->faker->randomNumber;
        $type = $this->faker->word;
        $flags = $this->faker->randomNumber;
        $tags = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:OpenIMAPFolderResponse more="true">
            <urn:folder>
                <urn:m id="$imapId" i4uid="$imapUid" t="$type" f="$flags" tn="$tags" />
            </urn:folder>
            <urn:cursor id="$id" />
        </urn:OpenIMAPFolderResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->openIMAPFolder($this->faker->word, $this->faker->randomNumber);

        $cursor = new \Zimbra\Mail\Struct\ImapCursorInfo($id);
        $message = new \Zimbra\Mail\Struct\ImapMessageInfo($imapId, $imapUid, $type, $flags, $tags);
        $this->assertEquals([$message], $response->getMessages());
        $this->assertTrue($response->getHasMore());
        $this->assertEquals($cursor, $response->getCursor());
    }

    public function testPurgeRevision()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:PurgeRevisionResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->purgeRevision(new \Zimbra\Mail\Struct\PurgeRevisionSpec());
        $this->assertInstanceOf(\Zimbra\Mail\Message\PurgeRevisionResponse::class, $response);
    }

    public function testRankingAction()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:RankingActionResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->rankingAction(new \Zimbra\Mail\Struct\RankingActionSpec());
        $this->assertInstanceOf(\Zimbra\Mail\Message\RankingActionResponse::class, $response);
    }

    public function testRecordIMAPSession()
    {
        $lastItemId = $this->faker->randomNumber;
        $folderUuid = $this->faker->uuid;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:RecordIMAPSessionResponse id="$lastItemId" luuid="$folderUuid" />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->recordIMAPSession($this->faker->uuid);
        $this->assertSame($lastItemId, $response->getLastItemId());
        $this->assertSame($folderUuid, $response->getFolderUuid());
    }

    public function testRecoverAccount()
    {
        $recoveryAccount = $this->faker->email;
        $recoveryAttemptsLeft = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:RecoverAccountResponse recoveryAccount="$recoveryAccount" recoveryAttemptsLeft="$recoveryAttemptsLeft" />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->recoverAccount($this->faker->email);
        $this->assertSame($recoveryAccount, $response->getRecoveryAccount());
        $this->assertSame($recoveryAttemptsLeft, $response->getRecoveryAttemptsLeft());
    }

    public function testRemoveAttachments()
    {
        $id = $this->faker->uuid;
        $imapUid = $this->faker->randomNumber;
        $calendarIntendedFor = $this->faker->word;
        $origId = $this->faker->uuid;
        $draftReplyType = \Zimbra\Common\Enum\ReplyType::REPLIED();
        $identityId = $this->faker->uuid;
        $draftAccountId = $this->faker->uuid;
        $draftAutoSendTime = $this->faker->randomNumber;
        $sentDate = $this->faker->randomNumber;
        $resentDate = $this->faker->randomNumber;
        $part = $this->faker->word;
        $fragment = $this->faker->word;
        $subject = $this->faker->word;
        $messageIdHeader = $this->faker->word;
        $inReplyTo = $this->faker->word;

        $address = $this->faker->email;
        $display = $this->faker->name;
        $personal = $this->faker->word;
        $addressType = \Zimbra\Common\Enum\AddressType::TO();

        $contentType = $this->faker->mimeType;
        $size = $this->faker->randomNumber;
        $contentDisposition = $this->faker->word;
        $contentFilename = $this->faker->word;
        $contentId = $this->faker->word;
        $location = $this->faker->word;
        $content = $this->faker->text;

        $calItemType = \Zimbra\Common\Enum\InviteType::TASK();
        $tzStdOffset = $this->faker->randomNumber;
        $tzDayOffset = $this->faker->randomNumber;
        $method = $this->faker->word;
        $componentNum = $this->faker->randomNumber;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $seq = $this->faker->randomNumber;
        $date = $this->faker->unixTime;
        $attendee = $this->faker->email;
        $rangeType = $this->faker->numberBetween(1, 3);
        $recurId = $this->faker->uuid;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:RemoveAttachmentsResponse>
            <urn:m id="$id" i4uid="$imapUid" cif="$calendarIntendedFor" origid="$origId" rt="r" idnt="$identityId" forAcct="$draftAccountId" autoSendTime="$draftAutoSendTime" sd="$sentDate" rd="$resentDate" part="$part" xmlns:urn="urn:zimbraMail">
                <urn:fr>$fragment</urn:fr>
                <urn:e a="$address" d="$display" p="$personal" t="t" isGroup="true" exp="true" />
                <urn:su>$subject</urn:su>
                <urn:mid>$messageIdHeader</urn:mid>
                <urn:irt>$inReplyTo</urn:irt>
                <urn:inv type="task">
                    <urn:tz id="$id" stdoff="$tzStdOffset" dayoff="$tzDayOffset" />
                    <urn:comp method="$method" compNum="$componentNum" rsvp="true" />
                    <urn:replies>
                        <urn:reply rangeType="$rangeType" recurId="$recurId" seq="$seq" d="$date" at="$attendee" />
                    </urn:replies>
                </urn:inv>
                <urn:header n="$key">$value</urn:header>
                <urn:mp part="$part" ct="$contentType" s="$size" cd="$contentDisposition" filename="$contentFilename" ci="$contentId" cl="$location" body="true" truncated="true">
                    <urn:content>$content</urn:content>
                    <urn:mp part="$part" ct="$contentType" />
                </urn:mp>
                <urn:shr truncated="true">
                    <urn:content>$content</urn:content>
                </urn:shr>
                <urn:dlSubs truncated="true">
                    <urn:content>$content</urn:content>
                </urn:dlSubs>
            </urn:m>
        </urn:RemoveAttachmentsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->removeAttachments(new \Zimbra\Mail\Struct\MsgPartIds());

        $timezone = new \Zimbra\Mail\Struct\CalTZInfo($id, $tzStdOffset, $tzDayOffset);
        $inviteComponent = new \Zimbra\Mail\Struct\InviteComponent($method, $componentNum, TRUE);
        $calendarReply = new \Zimbra\Mail\Struct\CalendarReply($rangeType, $recurId, $seq, $date, $attendee);
        $invite = new \Zimbra\Mail\Struct\InviteInfo($calItemType, [$timezone], $inviteComponent, [$calendarReply]);
        $header = new \Zimbra\Common\Struct\KeyValuePair($key, $value);
        $email = new \Zimbra\Mail\Struct\EmailInfo($address, $display, $personal, $addressType, TRUE, TRUE);
        $mimePart = new \Zimbra\Mail\Struct\PartInfo($part, $contentType);
        $mp = new \Zimbra\Mail\Struct\PartInfo(
            $part, $contentType, $size, $contentDisposition, $contentFilename, $contentId, $location, TRUE, TRUE, $content, [$mimePart]
        );
        $shr = new \Zimbra\Mail\Struct\ShareNotification(TRUE, $content);
        $dlSubs = new \Zimbra\Mail\Struct\DLSubscriptionNotification(TRUE, $content);
        $msgInfo = new \Zimbra\Mail\Struct\MessageInfo(
            $id, $imapUid, $calendarIntendedFor, $origId, $draftReplyType, $identityId, $draftAccountId, $draftAutoSendTime, $sentDate, $resentDate, $part, $fragment, [$email], $subject, $messageIdHeader, $inReplyTo, $invite, [$header], [$mp], [$shr], [$dlSubs]
        );
        $this->assertEquals($msgInfo, $response->getMsgMessage());
    }

    public function testResetRecentMessageCount()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ResetRecentMessageCountResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->resetRecentMessageCount();
        $this->assertInstanceOf(\Zimbra\Mail\Message\ResetRecentMessageCountResponse::class, $response);
    }

    public function testRestoreContacts()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:RestoreContactsResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->restoreContacts($this->faker->word);
        $this->assertInstanceOf(\Zimbra\Mail\Message\RestoreContactsResponse::class, $response);
    }

    public function testRevokePermission()
    {
        $zimbraId = $this->faker->uuid;
        $displayName = $this->faker->name;
        $accessKey = $this->faker->word;
        $password = $this->faker->sha256;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:RevokePermissionResponse>
            <urn:ace gt="usr" right="invite" zid="$zimbraId" d="$displayName" key="$accessKey" pw="$password" deny="true" />
        </urn:RevokePermissionResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->revokePermission();

        $ace = new \Zimbra\Mail\Struct\AccountACEInfo(
            \Zimbra\Common\Enum\GranteeType::USR(), \Zimbra\Common\Enum\AceRightType::INVITE()->getValue(), $zimbraId, $displayName, $accessKey, $password, TRUE
        );
        $this->assertEquals([$ace], $response->getAces());
    }

    public function testSaveDocument()
    {
        $name = $this->faker->name;
        $id = $this->faker->uuid;
        $version = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:SaveDocumentResponse>
            <urn:doc id="$id" ver="$version" name="$name" />
        </urn:SaveDocumentResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->saveDocument(new \Zimbra\Mail\Struct\DocumentSpec());

        $doc = new \Zimbra\Mail\Struct\IdVersionName(
            $id, $version, $name
        );
        $this->assertEquals($doc, $response->getDoc());
    }

    public function testSaveDraft()
    {
        $id = $this->faker->uuid;
        $imapUid = $this->faker->randomNumber;
        $calendarIntendedFor = $this->faker->word;
        $origId = $this->faker->uuid;
        $draftReplyType = \Zimbra\Common\Enum\ReplyType::REPLIED();
        $identityId = $this->faker->uuid;
        $draftAccountId = $this->faker->uuid;
        $draftAutoSendTime = $this->faker->randomNumber;
        $sentDate = $this->faker->randomNumber;
        $resentDate = $this->faker->randomNumber;
        $part = $this->faker->word;
        $fragment = $this->faker->word;
        $subject = $this->faker->word;
        $messageIdHeader = $this->faker->word;
        $inReplyTo = $this->faker->word;

        $address = $this->faker->email;
        $display = $this->faker->name;
        $personal = $this->faker->word;
        $addressType = \Zimbra\Common\Enum\AddressType::TO();

        $contentType = $this->faker->mimeType;
        $size = $this->faker->randomNumber;
        $contentDisposition = $this->faker->word;
        $contentFilename = $this->faker->word;
        $contentId = $this->faker->word;
        $location = $this->faker->word;
        $content = $this->faker->text;

        $calItemType = \Zimbra\Common\Enum\InviteType::TASK();
        $tzStdOffset = $this->faker->randomNumber;
        $tzDayOffset = $this->faker->randomNumber;
        $method = $this->faker->word;
        $componentNum = $this->faker->randomNumber;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $seq = $this->faker->randomNumber;
        $date = $this->faker->unixTime;
        $attendee = $this->faker->email;
        $rangeType = $this->faker->numberBetween(1, 3);
        $recurId = $this->faker->uuid;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:SaveDraftResponse>
            <urn:m id="$id" i4uid="$imapUid" cif="$calendarIntendedFor" origid="$origId" rt="r" idnt="$identityId" forAcct="$draftAccountId" autoSendTime="$draftAutoSendTime" sd="$sentDate" rd="$resentDate" part="$part" xmlns:urn="urn:zimbraMail">
                <urn:fr>$fragment</urn:fr>
                <urn:e a="$address" d="$display" p="$personal" t="t" isGroup="true" exp="true" />
                <urn:su>$subject</urn:su>
                <urn:mid>$messageIdHeader</urn:mid>
                <urn:irt>$inReplyTo</urn:irt>
                <urn:inv type="task">
                    <urn:tz id="$id" stdoff="$tzStdOffset" dayoff="$tzDayOffset" />
                    <urn:comp method="$method" compNum="$componentNum" rsvp="true" />
                    <urn:replies>
                        <urn:reply rangeType="$rangeType" recurId="$recurId" seq="$seq" d="$date" at="$attendee" />
                    </urn:replies>
                </urn:inv>
                <urn:header n="$key">$value</urn:header>
                <urn:mp part="$part" ct="$contentType" s="$size" cd="$contentDisposition" filename="$contentFilename" ci="$contentId" cl="$location" body="true" truncated="true">
                    <urn:content>$content</urn:content>
                    <urn:mp part="$part" ct="$contentType" />
                </urn:mp>
                <urn:shr truncated="true">
                    <urn:content>$content</urn:content>
                </urn:shr>
                <urn:dlSubs truncated="true">
                    <urn:content>$content</urn:content>
                </urn:dlSubs>
            </urn:m>
        </urn:SaveDraftResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->saveDraft(new \Zimbra\Mail\Struct\SaveDraftMsg());

        $timezone = new \Zimbra\Mail\Struct\CalTZInfo($id, $tzStdOffset, $tzDayOffset);
        $inviteComponent = new \Zimbra\Mail\Struct\InviteComponent($method, $componentNum, TRUE);
        $calendarReply = new \Zimbra\Mail\Struct\CalendarReply($rangeType, $recurId, $seq, $date, $attendee);
        $invite = new \Zimbra\Mail\Struct\InviteInfo($calItemType, [$timezone], $inviteComponent, [$calendarReply]);
        $header = new \Zimbra\Common\Struct\KeyValuePair($key, $value);
        $email = new \Zimbra\Mail\Struct\EmailInfo($address, $display, $personal, $addressType, TRUE, TRUE);
        $mimePart = new \Zimbra\Mail\Struct\PartInfo($part, $contentType);
        $mp = new \Zimbra\Mail\Struct\PartInfo(
            $part, $contentType, $size, $contentDisposition, $contentFilename, $contentId, $location, TRUE, TRUE, $content, [$mimePart]
        );
        $shr = new \Zimbra\Mail\Struct\ShareNotification(TRUE, $content);
        $dlSubs = new \Zimbra\Mail\Struct\DLSubscriptionNotification(TRUE, $content);
        $msgInfo = new \Zimbra\Mail\Struct\MessageInfo(
            $id, $imapUid, $calendarIntendedFor, $origId, $draftReplyType, $identityId, $draftAccountId, $draftAutoSendTime, $sentDate, $resentDate, $part, $fragment, [$email], $subject, $messageIdHeader, $inReplyTo, $invite, [$header], [$mp], [$shr], [$dlSubs]
        );
        $this->assertEquals($msgInfo, $response->getMsgMessage());
    }

    public function testSaveIMAPSubscriptions()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:SaveIMAPSubscriptionsResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->saveIMAPSubscriptions();
        $this->assertInstanceOf(\Zimbra\Mail\Message\SaveIMAPSubscriptionsResponse::class, $response);
    }

    public function testSearchAction()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:SearchActionResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->searchAction(
            new \Zimbra\Mail\Message\SearchRequest(), new \Zimbra\Mail\Struct\BulkAction()
        );
        $this->assertInstanceOf(\Zimbra\Mail\Message\SearchActionResponse::class, $response);
    }

    public function testSearchConv()
    {
        $id = $this->faker->uuid;
        $conversationId = $this->faker->uuid;
        $query = $this->faker->word;
        $sortBy = \Zimbra\Common\Enum\SearchSortBy::DATE_DESC();

        $queryOffset = $this->faker->randomNumber;
        $totalSize = $this->faker->randomNumber;
        $num = $this->faker->randomNumber;
        $sortField = $this->faker->word;
        $part = $this->faker->word;

        $flags = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;

        $size = $this->faker->randomNumber;
        $folderId = $this->faker->uuid;
        $autoSendTime = $this->faker->unixTime;

        $string = $this->faker->word;
        $numExpanded = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:SearchConvResponse sortBy="dateDesc" offset="$queryOffset" more="true">
            <urn:c id="$id" n="$num" total="$totalSize" f="$flags" t="$tags" tn="$tagNames">
                <urn:m sf="$sortField" cm="true" id="$id">
                    <urn:hp part="$part" />
                </urn:m>
                <urn:info>
                    <urn:suggest>$string</urn:suggest>
                    <urn:wildcard str="$string" expanded="true" numExpanded="$numExpanded" />
                </urn:info>
            </urn:c>
            <urn:m sf="$sortField" cm="true" id="$id">
                <urn:hp part="$part" />
            </urn:m>
            <urn:info>
                <urn:suggest>$string</urn:suggest>
                <urn:wildcard str="$string" expanded="true" numExpanded="$numExpanded" />
            </urn:info>
        </urn:SearchConvResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->searchConv($conversationId, $query);

        $this->assertEquals($sortBy, $response->getSortBy());
        $this->assertSame($queryOffset, $response->getQueryOffset());
        $this->assertTrue($response->getQueryMore());

        $msgHit = new \Zimbra\Mail\Struct\MessageHitInfo(
            $id, $sortField, TRUE, [new \Zimbra\Mail\Struct\Part($part)]
        );
        $queryInfo = new \Zimbra\Mail\Struct\SearchQueryInfo(
            [new \Zimbra\Mail\Struct\SuggestedQueryString($string)], [new \Zimbra\Common\Struct\WildcardExpansionQueryInfo($string, TRUE, $numExpanded)]
        );
        $conversation = new \Zimbra\Mail\Struct\NestedSearchConversation(
            $id, $num, $totalSize, $flags, $tags, $tagNames, [$msgHit], $queryInfo
        );

        $this->assertEquals($conversation, $response->getConversation());
        $this->assertEquals([$msgHit], $response->getMessages());
        $this->assertEquals($queryInfo, $response->getQueryInfo());
    }

    public function testSearch()
    {
        $id = $this->faker->uuid;
        $query = $this->faker->word;
        $sortBy = \Zimbra\Common\Enum\SearchSortBy::DATE_DESC();

        $queryOffset = $this->faker->randomNumber;
        $totalSize = $this->faker->randomNumber;
        $sortField = $this->faker->word;
        $part = $this->faker->word;

        $flags = $this->faker->word;
        $date = $this->faker->unixTime;

        $size = $this->faker->randomNumber;
        $folderId = $this->faker->uuid;
        $autoSendTime = $this->faker->unixTime;

        $string = $this->faker->word;
        $numExpanded = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:SearchResponse sortBy="dateDesc" offset="$queryOffset" more="true" total="$totalSize">
            <urn:hit id="$id" sf="$sortField" />
            <urn:c sf="$sortField" id="$id">
                <urn:m id="$id" s="$size" l="$folderId" f="$flags" autoSendTime="$autoSendTime" d="$date" />
            </urn:c>
            <urn:m sf="$sortField" cm="true" id="$id">
                <urn:hp part="$part" />
            </urn:m>
            <urn:chat sf="$sortField" cm="true" id="$id">
                <urn:hp part="$part" />
            </urn:chat>
            <urn:mp sf="$sortField" id="$id" />
            <urn:cn sf="$sortField" id="$id" />
            <urn:note sf="$sortField" id="$id" />
            <urn:doc sf="$sortField" id="$id" />
            <urn:w sf="$sortField" id="$id" />
            <urn:appt sf="$sortField" id="$id" />
            <urn:task sf="$sortField" id="$id" />
            <urn:info>
                <urn:suggest>$string</urn:suggest>
                <urn:wildcard str="$string" expanded="true" numExpanded="$numExpanded" />
            </urn:info>
        </urn:SearchResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->search($query);

        $hit = new \Zimbra\Common\Struct\SimpleSearchHit($id, $sortField);
        $convHit = new \Zimbra\Mail\Struct\ConversationHitInfo(
            $id, $sortField, [new \Zimbra\Mail\Struct\ConversationMsgHitInfo(
                $id, $size, $folderId, $flags, $autoSendTime, $date
            )]
        );
        $msgHit = new \Zimbra\Mail\Struct\MessageHitInfo(
            $id, $sortField, TRUE, [new \Zimbra\Mail\Struct\Part($part)]
        );
        $chatHit = new \Zimbra\Mail\Struct\ChatHitInfo(
            $id, $sortField, TRUE, [new \Zimbra\Mail\Struct\Part($part)]
        );
        $mpHit = new \Zimbra\Mail\Struct\MessagePartHitInfo($id, $sortField);
        $cnHit = new \Zimbra\Mail\Struct\ContactInfo($id, $sortField);
        $noteHit = new \Zimbra\Mail\Struct\NoteHitInfo($id, $sortField);
        $docHit = new \Zimbra\Mail\Struct\DocumentHitInfo($id, $sortField);
        $wikiHit = new \Zimbra\Mail\Struct\WikiHitInfo($id, $sortField);
        $apptHit = new \Zimbra\Mail\Struct\AppointmentHitInfo($id, $sortField);
        $taskHit = new \Zimbra\Mail\Struct\TaskHitInfo($id, $sortField);

        $queryInfo = new \Zimbra\Mail\Struct\SearchQueryInfo(
            [new \Zimbra\Mail\Struct\SuggestedQueryString($string)],
            [new \Zimbra\Common\Struct\WildcardExpansionQueryInfo($string, TRUE, $numExpanded)]
        );

        $this->assertEquals($sortBy, $response->getSortBy());
        $this->assertSame($queryOffset, $response->getQueryOffset());
        $this->assertTrue($response->getQueryMore());
        $this->assertSame($totalSize, $response->getTotalSize());
        $this->assertEquals([$hit], $response->getSimpleHits());
        $this->assertEquals([$convHit], $response->getConversationHits());
        $this->assertEquals([$msgHit], $response->getMessageHits());
        $this->assertEquals([$chatHit], $response->getChatHits());
        $this->assertEquals([$mpHit], $response->getMessagePartHits());
        $this->assertEquals([$cnHit], $response->getContactHits());
        $this->assertEquals([$noteHit], $response->getNoteHits());
        $this->assertEquals([$docHit], $response->getDocumentHits());
        $this->assertEquals([$wikiHit], $response->getWikiHits());
        $this->assertEquals([$apptHit], $response->getAppointmentHits());
        $this->assertEquals([$taskHit], $response->getTaskHits());
        $this->assertEquals($queryInfo, $response->getQueryInfo());
    }

    public function testSendDeliveryReport()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:SendDeliveryReportResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->sendDeliveryReport($this->faker->uuid);
        $this->assertInstanceOf(\Zimbra\Mail\Message\SendDeliveryReportResponse::class, $response);
    }

    public function testSendInviteReply()
    {
        $id = $this->faker->uuid;
        $calItemId = $this->faker->uuid;
        $deprecatedApptId = $this->faker->uuid;
        $calInvId = $this->faker->uuid;
        $modifiedSequence = $this->faker->randomNumber;
        $revision = $this->faker->randomNumber;
        $part = $this->faker->word;
        $sentDate = $this->faker->unixTime;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:SendInviteReplyResponse calItemId="$calItemId" apptId="$deprecatedApptId" invId="$calInvId" ms="$modifiedSequence" rev="$revision">
            <urn:m id="$id" />
            <urn:echo>
                <urn:m id="$id" part="$part" sd="$sentDate" />
            </urn:echo>
        </urn:SendInviteReplyResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->sendInviteReply($this->faker->uuid, $this->faker->randomNumber);

        $this->assertSame($calItemId, $response->getCalItemId());
        $this->assertSame($deprecatedApptId, $response->getDeprecatedApptId());
        $this->assertSame($calInvId, $response->getCalInvId());
        $this->assertSame($modifiedSequence, $response->getModifiedSequence());
        $this->assertSame($revision, $response->getRevision());
        $this->assertEquals(new \Zimbra\Common\Struct\Id($id), $response->getMsg());
        $this->assertEquals(
            new \Zimbra\Mail\Struct\CalEcho(new \Zimbra\Mail\Struct\InviteAsMP($id, $part, $sentDate)),
            $response->getEcho()
        );
    }

    public function testSendMsg()
    {
        $id = $this->faker->word;
        $origId = $this->faker->uuid;
        $identityId = $this->faker->uuid;
        $subject = $this->faker->text;
        $inReplyTo = $this->faker->uuid;
        $content = $this->faker->text;
        $fragment = $this->faker->text;
        $contentType = $this->faker->word;
        $contentId = $this->faker->uuid;
        $key = $this->faker->name;
        $value = $this->faker->word;
        $method = $this->faker->word;
        $componentNum = $this->faker->randomNumber;
        $address = $this->faker->email;
        $personal = $this->faker->word;
        $tzStdOffset = $this->faker->randomNumber;
        $tzDayOffset = $this->faker->randomNumber;

        $imapUid = $this->faker->randomNumber;
        $calendarIntendedFor = $this->faker->word;
        $draftReplyType = \Zimbra\Common\Enum\ReplyType::REPLIED();
        $draftAccountId = $this->faker->email;
        $draftAutoSendTime = $this->faker->unixTime;
        $sentDate = $this->faker->unixTime;
        $resentDate = $this->faker->unixTime;
        $part = $this->faker->word;
        $messageIdHeader = $this->faker->uuid;

        $display = $this->faker->name;
        $addressType = \Zimbra\Common\Enum\AddressType::TO();
        $calItemType = \Zimbra\Common\Enum\InviteType::TASK();

        $seq = $this->faker->randomNumber;
        $date = $this->faker->unixTime;
        $attendee = $this->faker->email;
        $rangeType = $this->faker->numberBetween(1, 3);
        $recurId = $this->faker->uuid;
        $url = $this->faker->url;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:SendMsgResponse>
            <urn:m id="$id" i4uid="$imapUid" cif="$calendarIntendedFor" origid="$origId" rt="r" idnt="$identityId" forAcct="$draftAccountId" autoSendTime="$draftAutoSendTime" sd="$sentDate" rd="$resentDate" part="$part">
                <urn:fr>$fragment</urn:fr>
                <urn:e a="$address" d="$display" p="$personal" t="t" isGroup="true" exp="true" />
                <urn:su>$subject</urn:su>
                <urn:mid>$messageIdHeader</urn:mid>
                <urn:irt>$inReplyTo</urn:irt>
                <urn:inv type="task">
                    <urn:tz id="$id" stdoff="$tzStdOffset" dayoff="$tzDayOffset" />
                    <urn:comp method="$method" compNum="$componentNum" rsvp="true" />
                    <urn:replies>
                        <urn:reply rangeType="$rangeType" recurId="$recurId" seq="$seq" d="$date" at="$attendee" />
                    </urn:replies>
                </urn:inv>
                <urn:header n="$key">$value</urn:header>
                <urn:mp ct="$contentType" content="$content" ci="$contentId" />
                <urn:shr truncated="true">
                    <urn:content>$content</urn:content>
                </urn:shr>
                <urn:dlSubs truncated="true">
                    <urn:content>$content</urn:content>
                </urn:dlSubs>
                <urn:content url="$url">$value</urn:content>
            </urn:m>
        </urn:SendMsgResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->sendMsg(new \Zimbra\Mail\Struct\MsgToSend());

        $timezone = new \Zimbra\Mail\Struct\CalTZInfo($id, $tzStdOffset, $tzDayOffset);
        $inviteComponent = new \Zimbra\Mail\Struct\InviteComponentWithGroupInfo($method, $componentNum, TRUE);
        $calendarReply = new \Zimbra\Mail\Struct\CalendarReply($rangeType, $recurId, $seq, $date, $attendee);
        $email = new \Zimbra\Mail\Struct\EmailInfo($address, $display, $personal, $addressType, TRUE, TRUE);
        $invite = new \Zimbra\Mail\Struct\InviteWithGroupInfo(
            $calItemType, [$timezone], [$inviteComponent], [$calendarReply]
        );
        $header = new \Zimbra\Common\Struct\KeyValuePair($key, $value);
        $mimePart = new \Zimbra\Mail\Struct\MimePartInfo($contentType, $content, $contentId);
        $shr = new \Zimbra\Mail\Struct\ShareNotification(TRUE, $content);
        $dlSubs = new \Zimbra\Mail\Struct\DLSubscriptionNotification(TRUE, $content);
        $urlValue = new \Zimbra\Common\Struct\UrlAndValue($url, $value);
        $msg = new \Zimbra\Mail\Struct\MsgWithGroupInfo(
            $id, $imapUid, $calendarIntendedFor, $origId, $draftReplyType, $identityId, $draftAccountId, $draftAutoSendTime, $sentDate, $resentDate, $part, $fragment, [$email], $subject, $messageIdHeader, $inReplyTo, $invite, [$header], $mimePart, $shr, $dlSubs, $urlValue
        );
        $this->assertEquals($msg, $response->getMsg());
    }

    public function testSendShareNotification()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:SendShareNotificationResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->sendShareNotification(new \Zimbra\Common\Struct\Id());
        $this->assertInstanceOf(\Zimbra\Mail\Message\SendShareNotificationResponse::class, $response);
    }

    public function testSendVerificationCode()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:SendVerificationCodeResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->sendVerificationCode($this->faker->email);
        $this->assertInstanceOf(\Zimbra\Mail\Message\SendVerificationCodeResponse::class, $response);
    }

    public function testSetAppointment()
    {
        $id = $this->faker->word;
        $calItemId = $this->faker->uuid;
        $deprecatedApptId = $this->faker->uuid;
        $recurrenceId = $this->faker->uuid;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:SetAppointmentResponse calItemId="$calItemId" apptId="$deprecatedApptId">
            <urn:default id="$id" />
            <urn:except recurId="$recurrenceId" id="$id" />
        </urn:SetAppointmentResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->setAppointment();

        $default = new \Zimbra\Common\Struct\Id($id);
        $except = new \Zimbra\Mail\Struct\ExceptIdInfo($recurrenceId, $id);

        $this->assertSame($calItemId, $response->getCalItemId());
        $this->assertSame($deprecatedApptId, $response->getDeprecatedApptId());
        $this->assertEquals($default, $response->getDefaultId());
        $this->assertEquals([$except], $response->getExceptions());
    }

    public function testSetCustomMetadata()
    {
        $id = $this->faker->uuid;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:SetCustomMetadataResponse id="$id" />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->setCustomMetadata(new \Zimbra\Mail\Struct\MailCustomMetadata(), $id);
        $this->assertSame($id, $response->getId());
    }

    public function testSetMailboxMetadata()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:SetMailboxMetadataResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->setMailboxMetadata(new \Zimbra\Mail\Struct\MailCustomMetadata());
        $this->assertInstanceOf(\Zimbra\Mail\Message\SetMailboxMetadataResponse::class, $response);
    }

    public function testSetRecoveryAccount()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:SetRecoveryAccountResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->setRecoveryAccount();
        $this->assertInstanceOf(\Zimbra\Mail\Message\SetRecoveryAccountResponse::class, $response);
    }

    public function testSetTask()
    {
        $id = $this->faker->word;
        $calItemId = $this->faker->uuid;
        $deprecatedApptId = $this->faker->uuid;
        $recurrenceId = $this->faker->uuid;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:SetTaskResponse calItemId="$calItemId" apptId="$deprecatedApptId">
            <urn:default id="$id" />
            <urn:except recurId="$recurrenceId" id="$id" />
        </urn:SetTaskResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->setTask();

        $default = new \Zimbra\Common\Struct\Id($id);
        $except = new \Zimbra\Mail\Struct\ExceptIdInfo($recurrenceId, $id);

        $this->assertSame($calItemId, $response->getCalItemId());
        $this->assertSame($deprecatedApptId, $response->getDeprecatedApptId());
        $this->assertEquals($default, $response->getDefaultId());
        $this->assertEquals([$except], $response->getExceptions());
    }


    public function testSnoozeCalendarItemAlarm()
    {
        $calItemId = $this->faker->uuid;
        $nextAlarm = $this->faker->randomNumber;
        $alarmInstanceStart = $this->faker->randomNumber;
        $invId = $this->faker->randomNumber;
        $componentNum = $this->faker->randomNumber;

        $action = \Zimbra\Common\Enum\AlarmAction::DISPLAY();
        $name = $this->faker->name;
        $value = $this->faker->word;
        $date = $this->faker->date;
        $weeks = mt_rand(1, 100);
        $days = mt_rand(1, 30);
        $hours = mt_rand(0, 23);
        $minutes = mt_rand(0, 59);
        $seconds = mt_rand(0, 59);
        $uri = $this->faker->url;
        $contentType = $this->faker->mimeType;
        $binaryB64Data = base64_encode($this->faker->text);
        $description = $this->faker->text;
        $summary = $this->faker->text;
        $location = $this->faker->text;

        $address = $this->faker->email;
        $displayName = $this->faker->name;
        $role = $this->faker->word;
        $partStat = \Zimbra\Common\Enum\ParticipationStatus::ACCEPT();

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:SnoozeCalendarItemAlarmResponse>
            <urn:appt calItemId="$calItemId">
                <urn:alarmData nextAlarm="$nextAlarm" alarmInstStart="$alarmInstanceStart" invId="$invId" compNum="$componentNum" name="$name" loc="$location">
                    <urn:alarm action="DISPLAY">
                        <urn:trigger>
                            <urn:abs d="$date" />
                            <urn:rel w="$weeks" d="$days" h="$hours" m="$minutes" s="$seconds" />
                        </urn:trigger>
                        <urn:repeat w="$weeks" d="$days" h="$hours" m="$minutes" s="$seconds" />
                        <urn:desc>$description</urn:desc>
                        <urn:attach uri="$uri" ct="$contentType">$binaryB64Data</urn:attach>
                        <urn:summary>$summary</urn:summary>
                        <urn:at a="$address" d="$displayName" role="$role" ptst="AC" rsvp="true">
                            <urn:xparam name="$name" value="$value" />
                        </urn:at>
                        <urn:xprop name="$name" value="$value">
                            <urn:xparam name="$name" value="$value" />
                        </urn:xprop>
                    </urn:alarm>
                </urn:alarmData>
            </urn:appt>
            <urn:task calItemId="$calItemId">
                <urn:alarmData nextAlarm="$nextAlarm" alarmInstStart="$alarmInstanceStart" invId="$invId" compNum="$componentNum" name="$name" loc="$location">
                    <urn:alarm action="DISPLAY">
                        <urn:trigger>
                            <urn:abs d="$date" />
                            <urn:rel w="$weeks" d="$days" h="$hours" m="$minutes" s="$seconds" />
                        </urn:trigger>
                        <urn:repeat w="$weeks" d="$days" h="$hours" m="$minutes" s="$seconds" />
                        <urn:desc>$description</urn:desc>
                        <urn:attach uri="$uri" ct="$contentType">$binaryB64Data</urn:attach>
                        <urn:summary>$summary</urn:summary>
                        <urn:at a="$address" d="$displayName" role="$role" ptst="AC" rsvp="true">
                            <urn:xparam name="$name" value="$value" />
                        </urn:at>
                        <urn:xprop name="$name" value="$value">
                            <urn:xparam name="$name" value="$value" />
                        </urn:xprop>
                    </urn:alarm>
                </urn:alarmData>
            </urn:task>
        </urn:SnoozeCalendarItemAlarmResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->snoozeCalendarItemAlarm();

        $trigger = new \Zimbra\Mail\Struct\AlarmTriggerInfo(
            new \Zimbra\Mail\Struct\DateAttr($date), new \Zimbra\Mail\Struct\DurationInfo($weeks, $days, $hours, $minutes, $seconds)
        );
        $repeat = new \Zimbra\Mail\Struct\DurationInfo($weeks, $days, $hours, $minutes, $seconds);
        $attach = new \Zimbra\Mail\Struct\CalendarAttach($uri, $contentType, $binaryB64Data);
        $at = new \Zimbra\Mail\Struct\CalendarAttendee($address, $displayName, $role, $partStat, TRUE, [new \Zimbra\Mail\Struct\XParam($name, $value)]);
        $xprop = new \Zimbra\Mail\Struct\XProp($name, $value, [new \Zimbra\Mail\Struct\XParam($name, $value)]);
        $alarm = new \Zimbra\Mail\Struct\AlarmInfo($action, $trigger, $repeat, $description, $attach, $summary, [$at], [$xprop]);
        $alarmData = new \Zimbra\Mail\Struct\AlarmDataInfo(
            $nextAlarm, $alarmInstanceStart, $invId, $componentNum, $name, $location, $alarm
        );
        $appt = new \Zimbra\Mail\Struct\UpdatedAppointmentAlarmInfo(
            $calItemId, $alarmData
        );
        $task = new \Zimbra\Mail\Struct\UpdatedTaskAlarmInfo(
            $calItemId, $alarmData
        );

        $this->assertEquals([$appt], $response->getApptUpdatedAlarms());
        $this->assertEquals([$task], $response->getTaskUpdatedAlarms());
    }

    public function testSync()
    {
        $id = $this->faker->uuid;
        $uuid = $this->faker->uuid;
        $ids = $this->faker->word;
        $token = $this->faker->text;
        $changeDate = $this->faker->unixTime;
        $size = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:SyncResponse md="$changeDate" token="$token" s="$size" more="true">
            <urn:deleted ids="$ids">
                <urn:folder ids="$ids" />
                <urn:search ids="$ids" />
                <urn:link ids="$ids" />
                <urn:tag ids="$ids" />
                <urn:c ids="$ids" />
                <urn:chat ids="$ids" />
                <urn:m ids="$ids" />
                <urn:cn ids="$ids" />
                <urn:appt ids="$ids" />
                <urn:task ids="$ids" />
                <urn:notes ids="$ids" />
                <urn:w ids="$ids" />
                <urn:doc ids="$ids" />
            </urn:deleted>
            <urn:folder id="$id" uuid="$uuid">
                <urn:tag ids="$ids" />
                <urn:c ids="$ids" />
                <urn:chat ids="$ids" />
                <urn:m ids="$ids" />
                <urn:cn ids="$ids" />
                <urn:appt ids="$ids" />
                <urn:task ids="$ids" />
                <urn:notes ids="$ids" />
                <urn:w ids="$ids" />
                <urn:doc ids="$ids" />
            </urn:folder>
            <urn:tag id="$id" />
            <urn:note id="$id" />
            <urn:cn id="$id" />
            <urn:appt />
            <urn:task />
            <urn:c id="$id" />
            <urn:w id="$id" />
            <urn:doc id="$id" />
            <urn:m id="$id" />
            <urn:chat id="$id" />
        </urn:SyncResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->sync();

        $deleted = new \Zimbra\Mail\Struct\SyncDeletedInfo($ids, [
            new \Zimbra\Mail\Struct\FolderIdsAttr($ids),
            new \Zimbra\Mail\Struct\SearchFolderIdsAttr($ids),
            new \Zimbra\Mail\Struct\MountIdsAttr($ids),
            new \Zimbra\Mail\Struct\TagIdsAttr($ids),
            new \Zimbra\Mail\Struct\ConvIdsAttr($ids),
            new \Zimbra\Mail\Struct\ChatIdsAttr($ids),
            new \Zimbra\Mail\Struct\MsgIdsAttr($ids),
            new \Zimbra\Mail\Struct\ContactIdsAttr($ids),
            new \Zimbra\Mail\Struct\ApptIdsAttr($ids),
            new \Zimbra\Mail\Struct\TaskIdsAttr($ids),
            new \Zimbra\Mail\Struct\NoteIdsAttr($ids),
            new \Zimbra\Mail\Struct\WikiIdsAttr($ids),
            new \Zimbra\Mail\Struct\DocIdsAttr($ids),
        ]);
        $folder = new \Zimbra\Mail\Struct\SyncFolder($id, $uuid, [
            new \Zimbra\Mail\Struct\TagIdsAttr($ids),
            new \Zimbra\Mail\Struct\ConvIdsAttr($ids),
            new \Zimbra\Mail\Struct\ChatIdsAttr($ids),
            new \Zimbra\Mail\Struct\MsgIdsAttr($ids),
            new \Zimbra\Mail\Struct\ContactIdsAttr($ids),
            new \Zimbra\Mail\Struct\ApptIdsAttr($ids),
            new \Zimbra\Mail\Struct\TaskIdsAttr($ids),
            new \Zimbra\Mail\Struct\NoteIdsAttr($ids),
            new \Zimbra\Mail\Struct\WikiIdsAttr($ids),
            new \Zimbra\Mail\Struct\DocIdsAttr($ids),
        ]);
        $items = [
            $folder,
            new \Zimbra\Mail\Struct\TagInfo($id),
            new \Zimbra\Mail\Struct\NoteInfo($id),
            new \Zimbra\Mail\Struct\ContactInfo($id),
            new \Zimbra\Mail\Struct\CalendarItemInfo(),
            new \Zimbra\Mail\Struct\TaskItemInfo(),
            new \Zimbra\Mail\Struct\ConversationSummary($id),
            new \Zimbra\Mail\Struct\CommonDocumentInfo($id),
            new \Zimbra\Mail\Struct\DocumentInfo($id),
            new \Zimbra\Mail\Struct\MessageSummary($id),
            new \Zimbra\Mail\Struct\ChatSummary($id),
        ];

        $this->assertSame($changeDate, $response->getChangeDate());
        $this->assertSame($token, $response->getToken());
        $this->assertSame($size, $response->getSize());
        $this->assertTrue($response->getMore());
        $this->assertEquals($deleted, $response->getDeleted());
        $this->assertEquals($items, array_values($response->getItems()));
    }

    public function testTagAction()
    {
        $operation = $this->faker->randomElement(\Zimbra\Common\Enum\TagActionOp::values())->getValue();
        $id = $this->faker->uuid;
        $successes = $this->faker->uuid;
        $successNames = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:TagActionResponse>
            <urn:action id="$successes" tn="$successNames" op="$operation" />
        </urn:TagActionResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->tagAction(new \Zimbra\Mail\Struct\TagActionSelector($operation));

        $action = new \Zimbra\Mail\Struct\TagActionInfo(
            $successes, $successNames, $operation
        );
        $this->assertEquals($action, $response->getAction());
    }

    public function testTestDataSource()
    {
        $error = $this->faker->text;
        $success = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:TestDataSourceResponse>
            <urn:imap success="$success" error="$error" />
            <urn:pop3 success="$success" error="$error" />
            <urn:caldav success="$success" error="$error" />
            <urn:yab success="$success" error="$error" />
            <urn:rss success="$success" error="$error" />
            <urn:gal success="$success" error="$error" />
            <urn:cal success="$success" error="$error" />
            <urn:unknown success="$success" error="$error" />
        </urn:TestDataSourceResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->testDataSource(new \Zimbra\Mail\Struct\MailImapDataSource($this->faker->uuid));

        $test = new \Zimbra\Mail\Struct\TestDataSource(
            $success, $error
        );
        $this->assertEquals([$test], $response->getImapDataSources());
        $this->assertEquals([$test], $response->getPop3DataSources());
        $this->assertEquals([$test], $response->getCaldavDataSources());
        $this->assertEquals([$test], $response->getYabDataSources());
        $this->assertEquals([$test], $response->getRssDataSources());
        $this->assertEquals([$test], $response->getGalDataSources());
        $this->assertEquals([$test], $response->getCalDataSources());
        $this->assertEquals([$test], $response->getUnknownDataSources());
        $this->assertEquals([
            $test,
            $test,
            $test,
            $test,
            $test,
            $test,
            $test,
            $test,
        ], array_values($response->getDataSources()));
    }

    public function testVerifyCode()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:VerifyCodeResponse success="true" />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->verifyCode();
        $this->assertTrue($response->getSuccess());
    }

    public function testWaitSet()
    {
        $waitSetId = $this->faker->uuid;
        $lastKnownSeqNo = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->randomNumber;
        $uid = $this->faker->uuid;

        $seqNo = $this->faker->word;
        $type = $this->faker->word;

        $folderId = $this->faker->randomNumber;
        $imapUid = $this->faker->randomNumber;
        $flags = $this->faker->randomNumber;
        $tags = $this->faker->word;
        $path = $this->faker->word;
        $changeBitmask = $this->faker->randomNumber;
        $lastChangeId = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:WaitSetResponse waitSet="$waitSetId" canceled="true" seq="$seqNo">
            <urn:a id="$id" changeid="$lastChangeId">
                <urn:mods id="$folderId">
                    <urn:created>
                        <urn:m id="$id" i4uid="$imapUid" t="$type" f="$flags" tn="$tags" />
                    </urn:created>
                    <urn:deleted id="$id" t="$type" />
                    <urn:modMsgs change="$changeBitmask">
                        <urn:m id="$id" i4uid="$imapUid" t="$type" f="$flags" tn="$tags" />
                    </urn:modMsgs>
                    <urn:modTags change="$changeBitmask">
                        <urn:id>$id</urn:id>
                        <urn:name>$name</urn:name>
                    </urn:modTags>
                    <urn:modFolders id="$folderId" path="$path" change="$changeBitmask" />
                </urn:mods>
            </urn:a>
            <urn:error id="$uid" type="$type" />
        </urn:WaitSetResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->waitSet($waitSetId, $lastKnownSeqNo);

        $msgInfo = new \Zimbra\Mail\Struct\ImapMessageInfo($id, $imapUid, $type, $flags, $tags);
        $created = new \Zimbra\Mail\Struct\CreateItemNotification($msgInfo);
        $deleted = new \Zimbra\Mail\Struct\DeleteItemNotification($id, $type);
        $modMsg = new \Zimbra\Mail\Struct\ModifyItemNotification($msgInfo, $changeBitmask);
        $modTag = new \Zimbra\Mail\Struct\ModifyTagNotification($id, $name, $changeBitmask);
        $modFolder = new \Zimbra\Mail\Struct\RenameFolderNotification($folderId, $path, $changeBitmask);
        $mod = new \Zimbra\Mail\Struct\PendingFolderModifications(
            $folderId, [$created], [$deleted], [$modMsg], [$modTag], [$modFolder]
        );
        $account = new \Zimbra\Mail\Struct\AccountWithModifications($id, [$mod], $lastChangeId);
        $error = new \Zimbra\Common\Struct\IdAndType($uid, $type);

        $this->assertSame($waitSetId, $response->getWaitSetId());
        $this->assertTrue($response->getCanceled());
        $this->assertSame($seqNo, $response->getSeqNo());
        $this->assertEquals([$account], $response->getSignalledAccounts());
        $this->assertEquals([$error], $response->getErrors());
    }
}

class StubMailApi extends MailApi
{
    public function __construct(ClientInterface $client)
    {
        $this->setClient($client);
    }
}
