<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Voice\Struct\ModifyFromNumSpec;

/**
 * Testcase class for ModifyFromNumSpec.
 */
class ModifyFromNumSpecTest extends ZimbraStructTestCase
{
    public function testModifyFromNumSpec()
    {
        $oldPhone = $this->faker->word;
        $newPhone = $this->faker->word;
        $id = $this->faker->word;
        $label = $this->faker->word;

        $phone = new ModifyFromNumSpec(
            $oldPhone, $newPhone, $id, $label
        );
        $this->assertSame($oldPhone, $phone->getOldPhone());
        $this->assertSame($newPhone, $phone->getPhone());
        $this->assertSame($id, $phone->getId());
        $this->assertSame($label, $phone->getLabel());
        $phone->setOldPhone($oldPhone)
              ->setPhone($newPhone)
              ->setId($id)
              ->setLabel($label);
        $this->assertSame($oldPhone, $phone->getOldPhone());
        $this->assertSame($newPhone, $phone->getPhone());
        $this->assertSame($id, $phone->getId());
        $this->assertSame($label, $phone->getLabel());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<phone oldPhone="' . $oldPhone . '" phone="' . $newPhone . '" id="' . $id . '" label="' . $label . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $phone);

        $array = [
            'phone' => [
                'oldPhone' => $oldPhone,
                'phone' => $newPhone,
                'id' => $id,
                'label' => $label,
            ],
        ];
        $this->assertEquals($array, $phone->toArray());
    }
}
