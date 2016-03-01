<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\GranteeType;
use Zimbra\Mail\Struct\ActionGrantSelector;
use Zimbra\Mail\Struct\FolderActionSelectorAcl;

/**
 * Testcase class for FolderActionSelectorAcl.
 */
class FolderActionSelectorAclTest extends ZimbraMailTestCase
{
    public function testFolderActionSelectorAcl()
    {
        $perm = $this->faker->word;
        $zid = $this->faker->word;
        $display = $this->faker->word;
        $args = $this->faker->word;
        $pw = $this->faker->word;
        $key = $this->faker->word;

        $grant = new ActionGrantSelector(
            $perm, GranteeType::USR(), $zid, $display, $args, $pw, $key
        );
        $acl = new FolderActionSelectorAcl([$grant]);

        $this->assertSame([$grant], $acl->getGrants()->all());
        $acl->addGrant($grant);
        $this->assertSame([$grant, $grant], $acl->getGrants()->all());
        $acl->getGrants()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<acl>'
                .'<grant perm="' . $perm . '" gt="' . GranteeType::USR() . '" zid="' . $zid . '" d="' . $display . '" args="' . $args . '" pw="' . $pw . '" key="' . $key . '" />'
            .'</acl>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $acl);

        $array = array(
            'acl' => array(
                'grant' => array(
                    array(
                        'perm' => $perm,
                        'gt' => GranteeType::USR()->value(),
                        'zid' => $zid,
                        'd' => $display,
                        'args' => $args,
                        'pw' => $pw,
                        'key' => $key,
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $acl->toArray());
    }
}
