<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Account\Struct\AccountZimletInclude;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AccountZimletInclude.
 */
class AccountZimletIncludeTest extends ZimbraTestCase
{
    public function testAccountZimletInclude()
    {
        $value = $this->faker->word;
        $include = new AccountZimletInclude($value);
        $this->assertSame($value, $include->getValue());

        $include = new AccountZimletInclude('');
        $include->setValue($value);
        $this->assertSame($value, $include->getValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<result>$value</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($include, 'xml'));
        $this->assertEquals($include, $this->serializer->deserialize($xml, AccountZimletInclude::class, 'xml'));

        $json = json_encode([
            '_content' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($include, 'json'));
        $this->assertEquals($include, $this->serializer->deserialize($json, AccountZimletInclude::class, 'json'));
    }
}
