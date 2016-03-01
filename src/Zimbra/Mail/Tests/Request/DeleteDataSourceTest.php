<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\DeleteDataSource;
use Zimbra\Mail\Struct\ImapDataSourceNameOrId;
use Zimbra\Mail\Struct\Pop3DataSourceNameOrId;

/**
 * Testcase class for DeleteDataSource.
 */
class MailDeleteDataSourceTest extends ZimbraMailApiTestCase
{
    public function testDeleteDataSourceRequest()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $imap = new ImapDataSourceNameOrId($name, $id);
        $pop3 = new Pop3DataSourceNameOrId($name, $id);

        $req = new DeleteDataSource(
            $imap
        );
        $this->assertSame($imap, $req->getDataSource());
        $req->setDataSource($pop3);
        $this->assertSame($pop3, $req->getDataSource());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<DeleteDataSourceRequest>'
                .'<pop3 name="' . $name . '" id="' . $id . '" />'
            .'</DeleteDataSourceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'DeleteDataSourceRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'pop3' => array(
                    'name' => $name,
                    'id' => $id,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteDataSourceApi()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $imap = new ImapDataSourceNameOrId($name, $id);
        $this->api->deleteDataSource(
            $imap
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:DeleteDataSourceRequest>'
                        .'<urn1:imap name="' . $name . '" id="' . $id . '" />'
                    .'</urn1:DeleteDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
