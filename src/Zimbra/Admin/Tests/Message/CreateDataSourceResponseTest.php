<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CreateDataSourceResponse;
use Zimbra\Admin\Struct\{Attr, DataSourceInfo};
use Zimbra\Enum\DataSourceType;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CreateDataSourceResponse.
 */
class CreateDataSourceResponseTest extends ZimbraStructTestCase
{
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
}
