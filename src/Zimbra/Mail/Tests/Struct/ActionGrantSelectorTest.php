<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\GranteeType;
use Zimbra\Mail\Struct\ActionGrantSelector;

/**
 * Testcase class for ActionGrantSelector.
 */
class ActionGrantSelectorTest extends ZimbraMailTestCase
{
    public function testActionGrantSelector()
    {
        $rights = $this->faker->word;
        $zimbraId = $this->faker->uuid;
        $displayName = $this->faker->word;
        $args = $this->faker->word;
        $password = $this->faker->word;
        $accessKey = $this->faker->word;

        $grant = new ActionGrantSelector(
            $rights, GranteeType::USR(), $zimbraId, $displayName, $args, $password, $accessKey
        );

        $this->assertSame($rights, $grant->getRights());
        $this->assertTrue($grant->getGranteeType()->is('usr'));
        $this->assertSame($zimbraId, $grant->getZimbraId());
        $this->assertSame($displayName, $grant->getDisplayName());
        $this->assertSame($args, $grant->getArgs());
        $this->assertSame($password, $grant->getPassword());
        $this->assertSame($accessKey, $grant->getAccessKey());

        $grant->setRights($rights)
              ->setGranteeType(GranteeType::USR())
              ->setZimbraId($zimbraId)
              ->setDisplayName($displayName)
              ->setArgs($args)
              ->setPassword($password)
              ->setAccessKey($accessKey);
        $this->assertSame($rights, $grant->getRights());
        $this->assertTrue($grant->getGranteeType()->is('usr'));
        $this->assertSame($zimbraId, $grant->getZimbraId());
        $this->assertSame($displayName, $grant->getDisplayName());
        $this->assertSame($args, $grant->getArgs());
        $this->assertSame($password, $grant->getPassword());
        $this->assertSame($accessKey, $grant->getAccessKey());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<grant perm="' . $rights . '" gt="' . GranteeType::USR() . '" zid="' . $zimbraId . '" d="' . $displayName . '" args="' . $args . '" pw="' . $password . '" key="' . $accessKey . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $grant);

        $array = array(
            'grant' => array(
                'perm' => $rights,
                'gt' => GranteeType::USR()->value(),
                'zid' => $zimbraId,
                'd' => $displayName,
                'args' => $args,
                'pw' => $password,
                'key' => $accessKey,
            ),
        );
        $this->assertEquals($array, $grant->toArray());
    }
}
