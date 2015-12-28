<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\MailboxByAccountIdSelector;

/**
 * Testcase class for MailboxByAccountIdSelector.
 */
class MailboxByAccountIdSelectorTest extends ZimbraAdminTestCase
{
    public function testMailboxByAccountIdSelector()
    {
        $id = $this->faker->uuid;
        $mbox = new \Zimbra\Admin\Struct\MailboxByAccountIdSelector($id);
        $this->assertSame($id, $mbox->getId());

        $mbox->setId($id);
        $this->assertSame($id, $mbox->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<mbox id="' . $id . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $mbox);

        $array = [
            'mbox' => [
                'id' => $id,
            ],
        ];
        $this->assertEquals($array, $mbox->toArray());
    }
}
