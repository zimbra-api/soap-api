<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\IdStatus;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for IdStatus.
 */
class IdStatusTest extends ZimbraStructTestCase
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

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<device id="' . $id . '" status="' . $status . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($is, 'xml'));

        $is = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\IdStatus', 'xml');
        $this->assertSame($id, $is->getId());
        $this->assertSame($status, $is->getStatus());
    }
}
