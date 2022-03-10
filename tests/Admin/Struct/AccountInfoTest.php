<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\AccountInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AccountInfo.
 */
class AccountInfoTest extends ZimbraTestCase
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

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" id="$id" isExternal="true">
    <a n="$key">$value</a>
</result>
EOT;
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
