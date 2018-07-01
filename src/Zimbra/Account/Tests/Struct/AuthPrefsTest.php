<?php

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Struct\AuthPrefs;
use Zimbra\Account\Struct\Pref;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AuthPrefs.
 */
class AuthPrefsTest extends ZimbraStructTestCase
{
    public function testAuthPrefs()
    {
        $name1 = $this->faker->word;
        $value1 = $this->faker->word;
        $modified1 = mt_rand(1, 100);
        $pref1 = new Pref($name1, $value1, $modified1);

        $prefs = new AuthPrefs([$pref1]);
        $this->assertSame([$pref1], $prefs->getPrefs());

        $name2 = $this->faker->word;
        $value2 = $this->faker->word;
        $modified2 = mt_rand(1, 100);
        $pref2 = new Pref($name2, $value2, $modified2);

        $prefs->addPref($pref2);
        $this->assertSame([$pref1, $pref2], $prefs->getPrefs());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<prefs>'
                . '<pref name="' . $name1 . '" modified="' . $modified1 . '">' . $value1 . '</pref>'
                . '<pref name="' . $name2 . '" modified="' . $modified2 . '">' . $value2 . '</pref>'
            . '</prefs>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($prefs, 'xml'));

        $prefs = $this->serializer->deserialize($xml, 'Zimbra\Account\Struct\AuthPrefs', 'xml');
        $pref1 = $prefs->getPrefs()[0];
        $pref2 = $prefs->getPrefs()[1];

        $this->assertSame($name1, $pref1->getName());
        $this->assertSame($value1, $pref1->getValue());
        $this->assertSame($modified1, $pref1->getModified());
        $this->assertSame($name2, $pref2->getName());
        $this->assertSame($value2, $pref2->getValue());
        $this->assertSame($modified2, $pref2->getModified());
    }
}
