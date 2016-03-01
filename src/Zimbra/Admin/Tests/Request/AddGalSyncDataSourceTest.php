<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\AddGalSyncDataSource;
use Zimbra\Struct\AccountSelector;
use Zimbra\Struct\KeyValuePair;
use Zimbra\Enum\AccountBy;
use Zimbra\Enum\GalMode;

/**
 * Testcase class for AddGalSyncDataSource.
 */
class AddGalSyncDataSourceTest extends ZimbraAdminApiTestCase
{
    public function testAddGalSyncDataSourceRequest()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $domain = $this->faker->word;
        $folder = $this->faker->word;

        $attr = new KeyValuePair($key, $value);
        $account = new AccountSelector(AccountBy::NAME(), $value);
        $req = new AddGalSyncDataSource(
            $account, $name, $domain, GalMode::BOTH(), $folder, [$attr]
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);

        $this->assertSame($account, $req->getAccount());
        $this->assertSame($name, $req->getName());
        $this->assertSame($domain, $req->getDomain());
        $this->assertTrue($req->getType()->is('both'));
        $this->assertSame($folder, $req->getFolder());

        $req->setAccount($account)
            ->setName($name)
            ->setDomain($domain)
            ->setType(GalMode::ZIMBRA())
            ->setFolder($folder);
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($name, $req->getName());
        $this->assertSame($domain, $req->getDomain());
        $this->assertTrue($req->getType()->is('zimbra'));
        $this->assertSame($folder, $req->getFolder());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AddGalSyncDataSourceRequest name="' . $name . '" domain="' . $domain . '" type="' . GalMode::ZIMBRA() . '" folder="' . $folder . '">'
                . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</AddGalSyncDataSourceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'AddGalSyncDataSourceRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'name' => $name,
                'domain' => $domain,
                'type' => GalMode::ZIMBRA()->value(),
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

    public function testAddGalSyncDataSourceApi()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $domain = $this->faker->word;
        $folder = $this->faker->word;

        $attr = new KeyValuePair($key, $value);
        $account = new AccountSelector(AccountBy::NAME(), $value);

        $this->api->addGalSyncDataSource(
            $account, $name, $domain, GalMode::BOTH(), $folder, [$attr]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:AddGalSyncDataSourceRequest name="' . $name . '" domain="' . $domain . '" type="' . GalMode::BOTH() . '" folder="' . $folder . '">'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $value . '</urn1:account>'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:AddGalSyncDataSourceRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
