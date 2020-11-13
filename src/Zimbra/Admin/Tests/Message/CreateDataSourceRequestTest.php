<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CreateDataSourceRequest;
use Zimbra\Admin\Struct\{Attr, DataSourceSpecifier};
use Zimbra\Enum\DataSourceType;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CreateDataSourceRequest.
 */
class CreateDataSourceRequestTest extends ZimbraStructTestCase
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
}
