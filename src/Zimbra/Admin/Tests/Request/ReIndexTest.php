<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\ReIndex;
use Zimbra\Admin\Struct\ReindexMailboxInfo;
use Zimbra\Enum\ReIndexAction;
use Zimbra\Enum\ReindexType;

/**
 * Testcase class for ReIndex.
 */
class ReIndexTest extends ZimbraAdminApiTestCase
{
    public function testReIndexRequest()
    {
        $id = $this->faker->word;
        $ids = $this->faker->word;
        $enums = $this->faker->randomElements(ReindexType::enums(), mt_rand(1, count(ReindexType::enums())));
        $types = implode(',', $enums);

        $mbox = new ReindexMailboxInfo($id, $types, $ids);
        $req = new ReIndex($mbox, ReIndexAction::START());
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($mbox, $req->getMailbox());
        $this->assertEquals('start', $req->getAction()->value());
        $req->setMailbox($mbox)
            ->setAction(ReIndexAction::CANCEL());
        $this->assertEquals($mbox, $req->getMailbox());
        $this->assertEquals('cancel', $req->getAction()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ReIndexRequest action="' . ReIndexAction::CANCEL() . '">'
                . '<mbox id="' . $id . '" types="' . $types . '" ids="' . $ids . '" />'
            . '</ReIndexRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ReIndexRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'action' => ReIndexAction::CANCEL()->value(),
                'mbox' => [
                    'id' => $id,
                    'types' => $types,
                    'ids' => $ids,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testReIndexApi()
    {
        $id = $this->faker->word;
        $ids = $this->faker->word;
        $enums = $this->faker->randomElements(ReindexType::enums(), mt_rand(1, count(ReindexType::enums())));
        $types = implode(',', $enums);
        $mbox = new ReindexMailboxInfo($id, $types, $ids);

        $this->api->reIndex(
           $mbox, ReIndexAction::CANCEL()
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:ReIndexRequest action="' . ReIndexAction::CANCEL() . '">'
                        . '<urn1:mbox id="' . $id . '" types="' . $types . '" ids="' . $ids . '" />'
                    . '</urn1:ReIndexRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
