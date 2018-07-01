<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\Policy;
use Zimbra\Enum\Type;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for Policy.
 */
class PolicyTest extends ZimbraStructTestCase
{
    public function testPolicy()
    {
        $id = $this->faker->word;
        $name = $this->faker->word;
        $lifetime = $this->faker->word;

        $policy = new Policy(Type::SYSTEM()->value(), $id, $name, $lifetime);
        $this->assertSame(Type::SYSTEM()->value(), $policy->getType());
        $this->assertSame($id, $policy->getId());
        $this->assertSame($name, $policy->getName());
        $this->assertSame($lifetime, $policy->getLifetime());

        $policy = new Policy();
        $policy->setType(Type::USER()->value())
               ->setId($id)
               ->setName($name)
               ->setLifetime($lifetime);
        $this->assertSame(Type::USER()->value(), $policy->getType());
        $this->assertSame($id, $policy->getId());
        $this->assertSame($name, $policy->getName());
        $this->assertSame($lifetime, $policy->getLifetime());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<policy type="' . Type::USER() . '" id="' . $id . '" name="' . $name . '" lifetime="' . $lifetime . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($policy, 'xml'));

        $policy = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\Policy', 'xml');
        $this->assertSame(Type::USER()->value(), $policy->getType());
        $this->assertSame($id, $policy->getId());
        $this->assertSame($name, $policy->getName());
        $this->assertSame($lifetime, $policy->getLifetime());
    }
}
