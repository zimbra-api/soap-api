<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\AccountInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AccountInfo.
 */
class AccountInfoTest extends ZimbraStructTestCase
{
    public function testAccountInfo()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $attr = new Attr($key, $value);
        $account = new AccountInfo($name, $id, FALSE, [$attr]);
        $this->assertFalse($account->getIsExternal());

        $account->setIsExternal(TRUE);
        $this->assertTrue($account->getIsExternal());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<account name="' . $name . '" id="' . $id . '" isExternal="true">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</account>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($account, 'xml'));
        $this->assertEquals($account, $this->serializer->deserialize($xml, AccountInfo::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'id' => $id,
            'isExternal' => TRUE,
            'a' => [
                [
                    'n' => $key,
                    '_content' => $value,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($account, 'json'));
        $this->assertEquals($account, $this->serializer->deserialize($json, AccountInfo::class, 'json'));
    }
}
