<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\CheckPasswordStrengthBody;
use Zimbra\Admin\Message\CheckPasswordStrengthEnvelope;
use Zimbra\Admin\Message\CheckPasswordStrengthRequest;
use Zimbra\Admin\Message\CheckPasswordStrengthResponse;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for CheckPasswordStrength.
 */
class CheckPasswordStrengthTest extends ZimbraStructTestCase
{
    public function testCheckPasswordStrength()
    {
        $id = $this->faker->uuid;
        $password = $this->faker->word;
        $request = new CheckPasswordStrengthRequest($id, $password);
        $this->assertSame($id, $request->getId());
        $this->assertSame($password, $request->getPassword());

        $request = new CheckPasswordStrengthRequest('', '');
        $request->setId($id)
            ->setPassword($password);
        $this->assertSame($id, $request->getId());
        $this->assertSame($password, $request->getPassword());

        $response = new CheckPasswordStrengthResponse();

        $body = new CheckPasswordStrengthBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CheckPasswordStrengthBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CheckPasswordStrengthEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CheckPasswordStrengthEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CheckPasswordStrengthRequest id="$id" password="$password" />
        <urn:CheckPasswordStrengthResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CheckPasswordStrengthEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'CheckPasswordStrengthRequest' => [
                    'id' => $id,
                    'password' => $password,
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'CheckPasswordStrengthResponse' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CheckPasswordStrengthEnvelope::class, 'json'));
    }
}
