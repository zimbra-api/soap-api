<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\MailboxByAccountIdSelector;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for MailboxByAccountIdSelector.
 */
class MailboxByAccountIdSelectorTest extends ZimbraTestCase
{
    public function testMailboxByAccountIdSelector()
    {
        $id = $this->faker->uuid;
        $mbox = new MailboxByAccountIdSelector($id);
        $this->assertSame($id, $mbox->getId());

        $mbox = new MailboxByAccountIdSelector();
        $mbox->setId($id);
        $this->assertSame($id, $mbox->getId());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($mbox, 'xml'));
        $this->assertEquals($mbox, $this->serializer->deserialize($xml, MailboxByAccountIdSelector::class, 'xml'));
    }
}
