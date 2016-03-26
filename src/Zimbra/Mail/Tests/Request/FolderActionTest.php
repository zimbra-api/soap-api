<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\FolderActionOp;
use Zimbra\Enum\GranteeType;
use Zimbra\Enum\Type;
use Zimbra\Mail\Request\FolderAction;
use Zimbra\Mail\Struct\FolderActionSelector;
use Zimbra\Mail\Struct\Policy;
use Zimbra\Mail\Struct\RetentionPolicyKeep;
use Zimbra\Mail\Struct\RetentionPolicyPurge;
use Zimbra\Mail\Struct\RetentionPolicy;
use Zimbra\Mail\Struct\ActionGrantSelector;
use Zimbra\Mail\Struct\FolderActionSelectorAcl;

/**
 * Testcase class for FolderAction.
 */
class FolderActionTest extends ZimbraMailApiTestCase
{
    public function testFolderActionRequest()
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

        $req = new \Zimbra\Mail\Request\FolderAction(
            $action
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($action, $req->getAction());

        $req->setAction($action);
        $this->assertSame($action, $req->getAction());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<FolderActionRequest>'
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
                .'</action>'
            .'</FolderActionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'FolderActionRequest' => array(
                '_jsns' => 'urn:zimbraMail',
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
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testFolderActionApi()
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

        $this->api->folderAction(
            $action
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:FolderActionRequest>'
                        .'<urn1:action op="' . FolderActionOp::READ() . '" id="' . $id . '" tcon="' . $tcon . '" tag="' . $tag . '" l="' . $folder . '" rgb="' . $rgb . '" color="' . $color . '" name="' . $name . '" f="' . $flags . '" t="' . $tags . '" tn="' . $tagNames . '" recursive="true" url="' . $url . '" excludeFreeBusy="true" zid="' . $zid . '" gt="' . $gt . '" view="' . $view . '" numDays="' . $numDays . '">'
                            .'<urn1:grant perm="' . $perm . '" gt="' . GranteeType::USR() . '" zid="' . $zid . '" d="' . $display . '" args="' . $args . '" pw="' . $pw . '" key="' . $key . '" />'
                            .'<urn1:acl>'
                                .'<urn1:grant perm="' . $perm . '" gt="' . GranteeType::USR() . '" zid="' . $zid . '" d="' . $display . '" args="' . $args . '" pw="' . $pw . '" key="' . $key . '" />'
                            .'</urn1:acl>'
                            .'<urn1:retentionPolicy>'
                                .'<urn1:keep>'
                                    .'<urn1:policy type="' . Type::SYSTEM() . '" id="' . $id . '" name="' . $name . '" lifetime="' . $lifetime . '" />'
                                .'</urn1:keep>'
                                .'<urn1:purge>'
                                    .'<urn1:policy type="' . Type::USER() . '" id="' . $id . '" name="' . $name . '" lifetime="' . $lifetime . '" />'
                                .'</urn1:purge>'
                            .'</urn1:retentionPolicy>'
                        .'</urn1:action>'
                    .'</urn1:FolderActionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
