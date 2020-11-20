<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Struct\Right;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

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

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ace right="' . $name . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($right, 'xml'));
        $this->assertEquals($right, $this->serializer->deserialize($xml, Right::class, 'xml'));

        $json = json_encode([
            'right' => $name,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($right, 'json'));
        $this->assertEquals($right, $this->serializer->deserialize($json, Right::class, 'json'));
    }
}
