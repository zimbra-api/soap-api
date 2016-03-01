<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\Policy;
use Zimbra\Admin\Struct\PolicyHolder;
use Zimbra\Enum\Type;

/**
 * Testcase class for PolicyHolder.
 */
class PolicyHolderTest extends ZimbraAdminTestCase
{
    public function testPolicyHolder()
    {
        $id = $this->faker->word;
        $name = $this->faker->word;
        $lifetime = $this->faker->word;
        $policy = new Policy(Type::SYSTEM(), $id, $name, $lifetime);

        $holder = new PolicyHolder($policy);
        $this->assertSame($policy, $holder->getPolicy());
        $holder->setPolicy($policy);
        $this->assertSame($policy, $holder->getPolicy());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<holder>'
                . '<policy xmlns="urn:zimbraMail" type="' . Type::SYSTEM() . '" id="' . $id . '" name="' . $name . '" lifetime="' . $lifetime . '" />'
            . '</holder>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $holder);

        $array = [
            'holder' => [
                'policy' => [
                    '_jsns' => 'urn:zimbraMail',
                    'type' => Type::SYSTEM()->value(),
                    'id' => $id,
                    'name' => $name,
                    'lifetime' => $lifetime,
                ],
            ],
        ];
        $this->assertEquals($array, $holder->toArray());
    }
}
