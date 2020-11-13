<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Message;

use Zimbra\Account\Message\CreateAppSpecificPasswordEnvelope;
use Zimbra\Account\Message\CreateAppSpecificPasswordBody;
use Zimbra\Account\Message\CreateAppSpecificPasswordRequest;
use Zimbra\Account\Message\CreateAppSpecificPasswordResponse;
use Zimbra\Struct\Tests\ZimbraStructTestCase;
/**
 * Testcase class for CreateAppSpecificPasswordEnvelope.
 */
class CreateAppSpecificPasswordEnvelopeTest extends ZimbraStructTestCase
{
    public function testCreateAppSpecificPasswordEnvelope()
    {
        $appName = $this->faker->word;
        $password = $this->faker->word;
        $request = new CreateAppSpecificPasswordRequest($appName);
        $response = new CreateAppSpecificPasswordResponse($password);

        $body = new CreateAppSpecificPasswordBody($request, $response);

        $envelope = new CreateAppSpecificPasswordEnvelope(NULL, $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CreateAppSpecificPasswordEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">'
                . '<soap:Body>'
                    . '<urn:CreateAppSpecificPasswordRequest appName="' . $appName . '" />'
                    . '<urn:CreateAppSpecificPasswordResponse password="' . $password . '" />'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CreateAppSpecificPasswordEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'CreateAppSpecificPasswordRequest' => [
                    'appName' => $appName,
                    '_jsns' => 'urn:zimbraAccount',
                ],
                'CreateAppSpecificPasswordResponse' => [
                    'password' => $password,
                    '_jsns' => 'urn:zimbraAccount',
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CreateAppSpecificPasswordEnvelope::class, 'json'));
    }
}
