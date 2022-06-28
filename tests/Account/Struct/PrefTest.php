<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Account\Struct\Pref;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for Pref.
 */
class PrefTest extends ZimbraTestCase
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

        $pref = new Pref();
        $pref->setName($name)
             ->setValue($value)
             ->setModified($modified);
        $this->assertSame($name, $pref->getName());
        $this->assertSame($value, $pref->getValue());
        $this->assertSame($modified, $pref->getModified());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" modified="$modified">$value</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($pref, 'xml'));
        $this->assertEquals($pref, $this->serializer->deserialize($xml, Pref::class, 'xml'));
    }
}
