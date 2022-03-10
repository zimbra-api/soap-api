<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

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

        $childAccount = new ChildAccount($id, $name, FALSE, FALSE, [$attr]);
        $this->assertSame($id, $childAccount->getId());
        $this->assertSame($name, $childAccount->getName());
        $this->assertFalse($childAccount->isVisible());
        $this->assertFalse($childAccount->isActive());
        $this->assertSame([$attr], $childAccount->getAttrs());

        $childAccount = new ChildAccount('', '', FALSE, FALSE);
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
<result id="$id" name="$name" visible="true" active="true">
    <attrs>
        <attr name="$name" pd="true">$value</attr>
    </attrs>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($childAccount, 'xml'));
        $this->assertEquals($childAccount, $this->serializer->deserialize($xml, ChildAccount::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'name' => $name,
            'visible' => TRUE,
            'active' => TRUE,
            'attrs' => [
                'attr' => [
                    [
                        'name' => $name,
                        'pd' => TRUE,
                        '_content' => $value,
                    ],
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($childAccount, 'json'));
        $this->assertEquals($childAccount, $this->serializer->deserialize($json, ChildAccount::class, 'json'));
    }
}
