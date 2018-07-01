<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\MailboxByAccountIdSelector;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for MailboxByAccountIdSelector.
 */
class MailboxByAccountIdSelectorTest extends ZimbraStructTestCase
{
    public function testMailboxByAccountIdSelector()
    {
        $id = $this->faker->uuid;
        $mbox = new MailboxByAccountIdSelector($id);
        $this->assertSame($id, $mbox->getId());

        $mbox = new MailboxByAccountIdSelector('');
        $mbox->setId($id);
        $this->assertSame($id, $mbox->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<mbox id="' . $id . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($mbox, 'xml'));

        $mbox = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\MailboxByAccountIdSelector', 'xml');
        $this->assertSame($id, $mbox->getId());
    }
}
