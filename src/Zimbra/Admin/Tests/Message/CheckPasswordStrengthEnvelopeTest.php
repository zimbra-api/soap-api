<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CheckPasswordStrengthBody;
use Zimbra\Admin\Message\CheckPasswordStrengthEnvelope;
use Zimbra\Admin\Message\CheckPasswordStrengthRequest;
use Zimbra\Admin\Message\CheckPasswordStrengthResponse;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckPasswordStrengthEnvelope.
 */
class CheckPasswordStrengthEnvelopeTest extends ZimbraStructTestCase
{
    public function testCheckPasswordStrengthEnvelope()
    {
        $id = $this->faker->uuid;
        $password = $this->faker->word;
        $request = new CheckPasswordStrengthRequest($id, $password);
        $response = new CheckPasswordStrengthResponse();
        $body = new CheckPasswordStrengthBody($request, $response);

        $envelope = new CheckPasswordStrengthEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CheckPasswordStrengthEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:CheckPasswordStrengthRequest id="' . $id . '" password="' . $password . '" />'
                    . '<urn:CheckPasswordStrengthResponse />'
                . '</soap:Body>'
            . '</soap:Envelope>';
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
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CheckPasswordStrengthEnvelope::class, 'json'));
    }
}
