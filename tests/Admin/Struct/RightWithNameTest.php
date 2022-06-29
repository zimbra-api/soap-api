<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\RightWithName;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for RightWithName.
 */
class RightWithNameTest extends ZimbraTestCase
{
    public function testRightWithName()
    {
        $name = $this->faker->word;
        $right = new RightWithName($name);
        $this->assertSame($name, $right->getName());

        $right = new RightWithName();
        $right->setName($name);
        $this->assertSame($name, $right->getName());

        $xml = <<<EOT
<?xml version="1.0"?>
<result n="$name" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($right, 'xml'));
        $this->assertEquals($right, $this->serializer->deserialize($xml, RightWithName::class, 'xml'));
    }
}
