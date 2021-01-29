<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Account\Struct\Right;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for Right.
 */
class RightTest extends ZimbraStructTestCase
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
<ace right="$name" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($right, 'xml'));
        $this->assertEquals($right, $this->serializer->deserialize($xml, Right::class, 'xml'));

        $json = json_encode([
            'right' => $name,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($right, 'json'));
        $this->assertEquals($right, $this->serializer->deserialize($json, Right::class, 'json'));
    }
}
