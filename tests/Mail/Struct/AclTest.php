<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\{ActionGrantRight, GrantGranteeType};
use Zimbra\Mail\Struct\{Acl, Grant};
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

        $perm = implode(',', [ActionGrantRight::READ, ActionGrantRight::WRITE]);
        $granteeType = GrantGranteeType::USR;
        $granteeId = $this->faker->uuid;
        $expiry = $this->faker->unixTime;
        $granteeName = $this->faker->name;
        $guestPassword = $this->faker->word;
        $accessKey = $this->faker->word;

        $grant = new Grant(
            $perm, $granteeType, $granteeId, $expiry, $granteeName, $guestPassword, $accessKey
        );

        $acl = new StubAcl(
            $internalGrantExpiry, $guestGrantExpiry, [$grant]
        );
        $this->assertSame($internalGrantExpiry, $acl->getInternalGrantExpiry());
        $this->assertSame($guestGrantExpiry, $acl->getGuestGrantExpiry());
        $this->assertSame([$grant], $acl->getGrants());

        $acl = new StubAcl();
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
<result internalGrantExpiry="$internalGrantExpiry" guestGrantExpiry="$guestGrantExpiry" xmlns:urn="urn:zimbraMail">
    <urn:grant perm="$perm" gt="usr" zid="$granteeId" expiry="$expiry" d="$granteeName" pw="$guestPassword" key="$accessKey" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($acl, 'xml'));
        $this->assertEquals($acl, $this->serializer->deserialize($xml, StubAcl::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraMail', prefix: "urn")]
class StubAcl extends Acl
{
}
