<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\CreateDataSourceBody;
use Zimbra\Admin\Message\CreateDataSourceEnvelope;
use Zimbra\Admin\Message\CreateDataSourceRequest;
use Zimbra\Admin\Message\CreateDataSourceResponse;
use Zimbra\Admin\Struct\{Attr, DataSourceSpecifier, DataSourceInfo};
use Zimbra\Enum\DataSourceType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CreateDataSource.
 */
class CreateDataSourceTest extends ZimbraTestCase
{
    public function testCreateDataSource()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $attr = new Attr($key, $value);
        $ds = new DataSourceSpecifier(DataSourceType::IMAP(), $name, [$attr]);
        $request = new CreateDataSourceRequest($id, $ds);
        $this->assertSame($id, $request->getId());
        $this->assertSame($ds, $request->getDataSource());

        $request = new CreateDataSourceRequest('', new DataSourceSpecifier(DataSourceType::IMAP(), ''));
        $request->setId($id)
            ->setDataSource($ds);
        $this->assertSame($id, $request->getId());
        $this->assertSame($ds, $request->getDataSource());

        $dsInfo = new DataSourceInfo($name, $id, DataSourceType::IMAP(), [$attr]);
        $response = new CreateDataSourceResponse($dsInfo);
        $this->assertSame($dsInfo, $response->getDataSource());

        $response = new CreateDataSourceResponse(new DataSourceInfo('', '', DataSourceType::POP3()));
        $response->setDataSource($dsInfo);
        $this->assertSame($dsInfo, $response->getDataSource());

        $body = new CreateDataSourceBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new CreateDataSourceBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CreateDataSourceEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CreateDataSourceEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CreateDataSourceRequest id="$id">
            <dataSource type="imap" name="$name">
                <a n="$key">$value</a>
            </dataSource>
        </urn:CreateDataSourceRequest>
        <urn:CreateDataSourceResponse>
            <dataSource name="$name" id="$id" type="imap">
                <a n="$key">$value</a>
            </dataSource>
        </urn:CreateDataSourceResponse>
    </soap:Body>
</soap:Envelope>
EOT;
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
                        'type' => 'imap',
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
                        'type' => 'imap',
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CreateDataSourceEnvelope::class, 'json'));
    }
}
