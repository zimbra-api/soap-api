<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\CreateGalSyncAccount;
use Zimbra\Enum\AccountBy;
use Zimbra\Enum\GalMode;
use Zimbra\Struct\AccountSelector;
use Zimbra\Struct\KeyValuePair;

/**
 * Testcase class for CreateGalSyncAccount.
 */
class CreateGalSyncAccountTest extends ZimbraAdminApiTestCase
{
    public function testCreateGalSyncAccountRequest()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $domain = $this->faker->word;
        $server = $this->faker->word;
        $password = $this->faker->word;
        $folder = $this->faker->word;

        $attr = new KeyValuePair($key, $value);
        $account = new AccountSelector(AccountBy::NAME(), $value);

        $req = new CreateGalSyncAccount(
            $account, $name, $domain, GalMode::BOTH(), $server, $password, $folder, [$attr]
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
        $this->assertSame($name, $req->getName());
        $this->assertSame($domain, $req->getDomain());
        $this->assertSame('both', $req->getType()->value());
        $this->assertSame($server, $req->getServer());
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($password, $req->getPassword());
        $this->assertSame($folder, $req->getFolder());

        $req->setName($name)
            ->setDomain($domain)
            ->setType(GalMode::LDAP())
            ->setServer($server)
            ->setAccount($account)
            ->setPassword($password)
            ->setFolder($folder);
        $this->assertSame($name, $req->getName());
        $this->assertSame($domain, $req->getDomain());
        $this->assertSame('ldap', $req->getType()->value());
        $this->assertSame($server, $req->getServer());
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($password, $req->getPassword());
        $this->assertSame($folder, $req->getFolder());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateGalSyncAccountRequest name="' . $name . '" domain="' . $domain . '" type="' . GalMode::LDAP() . '" server="' . $server . '" password="' . $password . '" folder="' . $folder . '">'
                . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</CreateGalSyncAccountRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CreateGalSyncAccountRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'name' => $name,
                'domain' => $domain,
                'type' => GalMode::LDAP()->value(),
                'server' => $server,
                'password' => $password,
                'folder' => $folder,
                'account' => [
                    'by' => AccountBy::NAME()->value(),
                    '_content' => $value,
                ],
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

    public function testCreateGalSyncAccountApi()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $domain = $this->faker->word;
        $server = $this->faker->word;
        $password = $this->faker->word;
        $folder = $this->faker->word;
        $attr = new KeyValuePair($key, $value);
        $account = new AccountSelector(AccountBy::NAME(), $value);

        $this->api->createGalSyncAccount(
            $account, $name, $domain, GalMode::LDAP(), $server, $password, $folder, [$attr]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CreateGalSyncAccountRequest name="' . $name . '" domain="' . $domain . '" type="' . GalMode::LDAP() . '" server="' . $server . '" password="' . $password . '" folder="' . $folder . '">'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $value . '</urn1:account>'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:CreateGalSyncAccountRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
