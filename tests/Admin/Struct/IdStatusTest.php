<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\IdStatus;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for IdStatus.
 */
class IdStatusTest extends ZimbraTestCase
{
    public function testIdStatus()
    {
        $id = $this->faker->word;
        $status = $this->faker->word;

        $is = new IdStatus($id, $status);
        $this->assertSame($id, $is->getId());
        $this->assertSame($status, $is->getStatus());

        $is = new IdStatus();
        $is->setId($id)
           ->setStatus($status);
        $this->assertSame($id, $is->getId());
        $this->assertSame($status, $is->getStatus());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" status="$status" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($is, 'xml'));
        $this->assertEquals($is, $this->serializer->deserialize($xml, IdStatus::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'status' => $status,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($is, 'json'));
        $this->assertEquals($is, $this->serializer->deserialize($json, IdStatus::class, 'json'));
    }
}
