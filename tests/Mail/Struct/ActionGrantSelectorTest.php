<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\ActionGrantSelector;
use Zimbra\Enum\{ActionGrantRight, GranteeType};
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ActionGrantSelector.
 */
class ActionGrantSelectorTest extends ZimbraTestCase
{
    public function testActionGrantSelector()
    {
        $rights = implode(',', [ActionGrantRight::READ(), ActionGrantRight::WRITE()]);
        $grantType = GranteeType::USR();
        $zimbraId = $this->faker->uuid;
        $displayName = $this->faker->name;
        $args = $this->faker->word;
        $password = $this->faker->word;
        $accessKey = $this->faker->word;

        $grant = new ActionGrantSelector(
            $rights, $grantType, $zimbraId, $displayName, $args, $password, $accessKey
        );
        $this->assertSame($rights, $grant->getRights());
        $this->assertSame($grantType, $grant->getGrantType());
        $this->assertSame($zimbraId, $grant->getZimbraId());
        $this->assertSame($displayName, $grant->getDisplayName());
        $this->assertSame($args, $grant->getArgs());
        $this->assertSame($password, $grant->getPassword());
        $this->assertSame($accessKey, $grant->getAccessKey());

        $grant = new ActionGrantSelector('', GranteeType::ALL());
        $grant->setRights($rights)
            ->setGrantType($grantType)
            ->setZimbraId($zimbraId)
            ->setDisplayName($displayName)
            ->setArgs($args)
            ->setPassword($password)
            ->setAccessKey($accessKey);
        $this->assertSame($rights, $grant->getRights());
        $this->assertSame($grantType, $grant->getGrantType());
        $this->assertSame($zimbraId, $grant->getZimbraId());
        $this->assertSame($displayName, $grant->getDisplayName());
        $this->assertSame($args, $grant->getArgs());
        $this->assertSame($password, $grant->getPassword());
        $this->assertSame($accessKey, $grant->getAccessKey());

        $xml = <<<EOT
<?xml version="1.0"?>
<grant perm="$rights" gt="usr" zid="$zimbraId" d="$displayName" args="$args" pw="$password" key="$accessKey" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($grant, 'xml'));
        $this->assertEquals($grant, $this->serializer->deserialize($xml, ActionGrantSelector::class, 'xml'));

        $json = json_encode([
            'perm' => $rights,
            'gt' => 'usr',
            'zid' => $zimbraId,
            'd' => $displayName,
            'args' => $args,
            'pw' => $password,
            'key' => $accessKey,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($grant, 'json'));
        $this->assertEquals($grant, $this->serializer->deserialize($json, ActionGrantSelector::class, 'json'));
    }
}
