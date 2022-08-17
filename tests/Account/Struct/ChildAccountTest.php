<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Account\Struct\Attr;
use Zimbra\Account\Struct\ChildAccount;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ChildAccount.
 */
class ChildAccountTest extends ZimbraTestCase
{
    public function testChildAccount()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->name;
        $value = $this->faker->word;

        $attr = new Attr($name, $value, TRUE);

        $childAccount = new MockChildAccount($id, $name, FALSE, FALSE, [$attr]);
        $this->assertSame($id, $childAccount->getId());
        $this->assertSame($name, $childAccount->getName());
        $this->assertFalse($childAccount->isVisible());
        $this->assertFalse($childAccount->isActive());
        $this->assertSame([$attr], $childAccount->getAttrs());

        $childAccount = new MockChildAccount();
        $childAccount->setName($name)
            ->setId($id)
            ->setIsVisible(TRUE)
            ->setIsActive(TRUE)
            ->setAttrs([$attr])
            ->addAttr($attr);
        $this->assertSame($name, $childAccount->getName());
        $this->assertSame($id, $childAccount->getId());
        $this->assertTrue($childAccount->isVisible());
        $this->assertTrue($childAccount->isActive());
        $this->assertSame([$attr, $attr], $childAccount->getAttrs());
        $childAccount->setAttrs([$attr]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" name="$name" visible="true" active="true" xmlns:urn="urn:zimbraAccount">
    <urn:attrs>
        <urn:attr name="$name" pd="true">$value</urn:attr>
    </urn:attrs>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($childAccount, 'xml'));
        $this->assertEquals($childAccount, $this->serializer->deserialize($xml, MockChildAccount::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAccount", prefix="urn")
 */
#[XmlNamespace(uri: 'urn:zimbraAccount', prefix: "urn")]
class MockChildAccount extends ChildAccount
{
}
