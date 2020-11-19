<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\DeleteMailboxBody;
use Zimbra\Admin\Message\DeleteMailboxEnvelope;
use Zimbra\Admin\Message\DeleteMailboxRequest;
use Zimbra\Admin\Message\DeleteMailboxResponse;
use Zimbra\Admin\Struct\MailboxByAccountIdSelector;
use Zimbra\Admin\Struct\MailboxWithMailboxId;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for DeleteMailbox.
 */
class DeleteMailboxTest extends ZimbraStructTestCase
{
    public function testDeleteMailbox()
    {
        $id = $this->faker->uuid;
        $mbxid = mt_rand(1, 100);
        $size = mt_rand(1, 100);

        $accountId = new MailboxByAccountIdSelector($id);
        $mboxId = new MailboxWithMailboxId($mbxid, $id, $size);

        $request = new DeleteMailboxRequest($accountId);
        $this->assertSame($accountId, $request->getMbox());
        $request = new DeleteMailboxRequest();
        $request->setMbox($accountId);
        $this->assertSame($accountId, $request->getMbox());

        $response = new DeleteMailboxResponse($mboxId);
        $this->assertSame($mboxId, $response->getMbox());
        $response = new DeleteMailboxResponse(new MailboxWithMailboxId(0, '', 0));
        $response->setMbox($mboxId);
        $this->assertSame($mboxId, $response->getMbox());

        $body = new DeleteMailboxBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new DeleteMailboxBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new DeleteMailboxEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new DeleteMailboxEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:DeleteMailboxRequest>'
                        . '<mbox id="' . $id . '" />'
                    . '</urn:DeleteMailboxRequest>'
                    . '<urn:DeleteMailboxResponse>'
                        . '<mbox mbxid="' . $mbxid . '" id="' . $id . '" s="' . $size . '" />'
                    . '</urn:DeleteMailboxResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, DeleteMailboxEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'DeleteMailboxRequest' => [
                    'mbox' => [
                        'id' => $id,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'DeleteMailboxResponse' => [
                    'mbox' => [
                        'mbxid' => $mbxid,
                        'id' => $id,
                        's' => $size,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, DeleteMailboxEnvelope::class, 'json'));
    }
}
