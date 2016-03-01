<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Voice\Struct\StorePrincipalSpec;

/**
 * Testcase class for StorePrincipalSpec.
 */
class StorePrincipalSpecTest extends ZimbraStructTestCase
{
    public function testStorePrincipalSpec()
    {
        $id = $this->faker->word;
        $name = $this->faker->word;
        $accountNumber = $this->faker->word;

        $storeprincipal = new StorePrincipalSpec(
            $id, $name, $accountNumber
        );
        $this->assertSame($id, $storeprincipal->getId());
        $this->assertSame($name, $storeprincipal->getName());
        $this->assertSame($accountNumber, $storeprincipal->getAccountNumber());
        $storeprincipal->setId($id)
                       ->setName($name)
                       ->setAccountNumber($accountNumber);
        $this->assertSame($id, $storeprincipal->getId());
        $this->assertSame($name, $storeprincipal->getName());
        $this->assertSame($accountNumber, $storeprincipal->getAccountNumber());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<storeprincipal id="' . $id . '" name="' . $name . '" accountNumber="' . $accountNumber . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $storeprincipal);

        $array = [
            'storeprincipal' => [
                'id' => $id,
                'name' => $name,
                'accountNumber' => $accountNumber,
            ],
        ];
        $this->assertEquals($array, $storeprincipal->toArray());
    }
}
