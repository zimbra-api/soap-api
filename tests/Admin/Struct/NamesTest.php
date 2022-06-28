<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\Names;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for Names.
 */
class NamesTest extends ZimbraTestCase
{
    public function testNames()
    {
        $name = $this->faker->word;
        $names = new Names($name);
        $this->assertSame($name, $names->getName());

        $names = new Names();
        $names->setName($name);
        $this->assertSame($name, $names->getName());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($names, 'xml'));
        $this->assertEquals($names, $this->serializer->deserialize($xml, Names::class, 'xml'));
    }
}
