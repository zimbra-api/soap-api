<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Account\Struct\Right;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for Right.
 */
class RightTest extends ZimbraTestCase
{
    public function testRight()
    {
        $name = $this->faker->word;
        $right = new Right($name);
        $this->assertSame($name, $right->getRight());

        $right = new Right('');
        $right->setRight($name);
        $this->assertSame($name, $right->getRight());

        $xml = <<<EOT
<?xml version="1.0"?>
<result right="$name" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($right, 'xml'));
        $this->assertEquals($right, $this->serializer->deserialize($xml, Right::class, 'xml'));
    }
}
