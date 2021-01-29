<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\MailQueueFlushBody;
use Zimbra\Admin\Message\MailQueueFlushEnvelope;
use Zimbra\Admin\Message\MailQueueFlushRequest;
use Zimbra\Admin\Message\MailQueueFlushResponse;

use Zimbra\Struct\NamedElement;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for MailQueueFlush.
 */
class MailQueueFlushTest extends ZimbraTestCase
{
    public function testMailQueueFlush()
    {
        $name = $this->faker->word;
        $server = new NamedElement($name);

        $request = new MailQueueFlushRequest($server);
        $this->assertSame($server, $request->getServer());
        $request = new MailQueueFlushRequest(
            new NamedElement('')
        );
        $request->setServer($server);
        $this->assertSame($server, $request->getServer());

        $response = new MailQueueFlushResponse();

        $body = new MailQueueFlushBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new MailQueueFlushBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new MailQueueFlushEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new MailQueueFlushEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:MailQueueFlushRequest>
            <server name="$name" />
        </urn:MailQueueFlushRequest>
        <urn:MailQueueFlushResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, MailQueueFlushEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'MailQueueFlushRequest' => [
                    'server' => [
                        'name' => $name,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'MailQueueFlushResponse' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, MailQueueFlushEnvelope::class, 'json'));
    }
}
