<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\AddressType;
use Zimbra\Common\Enum\ShareAction;
use Zimbra\Common\Struct\Id;

use Zimbra\Mail\Message\SendShareNotificationEnvelope;
use Zimbra\Mail\Message\SendShareNotificationBody;
use Zimbra\Mail\Message\SendShareNotificationRequest;
use Zimbra\Mail\Message\SendShareNotificationResponse;

use Zimbra\Mail\Struct\EmailAddrInfo;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SendShareNotification.
 */
class SendShareNotificationTest extends ZimbraTestCase
{
    public function testSendShareNotification()
    {
        $id = $this->faker->uuid;
        $action = ShareAction::EDIT;
        $notes = $this->faker->text;
        $address = $this->faker->email;
        $addressType = AddressType::TO;
        $personal = $this->faker->word;

        $item = new Id($id);
        $email = new EmailAddrInfo($address, $addressType, $personal);

        $request = new SendShareNotificationRequest(
            $item, [$email], $action, $notes
        );
        $this->assertSame($item, $request->getItem());
        $this->assertSame([$email], $request->getEmailAddresses());
        $this->assertSame($action, $request->getAction());
        $this->assertSame($notes, $request->getNotes());
        $request = new SendShareNotificationRequest(new Id());
        $request->setItem($item)
            ->setEmailAddresses([$email])
            ->addEmailAddress($email)
            ->setAction($action)
            ->setNotes($notes);
        $this->assertSame($item, $request->getItem());
        $this->assertSame([$email, $email], $request->getEmailAddresses());
        $this->assertSame($action, $request->getAction());
        $this->assertSame($notes, $request->getNotes());
        $request->setEmailAddresses([$email]);

        $response = new SendShareNotificationResponse();

        $body = new SendShareNotificationBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new SendShareNotificationBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new SendShareNotificationEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new SendShareNotificationEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:SendShareNotificationRequest action="edit">
            <urn:item id="$id" />
            <urn:e a="$address" t="t" p="$personal" />
            <urn:notes>$notes</urn:notes>
        </urn:SendShareNotificationRequest>
        <urn:SendShareNotificationResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, SendShareNotificationEnvelope::class, 'xml'));
    }
}
