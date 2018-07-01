<?php

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
            GranteeType::USR()->value(), AceRightType::INVITE()->value(), $zid, $d, $key, $pw, false, true
        );
        $this->assertSame(GranteeType::USR()->value(), $ace->getGranteeType());
        $this->assertSame(AceRightType::INVITE()->value(), $ace->getRight());
        $this->assertSame($zid, $ace->getZimbraId());
        $this->assertSame($d, $ace->getDisplayName());
        $this->assertSame($key, $ace->getAccessKey());
        $this->assertSame($pw, $ace->getPassword());
        $this->assertFalse($ace->getDeny());
        $this->assertTrue($ace->getCheckGranteeType());

        $ace = new AccountACEInfo('', '');
        $ace->setGranteeType(GranteeType::USR()->value())
            ->setRight(AceRightType::INVITE()->value())
            ->setZimbraId($zid)
            ->setDisplayName($d)
            ->setAccessKey($key)
            ->setPassword($pw)
            ->setDeny(true)
            ->setCheckGranteeType(false);

        $this->assertSame(GranteeType::USR()->value(), $ace->getGranteeType());
        $this->assertSame(AceRightType::INVITE()->value(), $ace->getRight());
        $this->assertSame($zid, $ace->getZimbraId());
        $this->assertSame($d, $ace->getDisplayName());
        $this->assertSame($key, $ace->getAccessKey());
        $this->assertSame($pw, $ace->getPassword());
        $this->assertTrue($ace->getDeny());
        $this->assertFalse($ace->getCheckGranteeType());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ace gt="' . GranteeType::USR() . '" right="' . AceRightType::INVITE() . '" zid="' . $zid . '" d="' . $d . '" key="' . $key . '" pw="' . $pw . '" deny="true" chkgt="false" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($ace, 'xml'));

        $ace = $this->serializer->deserialize($xml, 'Zimbra\Account\Struct\AccountACEInfo', 'xml');
        $this->assertSame(GranteeType::USR()->value(), $ace->getGranteeType());
        $this->assertSame(AceRightType::INVITE()->value(), $ace->getRight());
        $this->assertSame($zid, $ace->getZimbraId());
        $this->assertSame($d, $ace->getDisplayName());
        $this->assertSame($key, $ace->getAccessKey());
        $this->assertSame($pw, $ace->getPassword());
        $this->assertTrue($ace->getDeny());
        $this->assertFalse($ace->getCheckGranteeType());
    }
}
