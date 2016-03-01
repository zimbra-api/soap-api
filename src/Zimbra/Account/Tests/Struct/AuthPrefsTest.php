<?php

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Tests\ZimbraAccountTestCase;
use Zimbra\Account\Struct\AuthPrefs;
use Zimbra\Account\Struct\Pref;

/**
 * Testcase class for AuthPrefs.
 */
class AuthPrefsTest extends ZimbraAccountTestCase
{
    public function testAuthPrefs()
    {
        $name1 = $this->faker->word;
        $value1 = $this->faker->word;
        $modified1 = mt_rand(1, 100);
        $pref1 = new Pref($name1, $value1, $modified1);

        $prefs = new AuthPrefs([$pref1]);
        $this->assertSame([$pref1], $prefs->getPrefs()->all());

        $name2 = $this->faker->word;
        $value2 = $this->faker->word;
        $modified2 = mt_rand(1, 100);
        $pref2 = new Pref($name2, $value2, $modified2);

        $prefs->addPref($pref2);
        $this->assertSame([$pref1, $pref2], $prefs->getPrefs()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<prefs>'
                . '<pref name="' . $name1 . '" modified="' . $modified1 . '">' . $value1 . '</pref>'
                . '<pref name="' . $name2 . '" modified="' . $modified2 . '">' . $value2 . '</pref>'
            . '</prefs>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $prefs);

        $array = [
            'prefs' => [
                'pref' => [
                    [
                        'name' => $name1,
                        '_content' => $value1,
                        'modified' => $modified1,
                    ],
                    [
                        'name' => $name2,
                        '_content' => $value2,
                        'modified' => $modified2,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $prefs->toArray());
    }
}
