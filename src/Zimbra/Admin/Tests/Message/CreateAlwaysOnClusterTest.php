<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CreateAlwaysOnClusterBody;
use Zimbra\Admin\Message\CreateAlwaysOnClusterEnvelope;
use Zimbra\Admin\Message\CreateAlwaysOnClusterRequest;
use Zimbra\Admin\Message\CreateAlwaysOnClusterResponse;
use Zimbra\Admin\Struct\AlwaysOnClusterInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CreateAlwaysOnCluster.
 */
class CreateAlwaysOnClusterTest extends ZimbraStructTestCase
{
    public function testCreateAlwaysOnClusterRequest()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;

        $attr = new Attr($key, $value);
        $req = new CreateAlwaysOnClusterRequest(
            $name, [$attr]
        );

        $this->assertSame($name, $req->getName());

        $req = new CreateAlwaysOnClusterRequest('');
        $req->setName($name)
            ->setAttrs([$attr]);
        $this->assertSame($name, $req->getName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateAlwaysOnClusterRequest name="' . $name . '">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</CreateAlwaysOnClusterRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, CreateAlwaysOnClusterRequest::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'a' => [
                [
                    'n' => $key,
                    '_content' => $value,
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, CreateAlwaysOnClusterRequest::class, 'json'));
    }

    public function testCreateAlwaysOnClusterResponse()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $attr = new Attr($key, $value);
        $cluster = new AlwaysOnClusterInfo($name, $id, [$attr]);

        $res = new CreateAlwaysOnClusterResponse($cluster);
        $this->assertEquals($cluster, $res->getAlwaysOnCluster());

        $res = new CreateAlwaysOnClusterResponse();
        $res->setAlwaysOnCluster($cluster);
        $this->assertEquals($cluster, $res->getAlwaysOnCluster());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateAlwaysOnClusterResponse>'
                . '<alwaysOnCluster name="' . $name . '" id="' . $id . '">'
                    . '<a n="' . $key . '">' . $value . '</a>'
                . '</alwaysOnCluster>'
            . '</CreateAlwaysOnClusterResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, CreateAlwaysOnClusterResponse::class, 'xml'));

        $json = json_encode([
            'alwaysOnCluster' => [
                'name' => $name,
                'id' => $id,
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, CreateAlwaysOnClusterResponse::class, 'json'));
    }

    public function testCreateAlwaysOnClusterBody()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->uuid;

        $attr = new Attr($key, $value);
        $cluster = new AlwaysOnClusterInfo($name, $id, [$attr]);

        $request = new CreateAlwaysOnClusterRequest(
            $name, [$attr]
        );
        $response = new CreateAlwaysOnClusterResponse($cluster);

        $body = new CreateAlwaysOnClusterBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CreateAlwaysOnClusterBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:CreateAlwaysOnClusterRequest name="' . $name . '">'
                    . '<a n="' . $key . '">' . $value . '</a>'
                . '</urn:CreateAlwaysOnClusterRequest>'
                . '<urn:CreateAlwaysOnClusterResponse>'
                    . '<alwaysOnCluster name="' . $name . '" id="' . $id . '">'
                        . '<a n="' . $key . '">' . $value . '</a>'
                    . '</alwaysOnCluster>'
                . '</urn:CreateAlwaysOnClusterResponse>'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, CreateAlwaysOnClusterBody::class, 'xml'));

        $json = json_encode([
            'CreateAlwaysOnClusterRequest' => [
                'name' => $name,
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
                '_jsns' => 'urn:zimbraAdmin',
            ],
            'CreateAlwaysOnClusterResponse' => [
                'alwaysOnCluster' => [
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
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, CreateAlwaysOnClusterBody::class, 'json'));
    }

    public function testCreateAlwaysOnClusterEnvelope()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->uuid;

        $attr = new Attr($key, $value);
        $cluster = new AlwaysOnClusterInfo($name, $id, [$attr]);

        $request = new CreateAlwaysOnClusterRequest(
            $name, [$attr]
        );
        $response = new CreateAlwaysOnClusterResponse($cluster);
        $body = new CreateAlwaysOnClusterBody($request, $response);

        $envelope = new CreateAlwaysOnClusterEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CreateAlwaysOnClusterEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:CreateAlwaysOnClusterRequest name="' . $name . '">'
                        . '<a n="' . $key . '">' . $value . '</a>'
                    . '</urn:CreateAlwaysOnClusterRequest>'
                    . '<urn:CreateAlwaysOnClusterResponse>'
                        . '<alwaysOnCluster name="' . $name . '" id="' . $id . '">'
                            . '<a n="' . $key . '">' . $value . '</a>'
                        . '</alwaysOnCluster>'
                    . '</urn:CreateAlwaysOnClusterResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CreateAlwaysOnClusterEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'CreateAlwaysOnClusterRequest' => [
                    'name' => $name,
                    'a' => [
                        [
                            'n' => $key,
                            '_content' => $value,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'CreateAlwaysOnClusterResponse' => [
                    'alwaysOnCluster' => [
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
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CreateAlwaysOnClusterEnvelope::class, 'json'));
    }
}
