<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\Type;
use Zimbra\Mail\Struct\Policy;
use Zimbra\Mail\Struct\RetentionPolicyPurge;

/**
 * Testcase class for RetentionPolicyPurge.
 */
class RetentionPolicyPurgeTest extends ZimbraMailTestCase
{
    public function testRetentionPolicyPurge()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $lifetime = $this->faker->word;

        $policy = new Policy(Type::SYSTEM(), $id, $name, $lifetime);
        $purge = new RetentionPolicyPurge([$policy]);
        $this->assertSame([$policy], $purge->getPolicies()->all());
        $purge->addPolicy($policy);
        $this->assertSame([$policy, $policy], $purge->getPolicies()->all());
        $purge = new RetentionPolicyPurge([$policy]);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<purge>'
                .'<policy type="' . Type::SYSTEM() . '" id="' . $id . '" name="' . $name . '" lifetime="' . $lifetime . '" />'
            .'</purge>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $purge);

        $array = array(
            'purge' => array(
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
        $this->assertEquals($array, $purge->toArray());
    }
}
