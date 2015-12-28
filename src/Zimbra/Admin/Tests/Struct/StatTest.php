<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\Stat;

/**
 * Testcase class for Stat.
 */
class StatTest extends ZimbraAdminTestCase
{
    public function testStat()
    {
        $value = $this->faker->word;
        $name = $this->faker->word;
        $description = $this->faker->word;

        $stat = new Stat($value, $name, $description);
        $this->assertSame($name, $stat->getName());
        $this->assertSame($description, $stat->getDescription());

        $stat->setName($name)
             ->setDescription($description);
        $this->assertSame($name, $stat->getName());
        $this->assertSame($description, $stat->getDescription());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<stat name="' . $name . '" description="' . $description . '">' . $value . '</stat>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $stat);

        $array = [
            'stat' => [
                'name' => $name,
                'description' => $description,
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $stat->toArray());
    }
}
