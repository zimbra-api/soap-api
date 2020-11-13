<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\{AutoProvTaskControlBody, AutoProvTaskControlEnvelope, AutoProvTaskControlRequest, AutoProvTaskControlResponse};
use Zimbra\Admin\Struct\{AccountInfo, Attr, DomainSelector, PrincipalSelector};
use Zimbra\Enum\{AutoProvTaskAction, AutoProvTaskStatus};
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AutoProvTaskControlEnvelope.
 */
class AutoProvTaskControlEnvelopeTest extends ZimbraStructTestCase
{
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
