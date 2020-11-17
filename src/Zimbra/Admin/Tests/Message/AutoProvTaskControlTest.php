<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Response;

use Zimbra\Admin\Message\{AutoProvTaskControlBody, AutoProvTaskControlEnvelope, AutoProvTaskControlRequest, AutoProvTaskControlResponse};
use Zimbra\Admin\Struct\{AccountInfo, Attr, DomainSelector, PrincipalSelector};
use Zimbra\Enum\{AutoProvTaskAction, AutoProvTaskStatus};
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AutoProvTaskControl.
 */
class AutoProvTaskControlTest extends ZimbraStructTestCase
{
    public function testAutoProvTaskControlRequest()
    {
        $req = new AutoProvTaskControlRequest(
            AutoProvTaskAction::START()
        );
        $this->assertEquals(AutoProvTaskAction::START(), $req->getAction());
        $req->setAction(AutoProvTaskAction::STOP());
        $this->assertEquals(AutoProvTaskAction::STOP(), $req->getAction());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AutoProvTaskControlRequest action="' . AutoProvTaskAction::STOP() . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, AutoProvTaskControlRequest::class, 'xml'));

        $json = json_encode([
            'action' => (string) AutoProvTaskAction::STOP(),
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, AutoProvTaskControlRequest::class, 'json'));
    }

    public function testAutoProvTaskControlResponse()
    {
        $res = new AutoProvTaskControlResponse(
            AutoProvTaskStatus::STARTED()
        );
        $this->assertEquals(AutoProvTaskStatus::STARTED(), $res->getStatus());
        $res->setStatus(AutoProvTaskStatus::RUNNING());
        $this->assertEquals(AutoProvTaskStatus::RUNNING(), $res->getStatus());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AutoProvTaskControlResponse status="' . AutoProvTaskStatus::RUNNING() . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, AutoProvTaskControlResponse::class, 'xml'));

        $json = json_encode([
            'status' => (string) AutoProvTaskStatus::RUNNING(),
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, AutoProvTaskControlResponse::class, 'json'));
    }

    public function testAutoProvTaskControlBody()
    {
        $request = new AutoProvTaskControlRequest(
            AutoProvTaskAction::START()
        );
        $response = new AutoProvTaskControlResponse(
            AutoProvTaskStatus::STARTED()
        );

        $body = new AutoProvTaskControlBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new AutoProvTaskControlBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:AutoProvTaskControlRequest action="' . AutoProvTaskAction::START() . '" />'
                . '<urn:AutoProvTaskControlResponse status="' . AutoProvTaskStatus::STARTED() . '" />'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, AutoProvTaskControlBody::class, 'xml'));

        $json = json_encode([
            'AutoProvTaskControlRequest' => [
                'action' => (string) AutoProvTaskAction::START(),
                '_jsns' => 'urn:zimbraAdmin',
            ],
            'AutoProvTaskControlResponse' => [
                'status' => (string) AutoProvTaskStatus::STARTED(),
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, AutoProvTaskControlBody::class, 'json'));
    }

    public function testAutoProvTaskControlEnvelope()
    {
        $request = new AutoProvTaskControlRequest(
            AutoProvTaskAction::START()
        );
        $response = new AutoProvTaskControlResponse(
            AutoProvTaskStatus::STARTED()
        );
        $body = new AutoProvTaskControlBody($request, $response);

        $envelope = new AutoProvTaskControlEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new AutoProvTaskControlEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:AutoProvTaskControlRequest action="' . AutoProvTaskAction::START() . '" />'
                    . '<urn:AutoProvTaskControlResponse status="' . AutoProvTaskStatus::STARTED() . '" />'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, AutoProvTaskControlEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'AutoProvTaskControlRequest' => [
                    'action' => (string) AutoProvTaskAction::START(),
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'AutoProvTaskControlResponse' => [
                    'status' => (string) AutoProvTaskStatus::STARTED(),
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, AutoProvTaskControlEnvelope::class, 'json'));
    }
}
