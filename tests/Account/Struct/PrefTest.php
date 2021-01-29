<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Account\Struct\Pref;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

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

        $pref = new Pref('');
        $pref->setName($name)
             ->setValue($value)
             ->setModified($modified);
        $this->assertSame($name, $pref->getName());
        $this->assertSame($value, $pref->getValue());
        $this->assertSame($modified, $pref->getModified());

        $xml = <<<EOT
<?xml version="1.0"?>
<pref name="$name" modified="$modified">$value</pref>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($pref, 'xml'));
        $this->assertEquals($pref, $this->serializer->deserialize($xml, Pref::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'modified' => $modified,
            '_content' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($pref, 'json'));
        $this->assertEquals($pref, $this->serializer->deserialize($json, Pref::class, 'json'));
    }
}
