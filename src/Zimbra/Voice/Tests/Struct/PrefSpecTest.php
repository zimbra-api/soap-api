<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Voice\Struct\PrefSpec;

/**
 * Testcase class for PrefSpec.
 */
class PrefSpecTest extends ZimbraStructTestCase
{
    public function testPrefSpec()
    {
        $name = $this->faker->word;
        $pref = new PrefSpec($name);
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
