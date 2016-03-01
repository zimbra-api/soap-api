<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Voice\Struct\PrefInfo;

/**
 * Testcase class for PrefInfo.
 */
class PrefInfoTest extends ZimbraStructTestCase
{
    public function testPrefInfo()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $pref = new PrefInfo($name, $value);
        $this->assertSame($name, $pref->getName());
        $pref->setName($name);
        $this->assertSame($name, $pref->getName());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<pref name="' . $name . '">' . $value . '</pref>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $pref);

        $array = [
            'pref' => [
                'name' => $name,
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $pref->toArray());
    }
}
