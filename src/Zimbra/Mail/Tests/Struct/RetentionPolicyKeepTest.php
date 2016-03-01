<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\Type;
use Zimbra\Mail\Struct\Policy;
use Zimbra\Mail\Struct\RetentionPolicyKeep;

/**
 * Testcase class for RetentionPolicyKeep.
 */
class RetentionPolicyKeepTest extends ZimbraMailTestCase
{
    public function testRetentionPolicyKeep()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $lifetime = $this->faker->word;

        $policy = new Policy(Type::SYSTEM(), $id, $name, $lifetime);
        $keep = new RetentionPolicyKeep([$policy]);
        $this->assertSame([$policy], $keep->getPolicies()->all());
        $keep->addPolicy($policy);
        $this->assertSame([$policy, $policy], $keep->getPolicies()->all());
        $keep = new RetentionPolicyKeep([$policy]);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<keep>'
                .'<policy type="' . Type::SYSTEM() . '" id="' . $id . '" name="' . $name . '" lifetime="' . $lifetime . '" />'
            .'</keep>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $keep);

        $array = array(
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
        );
        $this->assertEquals($array, $keep->toArray());
    }
}
