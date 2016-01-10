<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\GranteeType;
use Zimbra\Mail\Struct\ActionGrantSelector;
use Zimbra\Mail\Struct\NewFolderSpecAcl;

/**
 * Testcase class for NewFolderSpecAcl.
 */
class NewFolderSpecAclTest extends ZimbraMailTestCase
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
        $acl = new NewFolderSpecAcl(
            array($grant)
        );
        $this->assertSame([$grant], $acl->getGrants()->all());
        $acl->addGrant($grant);
        $this->assertSame([$grant, $grant], $acl->getGrants()->all());
        $acl->getGrants()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<acl>'
                .'<grant perm="' . $rights . '" gt="' . GranteeType::USR() . '" zid="' . $zimbraId . '" d="' . $displayName . '" args="' . $args . '" pw="' . $password . '" key="' . $accessKey . '" />'
            .'</acl>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $acl);

        $array = array(
            'acl' => array(
                'grant' => array(
                    array(
                        'perm' => $rights,
                        'gt' => GranteeType::USR()->value(),
                        'zid' => $zimbraId,
                        'd' => $displayName,
                        'args' => $args,
                        'pw' => $password,
                        'key' => $accessKey,
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $acl->toArray());
    }
}
