<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\MigrateAccount;
use Zimbra\Admin\Struct\IdAndAction;

/**
 * Testcase class for MigrateAccount.
 */
class MigrateAccountTest extends ZimbraAdminApiTestCase
{
    public function testMigrateAccountRequest()
    {
        $id = $this->faker->word;
        $action = $this->faker->randomElement(['bug72174', 'wiki', 'contactGroup']);

        $migrate = new IdAndAction($id, $action);
        $req = new MigrateAccount($migrate);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($migrate, $req->getMigrate());
        $req->setMigrate($migrate);
        $this->assertSame($migrate, $req->getMigrate());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<MigrateAccountRequest>'
                . '<migrate id="' . $id .'" action="' . $action . '" />'
            . '</MigrateAccountRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'MigrateAccountRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'migrate' => [
                    'id' => $id,
                    'action' => $action,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testMigrateAccountApi()
    {
        $id = $this->faker->word;
        $action = $this->faker->randomElement(['bug72174', 'wiki', 'contactGroup']);
        $migrate = new IdAndAction($id, $action);

        $this->api->migrateAccount($migrate);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:MigrateAccountRequest>'
                        . '<urn1:migrate id="' . $id . '" action="' . $action . '" />'
                    . '</urn1:MigrateAccountRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
