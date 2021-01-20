<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Message;

use Zimbra\Account\Message\{ResetPasswordEnvelope, ResetPasswordBody, ResetPasswordRequest, ResetPasswordResponse};
use Zimbra\Struct\Tests\ZimbraStructTestCase;
/**
 * Testcase class for ResetPassword.
 */
class ResetPasswordTest extends ZimbraStructTestCase
{
    public function testResetPassword()
    {
        $password = $this->faker->sha256;

        $request = new ResetPasswordRequest($password);
        $this->assertSame($password, $request->getPassword());
        $request = new ResetPasswordRequest('');
        $request->setPassword($password);
        $this->assertSame($password, $request->getPassword());

        $response = new ResetPasswordResponse();

        $body = new ResetPasswordBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ResetPasswordBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ResetPasswordEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new ResetPasswordEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:ResetPasswordRequest>
            <password>$password</password>
        </urn:ResetPasswordRequest>
        <urn:ResetPasswordResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ResetPasswordEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'ResetPasswordRequest' => [
                    'password' => [
                        '_content' => $password,
                    ],
                    '_jsns' => 'urn:zimbraAccount',
                ],
                'ResetPasswordResponse' => [
                    '_jsns' => 'urn:zimbraAccount',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, ResetPasswordEnvelope::class, 'json'));
    }
}
