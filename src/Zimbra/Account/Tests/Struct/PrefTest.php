<?php

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Tests\ZimbraAccountTestCase;
use Zimbra\Account\Struct\Pref;

/**
 * Testcase class for Pref.
 */
class PrefTest extends ZimbraAccountTestCase
{
    public function testPref()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $modified = mt_rand(1, 100);

        $pref = new Pref($name, $value, $modified);
        $this->assertSame($name, $pref->getName());
        $this->assertSame($value, $pref->getValue());
        $this->assertSame($modified, $pref->getModified());

        $modified = mt_rand(1, 1000);
        $pref->setName($name)
             ->setModified($modified);
        $this->assertSame($name, $pref->getName());
        $this->assertSame($modified, $pref->getModified());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<pref name="' . $name . '" modified="' .$modified . '">' . $value . '</pref>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $pref);

        $array = [
            'pref' => [
                'name' => $name,
                'modified' => $modified,
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $pref->toArray());
    }
}
