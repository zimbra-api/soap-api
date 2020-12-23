<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\SetPasswordBody;
use Zimbra\Admin\Message\SetPasswordEnvelope;
use Zimbra\Admin\Message\SetPasswordRequest;
use Zimbra\Admin\Message\SetPasswordResponse;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for SetPassword.
 */
class SetPasswordTest extends ZimbraStructTestCase
{
    public function testSetPassword()
    {
        $id = $this->faker->uuid;
        $newPassword = $this->faker->word;
        $message = $this->faker->word;

        $request = new SetPasswordRequest(
            $id, $newPassword
        );
        $this->assertSame($id, $request->getId());
        $this->assertSame($newPassword, $request->getNewPassword());
        $request = new SetPasswordRequest('', '');
        $request->setId($id)
            ->setNewPassword($newPassword);
        $this->assertSame($id, $request->getId());
        $this->assertSame($newPassword, $request->getNewPassword());

        $response = new SetPasswordResponse($message);
        $this->assertEquals($message, $response->getMessage());
        $response = new SetPasswordResponse();
        $response->setMessage($message);
        $this->assertEquals($message, $response->getMessage());

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
        <urn:SetPasswordRequest id="$id" newPassword="$newPassword" />
        <urn:SetPasswordResponse>
            <message>$message</message>
        </urn:SetPasswordResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, SetPasswordEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'SetPasswordRequest' => [
                    'id' => $id,
                    'newPassword' => $newPassword,
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'SetPasswordResponse' => [
                    'message' => [
                        '_content' => $message,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, SetPasswordEnvelope::class, 'json'));
    }
}
