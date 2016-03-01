<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\Policy;
use Zimbra\Enum\Type;

/**
 * Testcase class for Policy.
 */
class PolicyTest extends ZimbraAdminTestCase
{
    public function testPolicy()
    {
        $id = $this->faker->word;
        $name = $this->faker->word;
        $lifetime = $this->faker->word;

        $policy = new Policy(Type::SYSTEM(), $id, $name, $lifetime);
        $this->assertSame('system', $policy->getType()->value());
        $this->assertSame($id, $policy->getId());
        $this->assertSame($name, $policy->getName());
        $this->assertSame($lifetime, $policy->getLifetime());

        $policy->setType(Type::USER())
               ->setId($id)
               ->setName($name)
               ->setLifetime($lifetime);
        $this->assertSame('user', $policy->getType()->value());
        $this->assertSame($id, $policy->getId());
        $this->assertSame($name, $policy->getName());
        $this->assertSame($lifetime, $policy->getLifetime());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<policy type="' . Type::USER() . '" id="' . $id . '" name="' . $name . '" lifetime="' . $lifetime . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $policy);

        $array = [
            'policy' => [
                '_jsns' => 'urn:zimbraMail',
                'type' => Type::USER()->value(),
                'id' => $id,
                'name' => $name,
                'lifetime' => $lifetime,
            ],
        ];
        $this->assertEquals($array, $policy->toArray());
    }
}
