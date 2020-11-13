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
 * Testcase class for CreateDataSourceEnvelope.
 */
class CreateDataSourceEnvelopeTest extends ZimbraStructTestCase
{
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
