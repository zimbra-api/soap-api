<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\CheckedRight;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CheckedRight.
 */
class CheckedRightTest extends ZimbraTestCase
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
<result>$value</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($right, 'xml'));
        $this->assertEquals($right, $this->serializer->deserialize($xml, CheckedRight::class, 'xml'));
    }
}
