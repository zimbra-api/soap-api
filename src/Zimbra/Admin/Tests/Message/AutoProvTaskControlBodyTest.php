<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\{AutoProvTaskControlBody, AutoProvTaskControlRequest, AutoProvTaskControlResponse};
use Zimbra\Admin\Struct\{AccountInfo, Attr, DomainSelector, PrincipalSelector};
use Zimbra\Enum\{AutoProvTaskAction, AutoProvTaskStatus};
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AutoProvTaskControlBody.
 */
class AutoProvTaskControlBodyTest extends ZimbraStructTestCase
{
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
}
