<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\AccountQuotaInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AccountQuotaInfo.
 */
class AccountQuotaInfoTest extends ZimbraTestCase
{
    public function testAccountQuotaInfo()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $quotaUsed = mt_rand(1, 100);
        $quotaLimit = mt_rand(1, 100);

        $account = new AccountQuotaInfo(
            $name, $id, $quotaUsed, $quotaLimit
        );
        $this->assertSame($name, $account->getName());
        $this->assertSame($id, $account->getId());
        $this->assertSame($quotaUsed, $account->getQuotaUsed());
        $this->assertSame($quotaLimit, $account->getQuotaLimit());

        $account = new AccountQuotaInfo('', '', 0, 0);
        $account->setName($name)
            ->setId($id)
            ->setQuotaLimit($quotaLimit)
            ->setQuotaUsed($quotaUsed);
        $this->assertSame($name, $account->getName());
        $this->assertSame($id, $account->getId());
        $this->assertSame($quotaUsed, $account->getQuotaUsed());
        $this->assertSame($quotaLimit, $account->getQuotaLimit());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" id="$id" used="$quotaUsed" limit="$quotaLimit" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($account, 'xml'));
        $this->assertEquals($account, $this->serializer->deserialize($xml, AccountQuotaInfo::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'id' => $id,
            'used' => $quotaUsed,
            'limit' => $quotaLimit,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($account, 'json'));
        $this->assertEquals($account, $this->serializer->deserialize($json, AccountQuotaInfo::class, 'json'));
    }
}
