<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Voice\Struct\PhoneSpec;
use Zimbra\Voice\Struct\PrefSpec;

/**
 * Testcase class for PhoneSpec.
 */
class PhoneSpecTest extends ZimbraStructTestCase
{
    public function testPhoneSpec()
    {
        $name = $this->faker->word;
        $pref = new PrefSpec($name);
        $phone = new PhoneSpec($name, [$pref]);
        $this->assertSame($name, $phone->getName());
        $this->assertSame([$pref], $phone->getPrefs()->all());
        $phone->setName($name)
              ->addPref($pref);
        $this->assertSame($name, $phone->getName());
        $this->assertSame([$pref, $pref], $phone->getPrefs()->all());
        $phone->getPrefs()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<phone name="' . $name . '">'
                .'<pref name="' . $name . '" />'
            .'</phone>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $phone);

        $array = [
            'phone' => [
                'name' => $name,
                'pref' => [
                    [
                        'name' => $name,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $phone->toArray());
    }
}
