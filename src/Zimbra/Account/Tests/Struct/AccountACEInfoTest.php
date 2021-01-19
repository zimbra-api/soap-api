<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Struct\AccountACEInfo;
use Zimbra\Enum\AceRightType;
use Zimbra\Enum\GranteeType;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AccountACEInfo.
 */
class AccountACEInfoTest extends ZimbraStructTestCase
{
    public function testAccountACEInfo()
    {
        $zimbraId = $this->faker->uuid;
        $displayName = $this->faker->word;
        $accessKey = $this->faker->word;
        $password = $this->faker->sha256;

        $ace = new AccountACEInfo(
            GranteeType::ALL(), AceRightType::VIEW_FREE_BUSY(), $zimbraId, $displayName, $accessKey, $password, FALSE, TRUE
        );
        $this->assertEquals(GranteeType::ALL(), $ace->getGranteeType());
        $this->assertEquals(AceRightType::VIEW_FREE_BUSY(), $ace->getRight());
        $this->assertSame($zimbraId, $ace->getZimbraId());
        $this->assertSame($displayName, $ace->getDisplayName());
        $this->assertSame($accessKey, $ace->getAccessKey());
        $this->assertSame($password, $ace->getPassword());
        $this->assertFalse($ace->getDeny());
        $this->assertTrue($ace->getCheckGranteeType());

        $ace = new AccountACEInfo(GranteeType::ALL(), AceRightType::VIEW_FREE_BUSY());
        $ace->setGranteeType(GranteeType::USR())
            ->setRight(AceRightType::INVITE())
            ->setZimbraId($zimbraId)
            ->setDisplayName($displayName)
            ->setAccessKey($accessKey)
            ->setPassword($password)
            ->setDeny(TRUE)
            ->setCheckGranteeType(FALSE);

        $this->assertEquals(GranteeType::USR(), $ace->getGranteeType());
        $this->assertEquals(AceRightType::INVITE(), $ace->getRight());
        $this->assertSame($zimbraId, $ace->getZimbraId());
        $this->assertSame($displayName, $ace->getDisplayName());
        $this->assertSame($accessKey, $ace->getAccessKey());
        $this->assertSame($password, $ace->getPassword());
        $this->assertTrue($ace->getDeny());
        $this->assertFalse($ace->getCheckGranteeType());

        $xml = <<<EOT
<?xml version="1.0"?>
<ace gt="usr" right="invite" zid="$zimbraId" d="$displayName" key="$accessKey" pw="$password" deny="true" chkgt="false" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($ace, 'xml'));
        $this->assertEquals($ace, $this->serializer->deserialize($xml, AccountACEInfo::class, 'xml'));

        $json = json_encode([
            'gt' => 'usr',
            'right' => 'invite',
            'zid' => $zimbraId,
            'd' => $displayName,
            'key' => $accessKey,
            'pw' => $password,
            'deny' => TRUE,
            'chkgt' => FALSE,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($ace, 'json'));
        $this->assertEquals($ace, $this->serializer->deserialize($json, AccountACEInfo::class, 'json'));
    }
}
