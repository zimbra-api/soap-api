<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetMailQueue;
use Zimbra\Admin\Struct\QueueQueryField;
use Zimbra\Admin\Struct\QueueQuery;
use Zimbra\Admin\Struct\MailQueueQuery;
use Zimbra\Admin\Struct\ServerMailQueueQuery;
use Zimbra\Admin\Struct\ValueAttrib;

/**
 * Testcase class for GetMailQueue.
 */
class GetMailQueueTest extends ZimbraAdminApiTestCase
{
    public function testGetMailQueueRequest()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);
        $wait = mt_rand(0, 100);

        $attr = new ValueAttrib($value);
        $field = new QueueQueryField($name, [$attr]);
        $query = new QueueQuery([$field], $limit, $offset);
        $queue = new MailQueueQuery($query, $name, false, $wait);
        $server = new ServerMailQueueQuery($queue, $name);

        $req = new GetMailQueue($server);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($server, $req->getServer());
        $req->setServer($server);
        $this->assertSame($server, $req->getServer());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetMailQueueRequest>'
                . '<server name="' . $name . '">'
                    . '<queue name="' . $name . '" scan="false" wait="' . $wait . '">'
                        . '<query limit="' . $limit . '" offset="' . $offset . '">'
                            . '<field name="' . $name . '">'
                                . '<match value="' . $value . '" />'
                            . '</field>'
                        . '</query>'
                    . '</queue>'
                . '</server>'
            . '</GetMailQueueRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetMailQueueRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'server' => [
                    'name' => $name,
                    'queue' => [
                        'name' => $name,
                        'scan' => false,
                        'wait' => $wait,
                        'query' => [
                            'limit' => $limit,
                            'offset' => $offset,
                            'field' => [
                                [
                                    'name' => $name,
                                    'match' => [
                                        [
                                            'value' => $value,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetMailQueueApi()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);
        $wait = mt_rand(0, 100);

        $attr = new ValueAttrib($value);
        $field = new QueueQueryField($name, [$attr]);
        $query = new QueueQuery([$field], $limit, $offset);
        $queue = new MailQueueQuery($query, $name, false, $wait);
        $server = new ServerMailQueueQuery($queue, $name);

        $this->api->getMailQueue($server);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetMailQueueRequest>'
                        . '<urn1:server name="' . $name . '">'
                            . '<urn1:queue name="' . $name . '" scan="false" wait="' . $wait . '">'
                                . '<urn1:query limit="' . $limit . '" offset="' . $offset . '">'
                                    . '<urn1:field name="' . $name . '">'
                                        . '<urn1:match value="' . $value . '" />'
                                    . '</urn1:field>'
                                . '</urn1:query>'
                            . '</urn1:queue>'
                        . '</urn1:server>'
                    . '</urn1:GetMailQueueRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
