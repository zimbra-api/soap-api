<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\Type;
use Zimbra\Enum\TagActionOp;
use Zimbra\Mail\Request\TagAction;
use Zimbra\Mail\Struct\Policy;
use Zimbra\Mail\Struct\RetentionPolicyKeep;
use Zimbra\Mail\Struct\RetentionPolicyPurge;
use Zimbra\Mail\Struct\RetentionPolicy;
use Zimbra\Mail\Struct\TagActionSelector;

/**
 * Testcase class for TagAction.
 */
class TagActionTest extends ZimbraMailApiTestCase
{
    public function testTagActionRequest()
    {
        $id = $this->faker->uuid;
        $tcon = $this->faker->word;
        $tag = mt_rand(1, 100);
        $folder = $this->faker->word;
        $rgb = $this->faker->hexcolor;
        $color = mt_rand(1, 127);
        $name = $this->faker->word;
        $flags = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;
        $lifetime = $this->faker->word;

        $policy = new Policy(Type::SYSTEM(), $id, $name, $lifetime);
        $keep = new RetentionPolicyKeep(array($policy));
        $policy = new Policy(Type::USER(), $id, $name, $lifetime);
        $purge = new RetentionPolicyPurge(array($policy));
        $retention = new RetentionPolicy(
            $keep, $purge
        );
        $action = new TagActionSelector(
            $retention, TagActionOp::READ(), $id, $tcon, $tag, $folder, $rgb, $color, $name, $flags, $tags, $tagNames
        );

        $req = new TagAction(
            $action
        );
        $this->assertSame($action, $req->getAction());

        $req = new TagAction(
            new TagActionSelector($retention, TagActionOp::READ()), '', '', '', '', '', '', '', '', '', ''
        );
        $req->setAction($action);
        $this->assertSame($action, $req->getAction());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<TagActionRequest>'
                .'<action op="' . TagActionOp::READ() . '" id="' . $id . '" tcon="' . $tcon . '" tag="' . $tag . '" l="' . $folder . '" rgb="' . $rgb . '" color="' . $color . '" name="' . $name . '" f="' . $flags . '" t="' . $tags . '" tn="' . $tagNames . '">'
                    .'<retentionPolicy>'
                        .'<keep>'
                            .'<policy type="' . Type::SYSTEM() . '" id="' . $id . '" name="' . $name . '" lifetime="' . $lifetime . '" />'
                        .'</keep>'
                        .'<purge>'
                            .'<policy type="' . Type::USER() . '" id="' . $id . '" name="' . $name . '" lifetime="' . $lifetime . '" />'
                        .'</purge>'
                    .'</retentionPolicy>'
                .'</action>'
            .'</TagActionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'TagActionRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'action' => array(
                    'op' => TagActionOp::READ()->value(),
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

    public function testTagActionApi()
    {
        $id = $this->faker->uuid;
        $tcon = $this->faker->word;
        $tag = mt_rand(1, 100);
        $folder = $this->faker->word;
        $rgb = $this->faker->hexcolor;
        $color = mt_rand(1, 127);
        $name = $this->faker->word;
        $flags = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;
        $lifetime = $this->faker->word;

        $policy = new Policy(Type::SYSTEM(), $id, $name, $lifetime);
        $keep = new RetentionPolicyKeep(array($policy));
        $policy = new Policy(Type::USER(), $id, $name, $lifetime);
        $purge = new RetentionPolicyPurge(array($policy));
        $retention = new RetentionPolicy(
            $keep, $purge
        );
        $action = new TagActionSelector(
            $retention, TagActionOp::READ(), $id, $tcon, $tag, $folder, $rgb, $color, $name, $flags, $tags, $tagNames
        );
        $this->api->tagAction(
            $action
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:TagActionRequest>'
                        .'<urn1:action op="' . TagActionOp::READ() . '" id="' . $id . '" tcon="' . $tcon . '" tag="' . $tag . '" l="' . $folder . '" rgb="' . $rgb . '" color="' . $color . '" name="' . $name . '" f="' . $flags . '" t="' . $tags . '" tn="' . $tagNames . '">'
                            .'<urn1:retentionPolicy>'
                                .'<urn1:keep>'
                                    .'<urn1:policy type="' . Type::SYSTEM() . '" id="' . $id . '" name="' . $name . '" lifetime="' . $lifetime . '" />'
                                .'</urn1:keep>'
                                .'<urn1:purge>'
                                    .'<urn1:policy type="' . Type::USER() . '" id="' . $id . '" name="' . $name . '" lifetime="' . $lifetime . '" />'
                                .'</urn1:purge>'
                            .'</urn1:retentionPolicy>'
                        .'</urn1:action>'
                    .'</urn1:TagActionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
