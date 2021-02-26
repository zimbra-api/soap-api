<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\Acl;
use Zimbra\Mail\Struct\Grant;
use Zimbra\Enum\{ActionGrantRight, GrantGranteeType};
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for Acl.
 */
class AclTest extends ZimbraTestCase
{
    public function testAcl()
    {
        $internalGrantExpiry = $this->faker->randomNumber;
        $guestGrantExpiry = $this->faker->randomNumber;

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

        $acl = new Acl(
            $internalGrantExpiry, $guestGrantExpiry, [$grant]
        );
        $this->assertSame($internalGrantExpiry, $acl->getInternalGrantExpiry());
        $this->assertSame($guestGrantExpiry, $acl->getGuestGrantExpiry());
        $this->assertSame([$grant], $acl->getGrants());

        $acl = new Acl();
        $acl->setInternalGrantExpiry($internalGrantExpiry)
            ->setGuestGrantExpiry($guestGrantExpiry)
            ->setGrants([$grant])
            ->addGrant($grant);
        $this->assertSame($internalGrantExpiry, $acl->getInternalGrantExpiry());
        $this->assertSame($guestGrantExpiry, $acl->getGuestGrantExpiry());
        $this->assertSame([$grant, $grant], $acl->getGrants());
        $acl->setGrants([$grant]);

        $xml = <<<EOT
<?xml version="1.0"?>
<acl internalGrantExpiry="$internalGrantExpiry" guestGrantExpiry="$guestGrantExpiry">
    <grant perm="$perm" gt="usr" zid="$granteeId" expiry="$expiry" d="$granteeName" pw="$guestPassword" key="$accessKey" />
</acl>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($acl, 'xml'));
        $this->assertEquals($acl, $this->serializer->deserialize($xml, Acl::class, 'xml'));

        $json = json_encode([
            'internalGrantExpiry' => $internalGrantExpiry,
            'guestGrantExpiry' => $guestGrantExpiry,
            'grant' => [
                [
                    'perm' => $perm,
                    'gt' => 'usr',
                    'zid' => $granteeId,
                    'expiry' => $expiry,
                    'd' => $granteeName,
                    'pw' => $guestPassword,
                    'key' => $accessKey,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($acl, 'json'));
        $this->assertEquals($acl, $this->serializer->deserialize($json, Acl::class, 'json'));
    }
}
