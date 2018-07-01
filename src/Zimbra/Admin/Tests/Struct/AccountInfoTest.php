<?php

namespace Zimbra\Admin\Tests\Struct;

use JMS\Serializer\Annotation\XmlRoot;

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

        $account = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\AccountInfo', 'xml');
        $attr = $account->getAttrList()[0];

        $this->assertSame($name, $account->getName());
        $this->assertSame($id, $account->getId());
        $this->assertTrue($account->getIsExternal());
        $this->assertSame($key, $attr->getKey());
        $this->assertSame($value, $attr->getValue());
    }
}
