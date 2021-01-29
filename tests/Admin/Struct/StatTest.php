<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\Stat;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for Stat.
 */
class StatTest extends ZimbraStructTestCase
{
    public function testStat()
    {
        $value = $this->faker->word;
        $name = $this->faker->word;
        $description = $this->faker->word;

        $stat = new Stat($value, $name, $description);
        $this->assertSame($value, $stat->getValue());
        $this->assertSame($name, $stat->getName());
        $this->assertSame($description, $stat->getDescription());

        $stat = new Stat();
        $stat->setValue($value)
             ->setName($name)
             ->setDescription($description);
        $this->assertSame($value, $stat->getValue());
        $this->assertSame($name, $stat->getName());
        $this->assertSame($description, $stat->getDescription());

        $xml = <<<EOT
<?xml version="1.0"?>
<stat name="$name" description="$description">$value</stat>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($stat, 'xml'));
        $this->assertEquals($stat, $this->serializer->deserialize($xml, Stat::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'description' => $description,
            '_content' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($stat, 'json'));
        $this->assertEquals($stat, $this->serializer->deserialize($json, Stat::class, 'json'));
    }
}
