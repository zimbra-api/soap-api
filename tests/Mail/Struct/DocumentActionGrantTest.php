<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Common\Enum\{ActionGrantRight, GranteeType};
use Zimbra\Mail\Struct\DocumentActionGrant;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DocumentActionGrant.
 */
class DocumentActionGrantTest extends ZimbraTestCase
{
    public function testDocumentActionGrant()
    {
        $rights = implode(',', [ActionGrantRight::READ(), ActionGrantRight::WRITE()]);
        $grantType = GranteeType::USR();
        $expiry = $this->faker->randomNumber;
        $zimbraId = $this->faker->uuid;
        $displayName = $this->faker->name;
        $args = $this->faker->word;
        $password = $this->faker->word;
        $accessKey = $this->faker->word;

        $grant = new DocumentActionGrant(
            $rights, $grantType, $expiry, $zimbraId, $displayName, $args, $password, $accessKey
        );
        $this->assertSame($rights, $grant->getRights());
        $this->assertSame($grantType, $grant->getGrantType());
        $this->assertSame($expiry, $grant->getExpiry());
        $this->assertSame($zimbraId, $grant->getZimbraId());
        $this->assertSame($displayName, $grant->getDisplayName());
        $this->assertSame($args, $grant->getArgs());
        $this->assertSame($password, $grant->getPassword());
        $this->assertSame($accessKey, $grant->getAccessKey());

        $grant = new DocumentActionGrant();
        $grant->setRights($rights)
            ->setGrantType($grantType)
            ->setExpiry($expiry)
            ->setZimbraId($zimbraId)
            ->setDisplayName($displayName)
            ->setArgs($args)
            ->setPassword($password)
            ->setAccessKey($accessKey);
        $this->assertSame($rights, $grant->getRights());
        $this->assertSame($grantType, $grant->getGrantType());
        $this->assertSame($expiry, $grant->getExpiry());
        $this->assertSame($zimbraId, $grant->getZimbraId());
        $this->assertSame($displayName, $grant->getDisplayName());
        $this->assertSame($args, $grant->getArgs());
        $this->assertSame($password, $grant->getPassword());
        $this->assertSame($accessKey, $grant->getAccessKey());

        $xml = <<<EOT
<?xml version="1.0"?>
<result perm="$rights" gt="usr" expiry="$expiry" zid="$zimbraId" d="$displayName" args="$args" pw="$password" key="$accessKey" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($grant, 'xml'));
        $this->assertEquals($grant, $this->serializer->deserialize($xml, DocumentActionGrant::class, 'xml'));
    }
}
