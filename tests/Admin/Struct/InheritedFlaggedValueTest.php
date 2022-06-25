<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\InheritedFlaggedValue;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for InheritedFlaggedValue.
 */
class InheritedFlaggedValueTest extends ZimbraTestCase
{
    public function testInheritedFlaggedValue()
    {
        $value = $this->faker->word;

        $flag = new InheritedFlaggedValue(FALSE, $value);
        $this->assertFalse($flag->getInherited());
        $this->assertSame($value, $flag->getValue());

        $flag = new InheritedFlaggedValue(FALSE);
        $flag->setInherited(TRUE)
              ->setValue($value);
        $this->assertTrue($flag->getInherited());
        $this->assertSame($value, $flag->getValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<result inherited="true">$value</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($flag, 'xml'));
        $this->assertEquals($flag, $this->serializer->deserialize($xml, InheritedFlaggedValue::class, 'xml'));
    }
}
