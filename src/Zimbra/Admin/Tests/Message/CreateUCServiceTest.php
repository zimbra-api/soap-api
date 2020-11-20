<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CreateUCServiceBody;
use Zimbra\Admin\Message\CreateUCServiceEnvelope;
use Zimbra\Admin\Message\CreateUCServiceRequest;
use Zimbra\Admin\Message\CreateUCServiceResponse;
use Zimbra\Admin\Struct\UCServiceInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CreateUCService.
 */
class CreateUCServiceTest extends ZimbraStructTestCase
{
    public function testCreateUCService()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;

        $request = new CreateUCServiceRequest($name);
        $this->assertSame($name, $request->getName());

        $request = new CreateUCServiceRequest('');
        $request->setName($name)
            ->setAttrs([new Attr($key, $value)]);
        $this->assertSame($name, $request->getName());

        $ucservice = new UCServiceInfo($name, $id, [new Attr($key, $value)]);
        $response = new CreateUCServiceResponse($ucservice);
        $this->assertSame($ucservice, $response->getUCService());
        $response = new CreateUCServiceResponse();
        $response->setUCService($ucservice);
        $this->assertSame($ucservice, $response->getUCService());

        $body = new CreateUCServiceBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CreateUCServiceBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CreateUCServiceEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CreateUCServiceEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:CreateUCServiceRequest>'
                        . '<name>' . $name . '</name>'
                        . '<a n="' . $key . '">' . $value . '</a>'
                    . '</urn:CreateUCServiceRequest>'
                    . '<urn:CreateUCServiceResponse>'
                        . '<ucservice name="' . $name . '" id="' . $id . '">'
                            . '<a n="' . $key . '">' . $value . '</a>'
                        . '</ucservice>'
                    . '</urn:CreateUCServiceResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CreateUCServiceEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'CreateUCServiceRequest' => [
                    'name' => [
                        '_content' => $name,
                    ],
                    'a' => [
                        [
                            'n' => $key,
                            '_content' => $value,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'CreateUCServiceResponse' => [
                    'ucservice' => [
                        'name' => $name,
                        'id' => $id,
                        'a' => [
                            [
                                'n' => $key,
                                '_content' => $value,
                            ],
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CreateUCServiceEnvelope::class, 'json'));
    }
}
