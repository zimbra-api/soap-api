<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Enum\AceRightType;
use Zimbra\Enum\GranteeType;
use Zimbra\Account\Struct\AccountACEInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AccountACEInfo.
 */
class AccountACEInfoTest extends ZimbraStructTestCase
{
    public function testAccountACEInfo()
    {
        $zid = $this->faker->uuid;
        $d = $this->faker->word;
        $key = $this->faker->word;
        $pw = $this->faker->sha256;

        $ace = new AccountACEInfo(
            GranteeType::ALL(), AceRightType::VIEW_FREE_BUSY(), $zid, $d, $key, $pw, FALSE, TRUE
        );
        $this->assertEquals(GranteeType::ALL(), $ace->getGranteeType());
        $this->assertEquals(AceRightType::VIEW_FREE_BUSY(), $ace->getRight());
        $this->assertSame($zid, $ace->getZimbraId());
        $this->assertSame($d, $ace->getDisplayName());
        $this->assertSame($key, $ace->getAccessKey());
        $this->assertSame($pw, $ace->getPassword());
        $this->assertFalse($ace->getDeny());
        $this->assertTrue($ace->getCheckGranteeType());

        $ace = new AccountACEInfo(GranteeType::ALL(), AceRightType::VIEW_FREE_BUSY());
        $ace->setGranteeType(GranteeType::USR())
            ->setRight(AceRightType::INVITE())
            ->setZimbraId($zid)
            ->setDisplayName($d)
            ->setAccessKey($key)
            ->setPassword($pw)
            ->setDeny(TRUE)
            ->setCheckGranteeType(FALSE);

        $this->assertEquals(GranteeType::USR(), $ace->getGranteeType());
        $this->assertEquals(AceRightType::INVITE(), $ace->getRight());
        $this->assertSame($zid, $ace->getZimbraId());
        $this->assertSame($d, $ace->getDisplayName());
        $this->assertSame($key, $ace->getAccessKey());
        $this->assertSame($pw, $ace->getPassword());
        $this->assertTrue($ace->getDeny());
        $this->assertFalse($ace->getCheckGranteeType());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ace gt="' . GranteeType::USR() . '" right="' . AceRightType::INVITE() . '" zid="' . $zid . '" d="' . $d . '" key="' . $key . '" pw="' . $pw . '" deny="true" chkgt="false" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($ace, 'xml'));
        $this->assertEquals($ace, $this->serializer->deserialize($xml, AccountACEInfo::class, 'xml'));

        $json = json_encode([
            'gt' => (string) GranteeType::USR(),
            'right' => (string) AceRightType::INVITE(),
            'zid' => $zid,
            'd' => $d,
            'key' => $key,
            'pw' => $pw,
            'deny' => TRUE,
            'chkgt' => FALSE,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($ace, 'json'));
        $this->assertEquals($ace, $this->serializer->deserialize($json, AccountACEInfo::class, 'json'));
    }
}
