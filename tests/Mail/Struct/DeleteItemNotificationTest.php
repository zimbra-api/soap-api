<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\DeleteItemNotification;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DeleteItemNotification.
 */
class DeleteItemNotificationTest extends ZimbraTestCase
{
    public function testDeleteItemNotification()
    {
        $id = mt_rand(1, 99);
        $type = $this->faker->word;

        $deleted = new DeleteItemNotification($id, $type);
        $this->assertSame($id, $deleted->getId());
        $this->assertSame($type, $deleted->getType());

        $deleted = new DeleteItemNotification(0, '');
        $deleted->setId($id)
               ->setType($type);
        $this->assertSame($id, $deleted->getId());
        $this->assertSame($type, $deleted->getType());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" t="$type" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($deleted, 'xml'));
        $this->assertEquals($deleted, $this->serializer->deserialize($xml, DeleteItemNotification::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            't' => $type,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($deleted, 'json'));
        $this->assertEquals($deleted, $this->serializer->deserialize($json, DeleteItemNotification::class, 'json'));
    }
}
