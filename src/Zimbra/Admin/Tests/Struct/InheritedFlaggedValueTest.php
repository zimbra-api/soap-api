<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\InheritedFlaggedValue;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for InheritedFlaggedValue.
 */
class InheritedFlaggedValueTest extends ZimbraStructTestCase
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
<flag inherited="true">$value</flag>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($flag, 'xml'));
        $this->assertEquals($flag, $this->serializer->deserialize($xml, InheritedFlaggedValue::class, 'xml'));

        $json = json_encode([
            'inherited' => TRUE,
            '_content' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($flag, 'json'));
        $this->assertEquals($flag, $this->serializer->deserialize($json, InheritedFlaggedValue::class, 'json'));
    }
}
