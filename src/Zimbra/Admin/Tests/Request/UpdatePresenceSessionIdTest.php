<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\UpdatePresenceSessionId;
use Zimbra\Admin\Struct\UcServiceSelector;
use Zimbra\Enum\UcServiceBy;
use Zimbra\Struct\KeyValuePair;

/**
 * Testcase class for UpdatePresenceSessionId.
 */
class UpdatePresenceSessionIdTest extends ZimbraAdminApiTestCase
{
    public function testUpdatePresenceSessionIdRequest()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $username = $this->faker->word;
        $password = $this->faker->word;

        $attr = new KeyValuePair($key, $value);
        $ucservice = new UcServiceSelector(UcServiceBy::NAME(), $value);
        $req = new UpdatePresenceSessionId(
            $ucservice, $username, $password, [$attr]
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);

        $this->assertSame($ucservice, $req->getUcService());
        $this->assertSame($username, $req->getUserName());
        $this->assertSame($password, $req->getPassword());
        $req->setUcService($ucservice)
            ->setUserName($username)
            ->setPassword($password);
        $this->assertSame($ucservice, $req->getUcService());
        $this->assertSame($username, $req->getUserName());
        $this->assertSame($password, $req->getPassword());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<UpdatePresenceSessionIdRequest>'
                . '<ucservice by="' . UcServiceBy::NAME() . '">' . $value . '</ucservice>'
                . '<username>' . $username . '</username>'
                . '<password>' . $password . '</password>'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</UpdatePresenceSessionIdRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'UpdatePresenceSessionIdRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'ucservice' => [
                    'by' => UcServiceBy::NAME()->value(),
                    '_content' => $value,
                ],
                'username' => $username,
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

    public function testUpdatePresenceSessionIdApi()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $username = $this->faker->word;
        $password = $this->faker->word;
        $attr = new KeyValuePair($key, $value);
        $ucservice = new UcServiceSelector(UcServiceBy::NAME(), $value);

        $this->api->updatePresenceSessionId(
            $ucservice, $username, $password, [$attr]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:UpdatePresenceSessionIdRequest>'
                        . '<urn1:ucservice by="' . UcServiceBy::NAME() . '">' . $value . '</urn1:ucservice>'
                        . '<urn1:username>' . $username . '</urn1:username>'
                        . '<urn1:password>' . $password . '</urn1:password>'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:UpdatePresenceSessionIdRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
