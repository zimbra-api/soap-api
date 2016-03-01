<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\CreateAccount;
use Zimbra\Struct\KeyValuePair;

/**
 * Testcase class for CreateAccount.
 */
class CreateAccountTest extends ZimbraAdminApiTestCase
{
    public function testCreateAccountRequest()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->userName;
        $password = $this->faker->sha1;

        $attr = new KeyValuePair($key, $value);
        $req = new CreateAccount($name, $password, [$attr]);
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);

        $this->assertSame($name, $req->getName());
        $this->assertSame($password, $req->getPassword());

        $req->setName($name)
            ->setPassword($password);
        $this->assertSame($name, $req->getName());
        $this->assertSame($password, $req->getPassword());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateAccountRequest name="' . $name . '" password="' . $password . '">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</CreateAccountRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CreateAccountRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'name' => $name,
                'password' => $password,
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateAccountApi()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $password = $this->faker->sha1;
        $attr = new KeyValuePair($key, $value);
        $this->api->createAccount(
            $name, $password, [$attr]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CreateAccountRequest name="' . $name . '" password="' . $password . '">'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:CreateAccountRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
