<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Voice\Struct\ModifyVoiceMailPinSpec;

/**
 * Testcase class for ModifyVoiceMailPinSpec.
 */
class ModifyVoiceMailPinSpecTest extends ZimbraStructTestCase
{
    public function testModifyVoiceMailPinSpec()
    {
        $oldPin = $this->faker->word;
        $pin = $this->faker->word;
        $name = $this->faker->word;

        $phone = new ModifyVoiceMailPinSpec(
            $oldPin, $pin, $name
        );
        $this->assertSame($oldPin, $phone->getOldPin());
        $this->assertSame($pin, $phone->getPin());
        $this->assertSame($name, $phone->getName());
        $phone->setOldPin($oldPin)
              ->setPin($pin)
              ->setName($name);
        $this->assertSame($oldPin, $phone->getOldPin());
        $this->assertSame($pin, $phone->getPin());
        $this->assertSame($name, $phone->getName());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<phone oldPin="' . $oldPin . '" pin="' . $pin . '" name="' . $name . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $phone);

        $array = [
            'phone' => [
                'oldPin' => $oldPin,
                'pin' => $pin,
                'name' => $name,
            ],
        ];
        $this->assertEquals($array, $phone->toArray());
    }
}
