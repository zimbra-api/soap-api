<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\Type;
use Zimbra\Enum\TagActionOp;
use Zimbra\Mail\Struct\Policy;
use Zimbra\Mail\Struct\RetentionPolicyKeep;
use Zimbra\Mail\Struct\RetentionPolicyPurge;
use Zimbra\Mail\Struct\RetentionPolicy;
use Zimbra\Mail\Struct\TagActionSelector;

/**
 * Testcase class for TagActionSelector.
 */
class TagActionSelectorTest extends ZimbraMailTestCase
{
    public function testTagActionSelector()
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
        $this->assertTrue($action->getOperation()->is('read'));
        $this->assertSame($retention, $action->getRetentionPolicy());

        $action = new TagActionSelector(
            NULL, TagActionOp::DELETE(), $id, $tcon, $tag, $folder, $rgb, $color, $name, $flags, $tags, $tagNames
        );
        $action->setOperation(TagActionOp::READ())
               ->setRetentionPolicy($retention);
        $this->assertTrue($action->getOperation()->is('read'));
        $this->assertSame($retention, $action->getRetentionPolicy());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<action op="' . TagActionOp::READ() . '" id="' . $id . '" tcon="' . $tcon . '" tag="' . $tag . '" l="' . $folder . '" rgb="' . $rgb . '" color="' . $color . '" name="' . $name . '" f="' . $flags . '" t="' . $tags . '" tn="' . $tagNames . '">'
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
        );
        $this->assertEquals($array, $action->toArray());
    }
}
