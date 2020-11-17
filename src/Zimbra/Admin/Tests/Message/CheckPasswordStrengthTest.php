<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CheckPasswordStrengthBody;
use Zimbra\Admin\Message\CheckPasswordStrengthEnvelope;
use Zimbra\Admin\Message\CheckPasswordStrengthRequest;
use Zimbra\Admin\Message\CheckPasswordStrengthResponse;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckPasswordStrength.
 */
class CheckPasswordStrengthTest extends ZimbraStructTestCase
{
    public function testCheckPasswordStrengthRequest()
    {
        $id = $this->faker->uuid;
        $password = $this->faker->word;

        $req = new CheckPasswordStrengthRequest($id, $password);
        $this->assertSame($id, $req->getId());
        $this->assertSame($password, $req->getPassword());

        $req = new CheckPasswordStrengthRequest('', '');
        $req->setId($id)
            ->setPassword($password);
        $this->assertSame($id, $req->getId());
        $this->assertSame($password, $req->getPassword());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckPasswordStrengthRequest id="' . $id . '" password="' . $password . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, CheckPasswordStrengthRequest::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'password' => $password,
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, CheckPasswordStrengthRequest::class, 'json'));
    }

    public function testCheckPasswordStrengthResponse()
    {
        $res = new CheckPasswordStrengthResponse();

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckPasswordStrengthResponse />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, CheckPasswordStrengthResponse::class, 'xml'));

        $json = '{}';
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, CheckPasswordStrengthResponse::class, 'json'));
    }

    public function testCheckPasswordStrengthBody()
    {
        $id = $this->faker->uuid;
        $password = $this->faker->word;
        $request = new CheckPasswordStrengthRequest($id, $password);
        $response = new CheckPasswordStrengthResponse();

        $body = new CheckPasswordStrengthBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CheckPasswordStrengthBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:CheckPasswordStrengthRequest id="' . $id . '" password="' . $password . '" />'
                . '<urn:CheckPasswordStrengthResponse />'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, CheckPasswordStrengthBody::class, 'xml'));

        $json = json_encode([
            'CheckPasswordStrengthRequest' => [
                'id' => $id,
                'password' => $password,
                '_jsns' => 'urn:zimbraAdmin',
            ],
            'CheckPasswordStrengthResponse' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, CheckPasswordStrengthBody::class, 'json'));
    }

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
