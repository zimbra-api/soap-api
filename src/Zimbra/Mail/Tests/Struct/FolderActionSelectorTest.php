<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\FolderActionOp;
use Zimbra\Enum\GranteeType;
use Zimbra\Enum\Type;
use Zimbra\Mail\Struct\FolderActionSelector;
use Zimbra\Mail\Struct\Policy;
use Zimbra\Mail\Struct\RetentionPolicyKeep;
use Zimbra\Mail\Struct\RetentionPolicyPurge;
use Zimbra\Mail\Struct\RetentionPolicy;
use Zimbra\Mail\Struct\ActionGrantSelector;
use Zimbra\Mail\Struct\FolderActionSelectorAcl;

/**
 * Testcase class for FolderActionSelector.
 */
class FolderActionSelectorTest extends ZimbraMailTestCase
{
    public function testFolderActionSelector()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $lifetime = $this->faker->word;

        $policy = new Policy(Type::SYSTEM(), $id, $name, $lifetime);
        $keep = new RetentionPolicyKeep([$policy]);

        $policy = new Policy(Type::USER(), $id, $name, $lifetime);
        $purge = new RetentionPolicyPurge(
            [$policy]
        );
        $retentionPolicy = new RetentionPolicy(
            $keep, $purge
        );

        $perm = $this->faker->word;
        $zid = $this->faker->uuid;
        $display = $this->faker->word;
        $args = $this->faker->word;
        $pw = $this->faker->word;
        $key = $this->faker->word;

        $grant = new ActionGrantSelector(
            $perm, GranteeType::USR(), $zid, $display, $args, $pw, $key
        );
        $acl = new FolderActionSelectorAcl([$grant]);

        $tcon = $this->faker->word;
        $tag = mt_rand(1, 100);
        $folder = $this->faker->word;
        $rgb = $this->faker->hexcolor;
        $color = mt_rand(1, 127);
        $flags = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;
        $url = $this->faker->word;
        $gt = $this->faker->word;
        $view = $this->faker->word;
        $numDays = mt_rand(1, 100);

        $action = new FolderActionSelector(
            FolderActionOp::READ(),
            $id,
            $tcon,
            $tag,
            $folder,
            $rgb,
            $color,
            $name,
            $flags,
            $tags,
            $tagNames,
            $grant,
            $acl,
            $retentionPolicy,
            true,
            $url,
            true,
            $zid,
            $gt,
            $view,
            $numDays
        );
        $this->assertTrue($action->getOperation()->is('read'));
        $this->assertSame($grant, $action->getGrant());
        $this->assertSame($acl, $action->getAcl());
        $this->assertSame($retentionPolicy, $action->getRetentionPolicy());
        $this->assertTrue($action->getRecursive());
        $this->assertSame($url, $action->getUrl());
        $this->assertTrue($action->getExcludeFreeBusy());
        $this->assertSame($zid, $action->getZimbraId());
        $this->assertSame($gt, $action->getGrantType());
        $this->assertSame($view, $action->getView());
        $this->assertSame($numDays, $action->getNumDays());

        $action->setOperation(FolderActionOp::READ())
               ->setGrant($grant)
               ->setAcl($acl)
               ->setRetentionPolicy($retentionPolicy)
               ->setRecursive(true)
               ->setUrl($url)
               ->setExcludeFreeBusy(true)
               ->setZimbraId($zid)
               ->setGrantType($gt)
               ->setView($view)
               ->setNumDays($numDays);
        $this->assertTrue($action->getOperation()->is('read'));
        $this->assertSame($grant, $action->getGrant());
        $this->assertSame($acl, $action->getAcl());
        $this->assertSame($retentionPolicy, $action->getRetentionPolicy());
        $this->assertTrue($action->getRecursive());
        $this->assertSame($url, $action->getUrl());
        $this->assertTrue($action->getExcludeFreeBusy());
        $this->assertSame($zid, $action->getZimbraId());
        $this->assertSame($gt, $action->getGrantType());
        $this->assertSame($view, $action->getView());
        $this->assertSame($numDays, $action->getNumDays());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<action op="' . FolderActionOp::READ() . '" id="' . $id . '" tcon="' . $tcon . '" tag="' . $tag . '" l="' . $folder . '" rgb="' . $rgb . '" color="' . $color . '" name="' . $name . '" f="' . $flags . '" t="' . $tags . '" tn="' . $tagNames . '" recursive="true" url="' . $url . '" excludeFreeBusy="true" zid="' . $zid . '" gt="' . $gt . '" view="' . $view . '" numDays="' . $numDays . '">'
                .'<grant perm="' . $perm . '" gt="' . GranteeType::USR() . '" zid="' . $zid . '" d="' . $display . '" args="' . $args . '" pw="' . $pw . '" key="' . $key . '" />'
                .'<acl>'
                    .'<grant perm="' . $perm . '" gt="' . GranteeType::USR() . '" zid="' . $zid . '" d="' . $display . '" args="' . $args . '" pw="' . $pw . '" key="' . $key . '" />'
                .'</acl>'
                .'<retentionPolicy>'
                    .'<keep>'
                        .'<policy type="' . Type::SYSTEM() . '" id="' . $id . '" name="' . $name . '" lifetime="' . $lifetime . '" />'
                    .'</keep>'
                    .'<purge>'
                        .'<policy type="' . Type::USER() . '" id="' . $id . '" name="' . $name . '" lifetime="' . $lifetime . '" />'
                    .'</purge>'
                .'</retentionPolicy>'
            .'</action>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $action);

        $array = array(
            'action' => array(
                'op' => FolderActionOp::READ()->value(),
                'id' => $id,
                'tcon' => $tcon,
                'tag' => $tag,
                'l' => $folder,
                'rgb' => $rgb,
                'color' => $color,
                'name' => $name,
                'f' => $flags,
                't' => $tags,
                'tn' => $tagNames,
                'recursive' => true,
                'url' => $url,
                'excludeFreeBusy' => true,
                'zid' => $zid,
                'gt' => $gt,
                'view' => $view,
                'numDays' => $numDays,
                'grant' => array(
                    'perm' => $perm,
                    'gt' => GranteeType::USR()->value(),
                    'zid' => $zid,
                    'd' => $display,
                    'args' => $args,
                    'pw' => $pw,
                    'key' => $key,
                ),
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
                'retentionPolicy' => array(
                    'keep' => array(
                        'policy' => array(
                            array(
                                'type' => Type::SYSTEM()->value(),
                                'id' => $id,
                                'name' => $name,
                                'lifetime' => $lifetime,
                            ),
                        ),
                    ),
                    'purge' => array(
                        'policy' => array(
                            array(
                                'type' => Type::USER()->value(),
                                'id' => $id,
                                'name' => $name,
                                'lifetime' => $lifetime,
                            ),
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $action->toArray());
    }
}
