<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CompactIndexBody;
use Zimbra\Admin\Message\CompactIndexRequest;
use Zimbra\Admin\Message\CompactIndexResponse;
use Zimbra\Admin\Struct\MailboxByAccountIdSelector;
use Zimbra\Enum\CompactIndexAction;
use Zimbra\Enum\CompactIndexStatus;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CompactIndexBody.
 */
class CompactIndexBodyTest extends ZimbraStructTestCase
{
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
}
