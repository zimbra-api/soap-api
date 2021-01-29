<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\AccountsAttrib;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AccountsAttrib.
 */
class AccountsAttribTest extends ZimbraTestCase
{
    public function testAccountsAttrib()
    {
        $accounts = $this->faker->word;
        $attr = new AccountsAttrib($accounts);
        $this->assertSame($accounts, $attr->getAccounts());

        $attr = new AccountsAttrib('');
        $attr->setAccounts($accounts);
        $this->assertSame($accounts, $attr->getAccounts());

        $xml = <<<EOT
<?xml version="1.0"?>
<attr accounts="$accounts" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attr, 'xml'));
        $this->assertEquals($attr, $this->serializer->deserialize($xml, AccountsAttrib::class, 'xml'));

        $json = json_encode([
            'accounts' => $accounts,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($attr, 'json'));
        $this->assertEquals($attr, $this->serializer->deserialize($json, AccountsAttrib::class, 'json'));
    }
}
