<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\AutoProvAccountResponse;
use Zimbra\Admin\Struct\AccountInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AutoProvAccountResponse.
 */
class AutoProvAccountResponseTest extends ZimbraStructTestCase
{
    public function testAutoProvAccountResponse()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $attr = new Attr($key, $value);
        $account = new AccountInfo($name, $id, TRUE, [$attr]);

        $res = new AutoProvAccountResponse(
            $account
        );
        $this->assertSame($account, $res->getAccount());

        $res = new AutoProvAccountResponse(new AccountInfo('', ''));
        $res->setAccount($account);
        $this->assertSame($account, $res->getAccount());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AutoProvAccountResponse>'
                . '<account name="' . $name . '" id="' . $id . '" isExternal="true">'
                    . '<a n="' . $key . '">' . $value . '</a>'
                . '</account>'
            . '</AutoProvAccountResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, AutoProvAccountResponse::class, 'xml'));

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
        $this->assertEquals($res, $this->serializer->deserialize($json, AutoProvAccountResponse::class, 'json'));
    }
}
