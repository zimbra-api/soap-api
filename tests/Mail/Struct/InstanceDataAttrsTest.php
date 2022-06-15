<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\CommonInstanceDataAttrs;
use Zimbra\Mail\Struct\InstanceDataAttrs;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for InstanceDataAttrs.
 */
class InstanceDataAttrsTest extends ZimbraTestCase
{
    public function testInstanceDataAttrs()
    {
        $duration = $this->faker->randomNumber;
 
        $data = new InstanceDataAttrs($duration);
        $this->assertSame($duration, $data->getDuration());
        $this->assertTrue($data instanceof CommonInstanceDataAttrs);

        $data = new InstanceDataAttrs();
        $data->setDuration($duration);
        $this->assertSame($duration, $data->getDuration());

        $xml = <<<EOT
<?xml version="1.0"?>
<result dur="$duration" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($data, 'xml'));
        $this->assertEquals($data, $this->serializer->deserialize($xml, InstanceDataAttrs::class, 'xml'));

        $json = json_encode([
            'dur' => $duration,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($data, 'json'));
        $this->assertEquals($data, $this->serializer->deserialize($json, InstanceDataAttrs::class, 'json'));
    }
}
