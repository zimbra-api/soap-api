<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Response;

use Zimbra\Admin\Message\{AutoProvTaskControlBody, AutoProvTaskControlEnvelope, AutoProvTaskControlRequest, AutoProvTaskControlResponse};
use Zimbra\Admin\Struct\{AccountInfo, Attr, DomainSelector, PrincipalSelector};
use Zimbra\Common\Enum\{AutoProvTaskAction, AutoProvTaskStatus};
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AutoProvTaskControl.
 */
class AutoProvTaskControlTest extends ZimbraTestCase
{
    public function testAutoProvTaskControl()
    {
        $request = new AutoProvTaskControlRequest(
            AutoProvTaskAction::STOP()
        );
        $this->assertEquals(AutoProvTaskAction::STOP(), $request->getAction());
        $request->setAction(AutoProvTaskAction::START());
        $this->assertEquals(AutoProvTaskAction::START(), $request->getAction());

        $response = new AutoProvTaskControlResponse(
            AutoProvTaskStatus::RUNNING()
        );
        $this->assertEquals(AutoProvTaskStatus::RUNNING(), $response->getStatus());
        $response->setStatus(AutoProvTaskStatus::STARTED());
        $this->assertEquals(AutoProvTaskStatus::STARTED(), $response->getStatus());

        $body = new AutoProvTaskControlBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new AutoProvTaskControlBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new AutoProvTaskControlEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new AutoProvTaskControlEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $action = AutoProvTaskAction::START()->getValue();
        $status = AutoProvTaskStatus::STARTED()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:AutoProvTaskControlRequest action="$action" />
        <urn:AutoProvTaskControlResponse status="$status" />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, AutoProvTaskControlEnvelope::class, 'xml'));
    }
}
