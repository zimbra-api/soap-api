<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Voice\Struct\VoiceMailPrefName;

/**
 * Testcase class for VoiceMailPrefName.
 */
class VoiceMailPrefNameTest extends ZimbraStructTestCase
{
    public function testVoiceMailPrefName()
    {
        $name = $this->faker->word;
        $pref = new VoiceMailPrefName($name);
        $this->assertSame($name, $pref->getName());
        $pref->setName($name);
        $this->assertSame($name, $pref->getName());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<pref name="' . $name . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $pref);

        $array = [
            'pref' => [
                'name' => $name,
            ],
        ];
        $this->assertEquals($array, $pref->toArray());
    }
}
