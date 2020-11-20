<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\Names;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for Names.
 */
class NamesTest extends ZimbraStructTestCase
{
    public function testNames()
    {
        $name = $this->faker->word;
        $names = new Names($name);
        $this->assertSame($name, $names->getName());

        $names = new Names('');
        $names->setName($name);
        $this->assertSame($name, $names->getName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<name name="' . $name . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($names, 'xml'));
        $this->assertEquals($names, $this->serializer->deserialize($xml, Names::class, 'xml'));

        $json = json_encode([
            'name' => $name,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($names, 'json'));
        $this->assertEquals($names, $this->serializer->deserialize($json, Names::class, 'json'));
    }
}
