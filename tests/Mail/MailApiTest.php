<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail;

use Zimbra\Mail\{MailApi, MailApiInterface};
use Zimbra\Soap\ClientInterface;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for account api.
 */
class MailApiTest extends ZimbraTestCase
{
    public function testMailApi()
    {
        $api = $this->createStub(MailApi::class);
        $this->assertTrue($api instanceof MailApiInterface);
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
        $this->assertTrue($response instanceof \Zimbra\Mail\Message\AnnounceOrganizerChangeResponse);
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

        $match = new \Zimbra\Mail\Struct\AutoCompleteMatch(
            $email, $matchType, $ranking, TRUE, TRUE, $id, $folder, $displayName, $firstName, $middleName, $lastName, $fullName, $nickname, $company, $fileAs
        );

        $api = new StubMailApi($this->mockSoapClient($xml));
        $response = $api->autoComplete($this->faker->name);
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
        $this->assertTrue($response instanceof \Zimbra\Mail\Message\BeginTrackingIMAPResponse);
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
        $this->assertTrue($response instanceof \Zimbra\Mail\Message\BounceMsgResponse);
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
        $this->assertTrue($response instanceof \Zimbra\Mail\Message\CancelAppointmentResponse);
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
        $this->assertTrue($response instanceof \Zimbra\Mail\Message\CancelTaskResponse);
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
        $this->assertTrue($response instanceof \Zimbra\Mail\Message\CompleteTaskInstanceResponse);
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
        $this->assertTrue($response instanceof \Zimbra\Mail\Message\CounterAppointmentResponse);
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
        $id = $this->faker->randomNumber;
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
        $this->assertTrue($response instanceof \Zimbra\Mail\Message\DeclineCounterAppointmentResponse);
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
        $this->assertTrue($response instanceof \Zimbra\Mail\Message\DeleteDataSourceResponse);
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
        $this->assertTrue($response instanceof \Zimbra\Mail\Message\EmptyDumpsterResponse);
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
        $this->assertTrue($response instanceof \Zimbra\Mail\Message\EnableSharedReminderResponse);
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
        $this->assertTrue($response instanceof \Zimbra\Mail\Message\ForwardAppointmentInviteResponse);
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
        $this->assertTrue($response instanceof \Zimbra\Mail\Message\ForwardAppointmentResponse);
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
}

class StubMailApi extends MailApi
{
    public function __construct(ClientInterface $client)
    {
        $this->setClient($client);
    }
}
