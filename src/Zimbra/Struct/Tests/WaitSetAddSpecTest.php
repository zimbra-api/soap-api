<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Enum\InterestType;
use Zimbra\Struct\WaitSetAddSpec;

/**
 * Testcase class for WaitSetAddSpec.
 */
class WaitSetAddSpecTest extends ZimbraStructTestCase
{
    public function testWaitSetAddSpec()
    {
        $name = $this->faker->word;
        $id = $this->faker->word;
        $token = $this->faker->word;

        $waitSet = new WaitSetAddSpec($name, $id, $token, [InterestType::FOLDERS()]);
        $this->assertSame($name, $waitSet->getName());
        $this->assertSame($id, $waitSet->getId());
        $this->assertSame($token, $waitSet->getToken());
        $this->assertSame('f', $waitSet->getInterests());

        $waitSet->setName($name)
                ->setId($id)
                ->setToken($token)
                ->addInterest(InterestType::MESSAGES())
                ->addInterest(InterestType::CONTACTS());
        $this->assertSame($name, $waitSet->getName());
        $this->assertSame($id, $waitSet->getId());
        $this->assertSame($token, $waitSet->getToken());
        $this->assertSame('f,m,c', $waitSet->getInterests());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<a name="' . $name . '" id="' . $id . '" token="' . $token . '" types="f,m,c" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $waitSet);

        $array = [
            'a' => [
                'name' => $name,
                'id' => $id,
                'token' => $token,
                'types' => 'f,m,c',
            ],
        ];
        $this->assertEquals($array, $waitSet->toArray());
    }
}
