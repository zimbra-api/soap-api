<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\ModifyContactAttr;
use Zimbra\Mail\Struct\NewContactAttr;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ModifyContactAttr.
 */
class ModifyContactAttrTest extends ZimbraTestCase
{
    public function testModifyContactAttr()
    {
        $name = $this->faker->name;
        $operation = $this->faker->word;

        $test = new ModifyContactAttr(
            $name, $operation
        );
        $this->assertEquals($operation, $test->getOperation());
        $this->assertTrue($test instanceof NewContactAttr);

        $xml = <<<EOT
<?xml version="1.0"?>
<result n="$name" op="$operation" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, ModifyContactAttr::class, 'xml'));
    }
}
