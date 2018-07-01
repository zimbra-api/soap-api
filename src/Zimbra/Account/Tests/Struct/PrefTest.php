<?php

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Struct\Pref;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for Pref.
 */
class PrefTest extends ZimbraStructTestCase
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
        $pref = new Pref('');
        $pref->setName($name)
             ->setValue($value)
             ->setModified($modified);
        $this->assertSame($name, $pref->getName());
        $this->assertSame($value, $pref->getValue());
        $this->assertSame($modified, $pref->getModified());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<pref name="' . $name . '" modified="' .$modified . '">' . $value . '</pref>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($pref, 'xml'));

        $pref = $this->serializer->deserialize($xml, 'Zimbra\Account\Struct\Pref', 'xml');
        $this->assertSame($name, $pref->getName());
        $this->assertSame($value, $pref->getValue());
        $this->assertSame($modified, $pref->getModified());
    }
}
