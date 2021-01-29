<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\VerifyIndexBody;
use Zimbra\Admin\Message\VerifyIndexEnvelope;
use Zimbra\Admin\Message\VerifyIndexRequest;
use Zimbra\Admin\Message\VerifyIndexResponse;
use Zimbra\Admin\Struct\MailboxByAccountIdSelector;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for VerifyIndex.
 */
class VerifyIndexTest extends ZimbraTestCase
{
    public function testVerifyIndex()
    {
        $id = $this->faker->uuid;
        $message = $this->faker->word;

        $mbox = new MailboxByAccountIdSelector($id);
        $request = new VerifyIndexRequest($mbox);
        $this->assertSame($mbox, $request->getMbox());
        $request = new VerifyIndexRequest();
        $request->setMbox($mbox);
        $this->assertSame($mbox, $request->getMbox());

        $response = new VerifyIndexResponse(FALSE, $message);
        $this->assertFalse($response->isStatus());
        $this->assertSame($message, $response->getMessage());

        $response = new VerifyIndexResponse(FALSE, '');
        $response->setStatus(TRUE)
            ->setMessage($message);
        $this->assertTrue($response->isStatus());
        $this->assertSame($message, $response->getMessage());

        $body = new VerifyIndexBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new VerifyIndexBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new VerifyIndexEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new VerifyIndexEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:VerifyIndexRequest>
            <mbox id="$id" />
        </urn:VerifyIndexRequest>
        <urn:VerifyIndexResponse>
            <status>true</status>
            <message>$message</message>
        </urn:VerifyIndexResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, VerifyIndexEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'VerifyIndexRequest' => [
                    'mbox' => [
                        'id' => $id,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'VerifyIndexResponse' => [
                    'status' => [
                        '_content' => TRUE,
                    ],
                    'message' => [
                        '_content' => $message,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, VerifyIndexEnvelope::class, 'json'));
    }
}
