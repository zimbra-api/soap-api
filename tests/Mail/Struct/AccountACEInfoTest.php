<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\AccountACEInfo;
use Zimbra\Common\Enum\AceRightType;
use Zimbra\Common\Enum\GranteeType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AccountACEInfo.
 */
class AccountACEInfoTest extends ZimbraTestCase
{
    public function testAccountACEInfo()
    {
        $zimbraId = $this->faker->uuid;
        $right = AceRightType::VIEW_FREE_BUSY()->getValue();
        $displayName = $this->faker->word;
        $accessKey = $this->faker->word;
        $password = $this->faker->sha256;

        $ace = new AccountACEInfo(
            GranteeType::ALL(), $right, $zimbraId, $displayName, $accessKey, $password, FALSE
        );
        $this->assertEquals(GranteeType::ALL(), $ace->getGranteeType());
        $this->assertEquals($right, $ace->getRight());
        $this->assertSame($zimbraId, $ace->getZimbraId());
        $this->assertSame($displayName, $ace->getDisplayName());
        $this->assertSame($accessKey, $ace->getAccessKey());
        $this->assertSame($password, $ace->getPassword());
        $this->assertFalse($ace->getDeny());

        $ace = new AccountACEInfo();
        $ace->setGranteeType(GranteeType::USR())
            ->setRight($right)
            ->setZimbraId($zimbraId)
            ->setDisplayName($displayName)
            ->setAccessKey($accessKey)
            ->setPassword($password)
            ->setDeny(TRUE);

        $this->assertEquals(GranteeType::USR(), $ace->getGranteeType());
        $this->assertEquals($right, $ace->getRight());
        $this->assertSame($zimbraId, $ace->getZimbraId());
        $this->assertSame($displayName, $ace->getDisplayName());
        $this->assertSame($accessKey, $ace->getAccessKey());
        $this->assertSame($password, $ace->getPassword());
        $this->assertTrue($ace->getDeny());

        $xml = <<<EOT
<?xml version="1.0"?>
<result gt="usr" right="$right" zid="$zimbraId" d="$displayName" key="$accessKey" pw="$password" deny="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($ace, 'xml'));
        $this->assertEquals($ace, $this->serializer->deserialize($xml, AccountACEInfo::class, 'xml'));
    }
}
