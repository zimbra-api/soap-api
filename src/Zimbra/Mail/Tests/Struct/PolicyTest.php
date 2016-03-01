<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\Type;
use Zimbra\Mail\Struct\Policy;

/**
 * Testcase class for Policy.
 */
class PolicyTest extends ZimbraMailTestCase
{
    public function testPolicy()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $lifetime = $this->faker->word;

        $policy = new Policy(Type::SYSTEM(), $id, $name, $lifetime);
        $this->assertSame('system', $policy->getType()->value());
        $this->assertSame($id, $policy->getId());
        $this->assertSame($name, $policy->getName());
        $this->assertSame($lifetime, $policy->getLifetime());

        $policy = new Policy();
        $policy->setType(Type::USER())
               ->setId($id)
               ->setName($name)
               ->setLifetime($lifetime);
        $this->assertSame('user', $policy->getType()->value());
        $this->assertSame($id, $policy->getId());
        $this->assertSame($name, $policy->getName());
        $this->assertSame($lifetime, $policy->getLifetime());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<policy type="' . Type::USER() . '" id="' . $id . '" name="' . $name . '" lifetime="' . $lifetime . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $policy);

        $array = array(
            'policy' => array(
                'type' => Type::USER()->value(),
                'id' => $id,
                'name' => $name,
                'lifetime' => $lifetime,
            ),
        );
        $this->assertEquals($array, $policy->toArray());
    }
}
