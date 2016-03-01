<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Voice\Struct\VoiceMsgUploadSpec;

/**
 * Testcase class for VoiceMsgUploadSpec.
 */
class VoiceMsgUploadSpecTest extends ZimbraStructTestCase
{
    public function testVoiceMsgUploadSpec()
    {
        $phone = $this->faker->word;
        $id = $this->faker->word;
        $vm = new VoiceMsgUploadSpec(
            $id, $phone
        );
        $this->assertSame($id, $vm->getId());
        $this->assertSame($phone, $vm->getPhone());
        $vm->setPhone($phone)
           ->setId($id);
        $this->assertSame($id, $vm->getId());
        $this->assertSame($phone, $vm->getPhone());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<vm id="' . $id . '" phone="' . $phone . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $vm);

        $array = [
            'vm' => [
                'id' => $id,
                'phone' => $phone,
            ],
        ];
        $this->assertEquals($array, $vm->toArray());
    }
}
