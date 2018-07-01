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
        $interests = [
            InterestType::FOLDERS()->value(),
            InterestType::MESSAGES()->value(),
        ];

        $a = new WaitSetAddSpec($name, $id, $token, implode(',', $interests));
        $add = new WaitSetSpec([$a]);
        $this->assertSame([$a], $add->getAccounts());
        $add->addAccount($a);
        $this->assertSame([$a, $a], $add->getAccounts());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<add>'
                .'<a name="' . $name . '" id="' . $id . '" token="' . $token . '" types="f,m" />'
                .'<a name="' . $name . '" id="' . $id . '" token="' . $token . '" types="f,m" />'
            .'</add>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($add, 'xml'));

        $add = $this->serializer->deserialize($xml, 'Zimbra\Struct\WaitSetSpec', 'xml');
        foreach ($add->getAccounts() as $waitSet) {
            $this->assertSame($name, $waitSet->getName());
            $this->assertSame($id, $waitSet->getId());
            $this->assertSame($token, $waitSet->getToken());
            $this->assertSame('f,m', $waitSet->getInterests());
        }
    }
}
