<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\DLInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for DLInfo.
 */
class DLInfoTest extends ZimbraStructTestCase
{
    public function testDLInfo()
    {
        $via = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $attr = new Attr($key, $value);
        $dl = new DLInfo($via, $name, $id, FALSE, [$attr]);
        $this->assertFalse($dl->isDynamic());
        $this->assertSame($via, $dl->getVia());

        $dl = new DLInfo('', $name, $id, FALSE, [$attr]);
        $dl->setDynamic(TRUE)
            ->setVia($via);
        $this->assertTrue($dl->isDynamic());
        $this->assertSame($via, $dl->getVia());

        $xml = <<<EOT
<?xml version="1.0"?>
<dl name="$name" id="$id" dynamic="true" via="$via">
    <a n="$key">$value</a>
</dl>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($dl, 'xml'));
        $this->assertEquals($dl, $this->serializer->deserialize($xml, DLInfo::class, 'xml'));

        $json = json_encode([
            'via' => $via,
            'name' => $name,
            'id' => $id,
            'dynamic' => TRUE,
            'a' => [
                [
                    'n' => $key,
                    '_content' => $value,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($dl, 'json'));
        $this->assertEquals($dl, $this->serializer->deserialize($json, DLInfo::class, 'json'));
    }
}
