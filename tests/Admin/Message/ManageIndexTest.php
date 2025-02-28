<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\ManageIndexBody;
use Zimbra\Admin\Message\ManageIndexEnvelope;
use Zimbra\Admin\Message\ManageIndexRequest;
use Zimbra\Admin\Message\ManageIndexResponse;
use Zimbra\Admin\Struct\MailboxByAccountIdSelector;
use Zimbra\Common\Enum\ManageIndexAction;
use Zimbra\Common\Enum\ManageIndexStatus;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ManageIndex.
 */
class ManageIndexTest extends ZimbraTestCase
{
    public function testManageIndexEnvelope()
    {
        $id = $this->faker->uuid;

        $mbox = new MailboxByAccountIdSelector($id);
        $request = new ManageIndexRequest($mbox, ManageIndexAction::DISABLE);
        $this->assertEquals($mbox, $request->getMbox());
        $this->assertEquals(ManageIndexAction::DISABLE, $request->getAction());
        $request = new ManageIndexRequest(
            new MailboxByAccountIdSelector(''), ManageIndexAction::DISABLE
        );
        $request->setMbox($mbox)
            ->setAction(ManageIndexAction::ENABLE);
        $this->assertEquals($mbox, $request->getMbox());
        $this->assertEquals(ManageIndexAction::ENABLE, $request->getAction());

        $response = new ManageIndexResponse(ManageIndexStatus::RUNNING);
        $this->assertEquals(ManageIndexStatus::RUNNING, $response->getStatus());
        $response = new ManageIndexResponse(ManageIndexStatus::RUNNING);
        $response->setStatus(ManageIndexStatus::STARTED);
        $this->assertEquals(ManageIndexStatus::STARTED, $response->getStatus());

        $body = new ManageIndexBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new ManageIndexBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ManageIndexEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new ManageIndexEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ManageIndexRequest action="enableIndexing">
            <urn:mbox id="$id" />
        </urn:ManageIndexRequest>
        <urn:ManageIndexResponse status="started" />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ManageIndexEnvelope::class, 'xml'));
    }
}
