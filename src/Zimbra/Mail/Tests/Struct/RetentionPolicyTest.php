<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\Type;
use Zimbra\Mail\Struct\Policy;
use Zimbra\Mail\Struct\RetentionPolicyKeep;
use Zimbra\Mail\Struct\RetentionPolicyPurge;
use Zimbra\Mail\Struct\RetentionPolicy;

/**
 * Testcase class for RetentionPolicy.
 */
class RetentionPolicyTest extends ZimbraMailTestCase
{
    public function testRetentionPolicy()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $lifetime = $this->faker->word;

        $policy = new Policy(Type::SYSTEM(), $id, $name, $lifetime);
        $keep = new RetentionPolicyKeep(array($policy));
        $policy = new Policy(Type::USER(), $id, $name, $lifetime);
        $purge = new RetentionPolicyPurge(array($policy));

        $retention = new RetentionPolicy(
            $keep, $purge
        );
        $this->assertSame($keep, $retention->getKeepPolicy());
        $this->assertSame($purge, $retention->getPurgePolicy());

        $retention->setKeepPolicy($keep)
                  ->setPurgePolicy($purge);
        $this->assertSame($keep, $retention->getKeepPolicy());
        $this->assertSame($purge, $retention->getPurgePolicy());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<retentionPolicy>'
                .'<keep>'
                    .'<policy type="' . Type::SYSTEM() . '" id="' . $id . '" name="' . $name . '" lifetime="' . $lifetime . '" />'
                .'</keep>'
                .'<purge>'
                    .'<policy type="' . Type::USER() . '" id="' . $id . '" name="' . $name . '" lifetime="' . $lifetime . '" />'
                .'</purge>'
            .'</retentionPolicy>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $retention);

        $array = array(
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
        );
        $this->assertEquals($array, $retention->toArray());
    }
}
