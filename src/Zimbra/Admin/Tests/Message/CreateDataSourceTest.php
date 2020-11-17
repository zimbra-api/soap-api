<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CreateDataSourceBody;
use Zimbra\Admin\Message\CreateDataSourceEnvelope;
use Zimbra\Admin\Message\CreateDataSourceRequest;
use Zimbra\Admin\Message\CreateDataSourceResponse;
use Zimbra\Admin\Struct\{Attr, DataSourceSpecifier, DataSourceInfo};
use Zimbra\Enum\DataSourceType;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CreateDataSource.
 */
class CreateDataSourceTest extends ZimbraStructTestCase
{
    public function testCreateDataSourceRequest()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $attr = new Attr($key, $value);
        $ds = new DataSourceSpecifier(DataSourceType::IMAP(), $name, [$attr]);

        $req = new CreateDataSourceRequest($id, $ds);
        $this->assertSame($id, $req->getId());
        $this->assertSame($ds, $req->getDataSource());

        $req = new CreateDataSourceRequest('', new DataSourceSpecifier(DataSourceType::IMAP(), ''));
        $req->setId($id)
            ->setDataSource($ds);
        $this->assertSame($id, $req->getId());
        $this->assertSame($ds, $req->getDataSource());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateDataSourceRequest id="' . $id . '">'
                . '<dataSource type="' . DataSourceType::IMAP() . '" name="' . $name . '">'
                    . '<a n="' . $key . '">' . $value . '</a>'
                . '</dataSource>'
            . '</CreateDataSourceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, CreateDataSourceRequest::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'dataSource' => [
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
                'type' => (string) DataSourceType::IMAP(),
                'name' => $name,
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, CreateDataSourceRequest::class, 'json'));
    }

    public function testCreateDataSourceResponse()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $attr = new Attr($key, $value);
        $ds = new DataSourceInfo($name, $id, DataSourceType::IMAP(), [$attr]);

        $res = new CreateDataSourceResponse($ds);
        $this->assertSame($ds, $res->getDataSource());

        $res = new CreateDataSourceResponse(new DataSourceInfo('', '', DataSourceType::POP3()));
        $res->setDataSource($ds);
        $this->assertSame($ds, $res->getDataSource());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateDataSourceResponse>'
                . '<dataSource name="' . $name . '" id="' . $id . '" type="' . DataSourceType::IMAP() . '">'
                    . '<a n="' . $key . '">' . $value . '</a>'
                . '</dataSource>'
            . '</CreateDataSourceResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, CreateDataSourceResponse::class, 'xml'));

        $json = json_encode([
            'dataSource' => [
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
                'name' => $name,
                'id' => $id,
                'type' => (string) DataSourceType::IMAP(),
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, CreateDataSourceResponse::class, 'json'));
    }

    public function testCreateDataSourceBody()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $attr = new Attr($key, $value);
        $request = new CreateDataSourceRequest($id, new DataSourceSpecifier(DataSourceType::IMAP(), $name, [$attr]));
        $response = new CreateDataSourceResponse(new DataSourceInfo($name, $id, DataSourceType::IMAP(), [$attr]));

        $body = new CreateDataSourceBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CreateDataSourceBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:CreateDataSourceRequest id="' . $id . '">'
                    . '<dataSource type="' . DataSourceType::IMAP() . '" name="' . $name . '">'
                        . '<a n="' . $key . '">' . $value . '</a>'
                    . '</dataSource>'
                . '</urn:CreateDataSourceRequest>'
                . '<urn:CreateDataSourceResponse>'
                    . '<dataSource name="' . $name . '" id="' . $id . '" type="' . DataSourceType::IMAP() . '">'
                        . '<a n="' . $key . '">' . $value . '</a>'
                    . '</dataSource>'
                . '</urn:CreateDataSourceResponse>'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, CreateDataSourceBody::class, 'xml'));

        $json = json_encode([
            'CreateDataSourceRequest' => [
                'id' => $id,
                'dataSource' => [
                    'a' => [
                        [
                            'n' => $key,
                            '_content' => $value,
                        ],
                    ],
                    'type' => (string) DataSourceType::IMAP(),
                    'name' => $name,
                ],
                '_jsns' => 'urn:zimbraAdmin',
            ],
            'CreateDataSourceResponse' => [
                'dataSource' => [
                    'a' => [
                        [
                            'n' => $key,
                            '_content' => $value,
                        ],
                    ],
                    'name' => $name,
                    'id' => $id,
                    'type' => (string) DataSourceType::IMAP(),
                ],
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, CreateDataSourceBody::class, 'json'));
    }

    public function testCreateDataSourceEnvelope()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $attr = new Attr($key, $value);
        $request = new CreateDataSourceRequest($id, new DataSourceSpecifier(DataSourceType::IMAP(), $name, [$attr]));
        $response = new CreateDataSourceResponse(new DataSourceInfo($name, $id, DataSourceType::IMAP(), [$attr]));
        $body = new CreateDataSourceBody($request, $response);

        $envelope = new CreateDataSourceEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CreateDataSourceEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:CreateDataSourceRequest id="' . $id . '">'
                        . '<dataSource type="' . DataSourceType::IMAP() . '" name="' . $name . '">'
                            . '<a n="' . $key . '">' . $value . '</a>'
                        . '</dataSource>'
                    . '</urn:CreateDataSourceRequest>'
                    . '<urn:CreateDataSourceResponse>'
                        . '<dataSource name="' . $name . '" id="' . $id . '" type="' . DataSourceType::IMAP() . '">'
                            . '<a n="' . $key . '">' . $value . '</a>'
                        . '</dataSource>'
                    . '</urn:CreateDataSourceResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CreateDataSourceEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'CreateDataSourceRequest' => [
                    'id' => $id,
                    'dataSource' => [
                        'a' => [
                            [
                                'n' => $key,
                                '_content' => $value,
                            ],
                        ],
                        'type' => (string) DataSourceType::IMAP(),
                        'name' => $name,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'CreateDataSourceResponse' => [
                    'dataSource' => [
                        'a' => [
                            [
                                'n' => $key,
                                '_content' => $value,
                            ],
                        ],
                        'name' => $name,
                        'id' => $id,
                        'type' => (string) DataSourceType::IMAP(),
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CreateDataSourceEnvelope::class, 'json'));
    }
}
