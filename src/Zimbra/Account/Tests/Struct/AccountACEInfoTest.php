<?php

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Tests\ZimbraAccountTestCase;
use Zimbra\Enum\AceRightType;
use Zimbra\Enum\GranteeType;
use Zimbra\Account\Struct\AccountACEInfo;

/**
 * Testcase class for AccountACEInfo.
 */
class AccountACEInfoTest extends ZimbraAccountTestCase
{
    public function testAccountACEInfo()
    {
        $zid = $this->faker->uuid;
        $d = $this->faker->word;
        $key = $this->faker->word;
        $pw = $this->faker->sha256;

        $ace = new AccountACEInfo(
            GranteeType::USR(), AceRightType::INVITE(), $zid, $d, $key, $pw, false, true
        );
        $this->assertTrue($ace->getGranteeType()->is('usr'));
        $this->assertTrue($ace->getRight()->is('invite'));
        $this->assertSame($zid, $ace->getZimbraId());
        $this->assertSame($d, $ace->getDisplayName());
        $this->assertSame($key, $ace->getAccessKey());
        $this->assertSame($pw, $ace->getPassword());
        $this->assertFalse($ace->getDeny());
        $this->assertTrue($ace->getCheckGranteeType());

        $ace->setGranteeType(GranteeType::USR())
            ->setRight(AceRightType::INVITE())
            ->setZimbraId($zid)
            ->setDisplayName($d)
            ->setAccessKey($key)
            ->setPassword($pw)
            ->setDeny(true)
            ->setCheckGranteeType(false);

        $this->assertTrue($ace->getGranteeType()->is('usr'));
        $this->assertTrue($ace->getRight()->is('invite'));
        $this->assertSame($zid, $ace->getZimbraId());
        $this->assertSame($d, $ace->getDisplayName());
        $this->assertSame($key, $ace->getAccessKey());
        $this->assertSame($pw, $ace->getPassword());
        $this->assertTrue($ace->getDeny());
        $this->assertFalse($ace->getCheckGranteeType());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ace gt="' . GranteeType::USR() . '" right="' . AceRightType::INVITE() . '" zid="' . $zid . '" d="' . $d . '" key="' . $key . '" pw="' . $pw . '" deny="true" chkgt="false" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $ace);

        $array = [
            'ace' => [
                'gt' => GranteeType::USR()->value(),
                'right' => AceRightType::INVITE()->value(),
                'zid' => $zid,
                'd' => $d,
                'key' => $key,
                'pw' => $pw,
                'deny' => true,
                'chkgt' => false,
            ],
        ];
        $this->assertEquals($array, $ace->toArray());
    }
}
