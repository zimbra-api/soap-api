<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Enum\InterestType;
use Zimbra\Struct\WaitSetAddSpec;
use Zimbra\Struct\WaitSetSpec;

/**
 * Testcase class for WaitSetSpec.
 */
class WaitSetSpecTest extends ZimbraStructTestCase
{
    public function testWaitSetSpec()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $token = $this->faker->word;
        $a = new WaitSetAddSpec($name, $id, $token, [InterestType::FOLDERS(), InterestType::MESSAGES()]);
        $add = new WaitSetSpec([$a]);
        $this->assertSame([$a], $add->getAccounts()->all());
        $add->addAccount($a);
        $this->assertSame([$a, $a], $add->getAccounts()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<add>'
                .'<a name="' . $name . '" id="' . $id . '" token="' . $token . '" types="f,m" />'
                .'<a name="' . $name . '" id="' . $id . '" token="' . $token . '" types="f,m" />'
            .'</add>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $add);

        $array = [
            'add' => [
                'a' => [
                    [
                        'name' => $name,
                        'id' => $id,
                        'token' => $token,
                        'types' => 'f,m',
                    ],
                    [
                        'name' => $name,
                        'id' => $id,
                        'token' => $token,
                        'types' => 'f,m',
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $add->toArray());
    }
}
