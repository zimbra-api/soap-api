<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\CheckedRight;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckedRight.
 */
class CheckedRightTest extends ZimbraStructTestCase
{
    public function testCheckedRight()
    {
        $value = $this->faker->word;
        $right = new CheckedRight($value);
        $this->assertSame($value, $right->getValue());

        $right = new CheckedRight();
        $right->setValue($value);
        $this->assertSame($value, $right->getValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<right>$value</right>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($right, 'xml'));
        $this->assertEquals($right, $this->serializer->deserialize($xml, CheckedRight::class, 'xml'));

        $json = json_encode([
            '_content' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($right, 'json'));
        $this->assertEquals($right, $this->serializer->deserialize($json, CheckedRight::class, 'json'));
    }
}
