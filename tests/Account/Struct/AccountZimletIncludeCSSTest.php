<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Account\Struct\AccountZimletIncludeCSS;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AccountZimletIncludeCSS.
 */
class AccountZimletIncludeCSSTest extends ZimbraTestCase
{
    public function testAccountZimletIncludeCSS()
    {
        $value = $this->faker->word;
        $includeCSS = new AccountZimletIncludeCSS($value);
        $this->assertSame($value, $includeCSS->getValue());

        $includeCSS = new AccountZimletIncludeCSS('');
        $includeCSS->setValue($value);
        $this->assertSame($value, $includeCSS->getValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<includeCSS>$value</includeCSS>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($includeCSS, 'xml'));
        $this->assertEquals($includeCSS, $this->serializer->deserialize($xml, AccountZimletIncludeCSS::class, 'xml'));

        $json = json_encode([
            '_content' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($includeCSS, 'json'));
        $this->assertEquals($includeCSS, $this->serializer->deserialize($json, AccountZimletIncludeCSS::class, 'json'));
    }
}