<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CheckPasswordStrengthBody;
use Zimbra\Admin\Message\CheckPasswordStrengthRequest;
use Zimbra\Admin\Message\CheckPasswordStrengthResponse;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckPasswordStrengthBody.
 */
class CheckPasswordStrengthBodyTest extends ZimbraStructTestCase
{
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
}
