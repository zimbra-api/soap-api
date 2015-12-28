<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\AdminCreateWaitSet;
use Zimbra\Enum\InterestType;
use Zimbra\Struct\WaitSetAddSpec;
use Zimbra\Struct\WaitSetSpec;

/**
 * Testcase class for AdminCreateWaitSet.
 */
class AdminCreateWaitSetTest extends ZimbraAdminApiTestCase
{
    public function testAdminCreateWaitSetRequest()
    {
        $name = $this->faker->word;
        $id = $this->faker->word;
        $token = $this->faker->word;

        $a = new WaitSetAddSpec(
            $name, $id, $token, [InterestType::MESSAGES(), InterestType::CONTACTS()]
        );
        $add = new WaitSetSpec([$a]);
        $req = new AdminCreateWaitSet(
            $add, [InterestType::FOLDERS()], false
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('f', $req->getDefaultInterests());
        $this->assertSame($add, $req->getAccounts());
        $this->assertFalse($req->getAllAccounts());

        $req->addDefaultInterest(InterestType::MESSAGES())
            ->setAccounts($add)
            ->setAllAccounts(true);
        $this->assertSame('f,m', $req->getDefaultInterests());
        $this->assertSame($add, $req->getAccounts());
        $this->assertTrue($req->getAllAccounts());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AdminCreateWaitSetRequest defTypes="f,m" allAccounts="true">'
                . '<add>'
                    . '<a name="' . $name . '" id="' . $id . '" token="' . $token . '" types="m,c" />'
                . '</add>'
            . '</AdminCreateWaitSetRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'AdminCreateWaitSetRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'defTypes' => 'f,m',
                'allAccounts' => true,
                'add' => [
                    'a' => [
                        [
                            'name' => $name,
                            'id' => $id,
                            'token' => $token,
                            'types' => 'm,c',
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testAdminCreateWaitSetApi()
    {
        $name = $this->faker->word;
        $id = $this->faker->word;
        $token = $this->faker->word;

        $a = new WaitSetAddSpec(
            $name, $id, $token, [InterestType::MESSAGES(), InterestType::CONTACTS()]
        );
        $add = new WaitSetSpec([$a]);

        $this->api->adminCreateWaitSet(
            $add, [InterestType::FOLDERS(), InterestType::MESSAGES()], true
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:AdminCreateWaitSetRequest defTypes="f,m" allAccounts="true">'
                        . '<urn1:add>'
                            . '<urn1:a name="' . $name . '" id="' . $id . '" token="' . $token . '" types="m,c" />'
                        . '</urn1:add>'
                    . '</urn1:AdminCreateWaitSetRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
