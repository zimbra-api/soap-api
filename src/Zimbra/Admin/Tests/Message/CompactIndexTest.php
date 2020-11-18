<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CompactIndexBody;
use Zimbra\Admin\Message\CompactIndexEnvelope;
use Zimbra\Admin\Message\CompactIndexRequest;
use Zimbra\Admin\Message\CompactIndexResponse;
use Zimbra\Admin\Struct\MailboxByAccountIdSelector;
use Zimbra\Enum\CompactIndexAction;
use Zimbra\Enum\CompactIndexStatus;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CompactIndex.
 */
class CompactIndexTest extends ZimbraStructTestCase
{
    public function testCompactIndexEnvelope()
    {
        $id = $this->faker->uuid;

        $mbox = new MailboxByAccountIdSelector($id);
        $request = new CompactIndexRequest($mbox, CompactIndexAction::STATUS());
        $this->assertEquals($mbox, $request->getMbox());
        $this->assertEquals(CompactIndexAction::STATUS(), $request->getAction());
        $request = new CompactIndexRequest(new MailboxByAccountIdSelector(''));
        $request->setMbox($mbox)
            ->setAction(CompactIndexAction::START());
        $this->assertEquals($mbox, $request->getMbox());
        $this->assertEquals(CompactIndexAction::START(), $request->getAction());

        $response = new CompactIndexResponse(CompactIndexStatus::STARTED());
        $this->assertEquals(CompactIndexStatus::STARTED(), $response->getStatus());
        $response = new CompactIndexResponse(CompactIndexStatus::STARTED());
        $response->setStatus(CompactIndexStatus::RUNNING());
        $this->assertEquals(CompactIndexStatus::RUNNING(), $response->getStatus());

        $body = new CompactIndexBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CompactIndexBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CompactIndexEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CompactIndexEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:CompactIndexRequest action="' . CompactIndexAction::START() . '">'
                        . '<mbox id="' . $id . '" />'
                    . '</urn:CompactIndexRequest>'
                    . '<urn:CompactIndexResponse status="' . CompactIndexStatus::RUNNING() . '" />'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CompactIndexEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'CompactIndexRequest' => [
                    'mbox' => [
                        'id' => $id,
                    ],
                    'action' => (string) CompactIndexAction::START(),
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'CompactIndexResponse' => [
                    'status' => (string) CompactIndexStatus::RUNNING(),
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CompactIndexEnvelope::class, 'json'));
    }
}
