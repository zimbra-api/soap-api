<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\DeleteAccountBody;
use Zimbra\Admin\Message\DeleteAccountEnvelope;
use Zimbra\Admin\Message\DeleteAccountRequest;
use Zimbra\Admin\Message\DeleteAccountResponse;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DeleteAccount.
 */
class DeleteAccountTest extends ZimbraTestCase
{
    public function testDeleteAccount()
    {
        $id = $this->faker->uuid;
        $request = new DeleteAccountRequest($id);
        $this->assertSame($id, $request->getId());
        $request = new DeleteAccountRequest('');
        $request->setId($id);
        $this->assertSame($id, $request->getId());

        $response = new DeleteAccountResponse();

        $body = new DeleteAccountBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new DeleteAccountBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new DeleteAccountEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new DeleteAccountEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:DeleteAccountRequest id="$id" />
        <urn:DeleteAccountResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, DeleteAccountEnvelope::class, 'xml'));
    }
}
