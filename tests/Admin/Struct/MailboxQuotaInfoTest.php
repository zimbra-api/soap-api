<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\MailboxQuotaInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for MailboxQuotaInfo.
 */
class MailboxQuotaInfoTest extends ZimbraTestCase
{
    public function testMailboxQuotaInfo()
    {
        $accountId = $this->faker->uuid;
        $quotaUsed = mt_rand(1, 100);

        $mbox = new MailboxQuotaInfo(
            $accountId, $quotaUsed
        );
        $this->assertSame($accountId, $mbox->getAccountId());
        $this->assertSame($quotaUsed, $mbox->getQuotaUsed());

        $mbox = new MailboxQuotaInfo('', 0);
        $mbox->setAccountId($accountId)
            ->setQuotaUsed($quotaUsed);
        $this->assertSame($accountId, $mbox->getAccountId());
        $this->assertSame($quotaUsed, $mbox->getQuotaUsed());

        $xml = <<<EOT
<?xml version="1.0"?>
<mbox id="$accountId" used="$quotaUsed" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($mbox, 'xml'));
        $this->assertEquals($mbox, $this->serializer->deserialize($xml, MailboxQuotaInfo::class, 'xml'));

        $json = json_encode([
            'id' => $accountId,
            'used' => $quotaUsed,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($mbox, 'json'));
        $this->assertEquals($mbox, $this->serializer->deserialize($json, MailboxQuotaInfo::class, 'json'));
    }
}
