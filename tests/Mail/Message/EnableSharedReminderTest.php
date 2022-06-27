<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Struct\SharedReminderMount;

use Zimbra\Mail\Message\EnableSharedReminderEnvelope;
use Zimbra\Mail\Message\EnableSharedReminderBody;
use Zimbra\Mail\Message\EnableSharedReminderRequest;
use Zimbra\Mail\Message\EnableSharedReminderResponse;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for EnableSharedReminder.
 */
class EnableSharedReminderTest extends ZimbraTestCase
{
    public function testEnableSharedReminder()
    {
        $id = $this->faker->uuid;
        $mount = new SharedReminderMount(
            $id, TRUE
        );

        $request = new EnableSharedReminderRequest($mount);
        $this->assertSame($mount, $request->getMount());
        $request = new EnableSharedReminderRequest(new SharedReminderMount(''));
        $request->setMount($mount);
        $this->assertSame($mount, $request->getMount());

        $response = new EnableSharedReminderResponse();

        $body = new EnableSharedReminderBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new EnableSharedReminderBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new EnableSharedReminderEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new EnableSharedReminderEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:EnableSharedReminderRequest>
            <link id="$id" reminder="true" />
        </urn:EnableSharedReminderRequest>
        <urn:EnableSharedReminderResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, EnableSharedReminderEnvelope::class, 'xml'));
    }
}
