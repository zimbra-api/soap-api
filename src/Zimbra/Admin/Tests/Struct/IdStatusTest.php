<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\IdStatus;

/**
 * Testcase class for IdStatus.
 */
class IdStatusTest extends ZimbraAdminTestCase
{
    public function testIdStatus()
    {
        $id = $this->faker->word;
        $status = $this->faker->word;

        $is = new IdStatus($id, $status);
        $this->assertSame($id, $is->getId());
        $this->assertSame($status, $is->getStatus());

        $is->setId($id)
           ->setStatus($status);
        $this->assertSame($id, $is->getId());
        $this->assertSame($status, $is->getStatus());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<device id="' . $id . '" status="' . $status . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $is);

        $array = [
            'device' => [
                'id' => $id,
                'status' => $status,
            ],
        ];
        $this->assertEquals($array, $is->toArray());
    }
}
