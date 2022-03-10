<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\CurrentVolumeInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CurrentVolumeInfo.
 */
class CurrentVolumeInfoTest extends ZimbraTestCase
{
    public function testCurrentVolumeInfo()
    {
        $type = mt_rand(1, 10);
        $id = mt_rand(1, 10);

        $volume = new CurrentVolumeInfo($type, $id);
        $this->assertSame($type, $volume->getType());
        $this->assertSame($id, $volume->getId());

        $volume = new CurrentVolumeInfo(0, 0);
        $volume->setId($id)
               ->setType($type);
        $this->assertSame($type, $volume->getType());
        $this->assertSame($id, $volume->getId());

        $xml = <<<EOT
<?xml version="1.0"?>
<result type="$type" id="$id" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($volume, 'xml'));
        $this->assertEquals($volume, $this->serializer->deserialize($xml, CurrentVolumeInfo::class, 'xml'));

        $json = json_encode([
            'type' => $type,
            'id' => $id,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($volume, 'json'));
        $this->assertEquals($volume, $this->serializer->deserialize($json, CurrentVolumeInfo::class, 'json'));
    }
}
