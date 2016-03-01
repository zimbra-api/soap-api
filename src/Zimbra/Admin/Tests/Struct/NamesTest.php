<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\Names;

/**
 * Testcase class for Names.
 */
class NamesTest extends ZimbraAdminTestCase
{
    public function testNames()
    {
        $name = $this->faker->word;
        $names = new Names($name);
        $this->assertSame($name, $names->getName());

        $names->setName($name);
        $this->assertSame($name, $names->getName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<name name="' . $name . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $names);

        $array = [
            'name' => [
                'name' => $name,
            ],
        ];
        $this->assertEquals($array, $names->toArray());
    }
}
