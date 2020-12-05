<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\RightWithName;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for RightWithName.
 */
class RightWithNameTest extends ZimbraStructTestCase
{
    public function testRightWithName()
    {
        $name = $this->faker->word;
        $right = new RightWithName($name);
        $this->assertSame($name, $right->getName());

        $right = new RightWithName('');
        $right->setName($name);
        $this->assertSame($name, $right->getName());

        $xml = <<<EOT
<?xml version="1.0"?>
<right n="$name" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($right, 'xml'));
        $this->assertEquals($right, $this->serializer->deserialize($xml, RightWithName::class, 'xml'));

        $json = json_encode([
            'n' => $name,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($right, 'json'));
        $this->assertEquals($right, $this->serializer->deserialize($json, RightWithName::class, 'json'));
    }
}
