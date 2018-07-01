<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\Policy;
use Zimbra\Admin\Struct\PolicyHolder;
use Zimbra\Enum\Type;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for PolicyHolder.
 */
class PolicyHolderTest extends ZimbraStructTestCase
{
    public function testPolicyHolder()
    {
        $id = $this->faker->word;
        $name = $this->faker->word;
        $lifetime = $this->faker->word;
        $policy = new Policy(Type::SYSTEM()->value(), $id, $name, $lifetime);

        $holder = new PolicyHolder($policy);
        $this->assertSame($policy, $holder->getPolicy());

        $holder = new PolicyHolder();
        $holder->setPolicy($policy);
        $this->assertSame($policy, $holder->getPolicy());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<holder xmlns:urn="urn:zimbraMail">'
                . '<urn:policy type="' . Type::SYSTEM() . '" id="' . $id . '" name="' . $name . '" lifetime="' . $lifetime . '" />'
            . '</holder>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($holder, 'xml'));

        $holder = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\PolicyHolder', 'xml');
        $policy = $holder->getPolicy();

        $this->assertSame(Type::SYSTEM()->value(), $policy->getType());
        $this->assertSame($id, $policy->getId());
        $this->assertSame($name, $policy->getName());
        $this->assertSame($lifetime, $policy->getLifetime());
    }
}
