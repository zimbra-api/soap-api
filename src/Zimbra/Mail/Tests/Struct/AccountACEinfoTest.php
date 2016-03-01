<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\AceRightType;
use Zimbra\Enum\GranteeType;
use Zimbra\Mail\Struct\AccountACEinfo;

/**
 * Testcase class for AccountACEinfo.
 */
class AccountACEinfoTest extends ZimbraMailTestCase
{
    public function testAccountACEinfo()
    {
        $zimbraId = $this->faker->uuid;
        $displayName = $this->faker->word;
        $accessKey = $this->faker->word;
        $password = $this->faker->sha1;

        $ace = new AccountACEinfo(
            GranteeType::USR(), AceRightType::INVITE(), $zimbraId, $displayName, $accessKey, $password, false
        );
        $this->assertTrue($ace->getGranteeType()->is('usr'));
        $this->assertTrue($ace->getRight()->is('invite'));
        $this->assertSame($zimbraId, $ace->getZimbraId());
        $this->assertSame($displayName, $ace->getDisplayName());
        $this->assertSame($accessKey, $ace->getAccessKey());
        $this->assertSame($password, $ace->getPassword());
        $this->assertFalse($ace->getDeny());

        $ace->setGranteeType(GranteeType::USR())
            ->setRight(AceRightType::INVITE())
            ->setZimbraId($zimbraId)
            ->setDisplayName($displayName)
            ->setAccessKey($accessKey)
            ->setPassword($password)
            ->setDeny(true);

        $this->assertTrue($ace->getGranteeType()->is('usr'));
        $this->assertTrue($ace->getRight()->is('invite'));
        $this->assertSame($zimbraId, $ace->getZimbraId());
        $this->assertSame($displayName, $ace->getDisplayName());
        $this->assertSame($accessKey, $ace->getAccessKey());
        $this->assertSame($password, $ace->getPassword());
        $this->assertTrue($ace->getDeny());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<ace gt="' . GranteeType::USR() . '" right="' . AceRightType::INVITE() . '" zid="' . $zimbraId . '" d="' . $displayName . '" key="' . $accessKey . '" pw="' . $password . '" deny="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $ace);

        $array = array(
            'ace' => array(
                'gt' => GranteeType::USR()->value(),
                'right' => AceRightType::INVITE()->value(),
                'zid' => $zimbraId,
                'd' => $displayName,
                'key' => $accessKey,
                'pw' => $password,
                'deny' => true,
            ),
        );
        $this->assertEquals($array, $ace->toArray());
    }
}
