<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Response;

use Zimbra\Admin\Message\AddGalSyncDataSourceResponse;
use Zimbra\Admin\Struct\AccountInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AddGalSyncDataSourceResponse.
 */
class AddGalSyncDataSourceResponseTest extends ZimbraStructTestCase
{
    public function testAddGalSyncDataSourceResponse()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $attr = new Attr($key, $value);
        $account = new AccountInfo($name, $id, TRUE, [$attr]);
        $res = new AddGalSyncDataSourceResponse($account);

        $this->assertSame($account, $res->getAccount());

        $res = new AddGalSyncDataSourceResponse(
            new AccountInfo($name, $id, TRUE, [$attr])
        );
        $res->setAccount($account);
        $this->assertSame($account, $res->getAccount());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AddGalSyncDataSourceResponse>'
                . '<account name="' . $name . '" id="' . $id . '" isExternal="true">'
                    . '<a n="' . $key . '">' . $value . '</a>'
                . '</account>'
            . '</AddGalSyncDataSourceResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, AddGalSyncDataSourceResponse::class, 'xml'));

        $json = json_encode([
            'account' => [
                'name' => $name,
                'id' => $id,
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
                'isExternal' => TRUE,
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, AddGalSyncDataSourceResponse::class, 'json'));
    }
}
