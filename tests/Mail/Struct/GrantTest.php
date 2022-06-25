<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\Grant;
use Zimbra\Common\Enum\{ActionGrantRight, GrantGranteeType};
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for Grant.
 */
class GrantTest extends ZimbraTestCase
{
    public function testGrant()
    {
        $perm = implode(',', [ActionGrantRight::READ(), ActionGrantRight::WRITE()]);
        $granteeType = GrantGranteeType::USR();
        $granteeId = $this->faker->uuid;
        $expiry = $this->faker->unixTime;
        $granteeName = $this->faker->name;
        $guestPassword = $this->faker->word;
        $accessKey = $this->faker->word;

        $grant = new Grant(
            $perm, $granteeType, $granteeId, $expiry, $granteeName, $guestPassword, $accessKey
        );
        $this->assertSame($perm, $grant->getPerm());
        $this->assertSame($granteeType, $grant->getGranteeType());
        $this->assertSame($granteeId, $grant->getGranteeId());
        $this->assertSame($expiry, $grant->getExpiry());
        $this->assertSame($granteeName, $grant->getGranteeName());
        $this->assertSame($guestPassword, $grant->getGuestPassword());
        $this->assertSame($accessKey, $grant->getAccessKey());

        $grant = new Grant('', GrantGranteeType::ALL(), '');
        $grant->setPerm($perm)
            ->setGranteeType($granteeType)
            ->setGranteeId($granteeId)
            ->setExpiry($expiry)
            ->setGranteeName($granteeName)
            ->setGuestPassword($guestPassword)
            ->setAccessKey($accessKey);
        $this->assertSame($perm, $grant->getPerm());
        $this->assertSame($granteeType, $grant->getGranteeType());
        $this->assertSame($granteeId, $grant->getGranteeId());
        $this->assertSame($expiry, $grant->getExpiry());
        $this->assertSame($granteeName, $grant->getGranteeName());
        $this->assertSame($guestPassword, $grant->getGuestPassword());
        $this->assertSame($accessKey, $grant->getAccessKey());

        $xml = <<<EOT
<?xml version="1.0"?>
<result perm="$perm" gt="usr" zid="$granteeId" expiry="$expiry" d="$granteeName" pw="$guestPassword" key="$accessKey" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($grant, 'xml'));
        $this->assertEquals($grant, $this->serializer->deserialize($xml, Grant::class, 'xml'));
    }
}
