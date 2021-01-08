<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Struct\Attr;
use Zimbra\Account\Struct\ChildAccount;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ChildAccount.
 */
class ChildAccountTest extends ZimbraStructTestCase
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
<childAccount id="$id" name="$name" visible="true" active="true">
    <attrs>
        <attr name="$name" pd="true">$value</attr>
    </attrs>
</childAccount>
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
                        '_content' => $value,
                        'pd' => TRUE,
                    ],
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($childAccount, 'json'));
        $this->assertEquals($childAccount, $this->serializer->deserialize($json, ChildAccount::class, 'json'));
    }
}
