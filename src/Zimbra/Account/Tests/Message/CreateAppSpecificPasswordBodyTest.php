<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Message;

use Zimbra\Account\Message\CreateAppSpecificPasswordBody;
use Zimbra\Account\Message\CreateAppSpecificPasswordRequest;
use Zimbra\Account\Message\CreateAppSpecificPasswordResponse;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CreateAppSpecificPasswordBody.
 */
class CreateAppSpecificPasswordBodyTest extends ZimbraStructTestCase
{
    public function testCreateAppSpecificPasswordBody()
    {
        $appName = $this->faker->word;
        $password = $this->faker->word;
        $request = new CreateAppSpecificPasswordRequest($appName);
        $response = new CreateAppSpecificPasswordResponse($password);

        $body = new CreateAppSpecificPasswordBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CreateAppSpecificPasswordBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAccount">'
                . '<urn:CreateAppSpecificPasswordRequest appName="' . $appName . '" />'
                . '<urn:CreateAppSpecificPasswordResponse password="' . $password . '" />'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, CreateAppSpecificPasswordBody::class, 'xml'));

        $json = json_encode([
            'CreateAppSpecificPasswordRequest' => [
                'appName' => $appName,
                '_jsns' => 'urn:zimbraAccount',
            ],
            'CreateAppSpecificPasswordResponse' => [
                'password' => $password,
                '_jsns' => 'urn:zimbraAccount',
            ],
        ]);

        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, CreateAppSpecificPasswordBody::class, 'json'));
    }
}
