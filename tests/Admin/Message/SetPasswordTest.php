<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\SetPasswordBody;
use Zimbra\Admin\Message\SetPasswordEnvelope;
use Zimbra\Admin\Message\SetPasswordRequest;
use Zimbra\Admin\Message\SetPasswordResponse;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SetPassword.
 */
class SetPasswordTest extends ZimbraTestCase
{
    public function testSetPassword()
    {
        $id = $this->faker->uuid;
        $newPassword = $this->faker->word;
        $message = $this->faker->word;

        $request = new SetPasswordRequest(
            $id, $newPassword, FALSE
        );
        $this->assertSame($id, $request->getId());
        $this->assertSame($newPassword, $request->getNewPassword());
        $this->assertFalse($request->isDryRun());
        $request = new SetPasswordRequest();
        $request->setId($id)
            ->setNewPassword($newPassword)
            ->setDryRun(TRUE);
        $this->assertSame($id, $request->getId());
        $this->assertSame($newPassword, $request->getNewPassword());
        $this->assertTrue($request->isDryRun());

        $response = new SetPasswordResponse($message);
        $this->assertSame($message, $response->getMessage());
        $response = new SetPasswordResponse();
        $response->setMessage($message);
        $this->assertSame($message, $response->getMessage());

        $body = new SetPasswordBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new SetPasswordBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new SetPasswordEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new SetPasswordEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:SetPasswordRequest id="$id" newPassword="$newPassword" dryRun="true" />
        <urn:SetPasswordResponse>
            <urn:message>$message</urn:message>
        </urn:SetPasswordResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, SetPasswordEnvelope::class, 'xml'));
    }
}
