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
    public function testCompactIndexRequest()
    {
        $id = $this->faker->uuid;
        $mbox = new MailboxByAccountIdSelector($id);

        $req = new CompactIndexRequest($mbox, CompactIndexAction::STATUS());
        $this->assertEquals($mbox, $req->getMbox());
        $this->assertEquals(CompactIndexAction::STATUS(), $req->getAction());

        $req = new CompactIndexRequest(new MailboxByAccountIdSelector(''));
        $req->setMbox($mbox)
            ->setAction(CompactIndexAction::START());
        $this->assertEquals($mbox, $req->getMbox());
        $this->assertEquals(CompactIndexAction::START(), $req->getAction());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CompactIndexRequest action="' . CompactIndexAction::START() . '">'
                . '<mbox id="' . $id . '" />'
            . '</CompactIndexRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, CompactIndexRequest::class, 'xml'));

        $json = json_encode([
            'mbox' => [
                'id' => $id,
            ],
            'action' => (string) CompactIndexAction::START(),
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, CompactIndexRequest::class, 'json'));
    }

    public function testCompactIndexResponse()
    {
        $res = new CompactIndexResponse(CompactIndexStatus::STARTED());
        $this->assertEquals(CompactIndexStatus::STARTED(), $res->getStatus());

        $res = new CompactIndexResponse(CompactIndexStatus::STARTED());
        $res->setStatus(CompactIndexStatus::RUNNING());
        $this->assertEquals(CompactIndexStatus::RUNNING(), $res->getStatus());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CompactIndexResponse status="' . CompactIndexStatus::RUNNING() . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, CompactIndexResponse::class, 'xml'));

        $json = json_encode([
            'status' => (string) CompactIndexStatus::RUNNING(),
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, CompactIndexResponse::class, 'json'));
    }

    public function testCompactIndexBody()
    {
        $id = $this->faker->uuid;
        $mbox = new MailboxByAccountIdSelector($id);
        $request = new CompactIndexRequest($mbox, CompactIndexAction::START());
        $response = new CompactIndexResponse(CompactIndexStatus::RUNNING());

        $body = new CompactIndexBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CompactIndexBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:CompactIndexRequest action="' . CompactIndexAction::START() . '">'
                    . '<mbox id="' . $id . '" />'
                . '</urn:CompactIndexRequest>'
                . '<urn:CompactIndexResponse status="' . CompactIndexStatus::RUNNING() . '" />'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, CompactIndexBody::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, CompactIndexBody::class, 'json'));
    }

    public function testCompactIndexEnvelope()
    {
        $id = $this->faker->uuid;
        $mbox = new MailboxByAccountIdSelector($id);
        $request = new CompactIndexRequest($mbox, CompactIndexAction::START());
        $response = new CompactIndexResponse(CompactIndexStatus::RUNNING());
        $body = new CompactIndexBody($request, $response);

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
