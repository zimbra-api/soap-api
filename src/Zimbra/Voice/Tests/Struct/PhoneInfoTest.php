<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Voice\Struct\PrefInfo;
use Zimbra\Voice\Struct\PhoneInfo;

/**
 * Testcase class for PhoneInfo.
 */
class PhoneInfoTest extends ZimbraStructTestCase
{
    public function testPhoneInfo()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;

        $pref = new PrefInfo($name, $value);
        $phone = new PhoneInfo($name, [$pref]);
        $this->assertSame($name, $phone->getName());
        $this->assertSame([$pref], $phone->getPrefs()->all());
        $phone->setName($name)
              ->addPref($pref);
        $this->assertSame($name, $phone->getName());
        $this->assertSame([$pref, $pref], $phone->getPrefs()->all());
        $phone->getPrefs()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<phone name="' . $name . '">'
                .'<pref name="' . $name . '">' . $value . '</pref>'
            .'</phone>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $phone);

        $array = [
            'phone' => [
                'name' => $name,
                'pref' => [
                    [
                        'name' => $name,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $phone->toArray());
    }
}
