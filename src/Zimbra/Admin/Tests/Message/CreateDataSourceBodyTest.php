<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CreateDataSourceBody;
use Zimbra\Admin\Message\CreateDataSourceRequest;
use Zimbra\Admin\Message\CreateDataSourceResponse;
use Zimbra\Admin\Struct\{Attr, DataSourceSpecifier, DataSourceInfo};
use Zimbra\Enum\DataSourceType;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CreateDataSourceBody.
 */
class CreateDataSourceBodyTest extends ZimbraStructTestCase
{
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
}
