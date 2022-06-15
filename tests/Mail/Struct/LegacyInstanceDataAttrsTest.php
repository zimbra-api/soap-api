<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\CommonInstanceDataAttrs;
use Zimbra\Mail\Struct\LegacyInstanceDataAttrs;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for LegacyInstanceDataAttrs.
 */
class LegacyInstanceDataAttrsTest extends ZimbraTestCase
{
    public function testLegacyInstanceDataAttrs()
    {
        $duration = $this->faker->randomNumber;
 
        $data = new LegacyInstanceDataAttrs($duration);
        $this->assertSame($duration, $data->getDuration());
        $this->assertTrue($data instanceof CommonInstanceDataAttrs);

        $data = new LegacyInstanceDataAttrs();
        $data->setDuration($duration);
        $this->assertSame($duration, $data->getDuration());

        $xml = <<<EOT
<?xml version="1.0"?>
<result d="$duration" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($data, 'xml'));
        $this->assertEquals($data, $this->serializer->deserialize($xml, LegacyInstanceDataAttrs::class, 'xml'));

        $json = json_encode([
            'd' => $duration,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($data, 'json'));
        $this->assertEquals($data, $this->serializer->deserialize($json, LegacyInstanceDataAttrs::class, 'json'));
    }
}
