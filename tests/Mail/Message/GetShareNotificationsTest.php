<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\GetShareNotificationsEnvelope;
use Zimbra\Mail\Message\GetShareNotificationsBody;
use Zimbra\Mail\Message\GetShareNotificationsRequest;
use Zimbra\Mail\Message\GetShareNotificationsResponse;

use Zimbra\Mail\Struct\Grantor;
use Zimbra\Mail\Struct\LinkInfo;
use Zimbra\Mail\Struct\ShareNotificationInfo;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetShareNotifications.
 */
class GetShareNotificationsTest extends ZimbraTestCase
{
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

        $share = new ShareNotificationInfo(
            $status, $id, $date, new Grantor($id, $email, $name), new LinkInfo($id, $uuid, $name, $defaultView, $rights)
        );

        $response = new GetShareNotificationsResponse([$share]);
        $this->assertSame([$share], $response->getShares());
        $response = new GetShareNotificationsResponse();
        $response->setShares([$share]);
        $this->assertSame([$share], $response->getShares());

        $request = new GetShareNotificationsRequest();
        $response = new GetShareNotificationsResponse([$share]);

        $body = new GetShareNotificationsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetShareNotificationsBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetShareNotificationsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetShareNotificationsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetShareNotificationsRequest />
        <urn:GetShareNotificationsResponse>
            <urn:share status="$status" id="$id" d="$date">
                <urn:grantor id="$id" email="$email" name="$name" />
                <urn:link id="$id" uuid="$uuid" name="$name" view="$defaultView" perm="$rights" />
            </urn:share>
        </urn:GetShareNotificationsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetShareNotificationsEnvelope::class, 'xml'));
    }
}
