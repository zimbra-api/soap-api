<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\MailQueueAction as MailQueueActionRequest;
use Zimbra\Admin\Struct\QueueQueryField;
use Zimbra\Admin\Struct\QueueQuery;
use Zimbra\Admin\Struct\MailQueueAction;
use Zimbra\Admin\Struct\MailQueueWithAction;
use Zimbra\Admin\Struct\ServerWithQueueAction;
use Zimbra\Admin\Struct\ValueAttrib;
use Zimbra\Enum\QueueAction;
use Zimbra\Enum\QueueActionBy;

/**
 * Testcase class for MailQueueAction.
 */
class MailQueueActionTest extends ZimbraAdminApiTestCase
{
    public function testMailQueueActionRequest()
    {
        $value = $this->faker->word;
        $name = $this->faker->word;
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);

        $attr = new ValueAttrib($value);
        $field = new QueueQueryField($name, [$attr]);
        $query = new QueueQuery([$field], $limit, $offset);
        $action = new MailQueueAction($query, QueueAction::HOLD(), QueueActionBy::QUERY());
        $queue = new MailQueueWithAction($action, $name);
        $server = new ServerWithQueueAction($queue, $name);

        $req = new MailQueueActionRequest($server);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($server, $req->getServer());
        $req->setServer($server);
        $this->assertSame($server, $req->getServer());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<MailQueueActionRequest>'
                . '<server name="' . $name . '">'
                    . '<queue name="' . $name . '">'
                        . '<action op="' . QueueAction::HOLD() . '" by="' . QueueActionBy::QUERY() . '">'
                            . '<query limit="' . $limit . '" offset="' . $offset . '">'
                                . '<field name="' . $name . '">'
                                    . '<match value="' . $value . '" />'
                                . '</field>'
                            . '</query>'
                        . '</action>'
                    . '</queue>'
                . '</server>'
            . '</MailQueueActionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'MailQueueActionRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'server' => [
                    'name' => $name,
                    'queue' => [
                        'name' => $name,
                        'action' => [
                            'op' => QueueAction::HOLD()->value(),
                            'by' => QueueActionBy::QUERY()->value(),
                            'query' => [
                                'limit' => $limit,
                                'offset' => $offset,
                                'field' => [
                                    [
                                        'name' => $name,
                                        'match' => [
                                            [
                                                'value' => $value
                                            ],
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

    public function testMailQueueActionApi()
    {
        $value = $this->faker->word;
        $name = $this->faker->word;
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);

        $attr = new ValueAttrib($value);
        $field = new QueueQueryField($name, [$attr]);
        $query = new QueueQuery([$field], $limit, $offset);
        $action = new MailQueueAction($query, QueueAction::HOLD(), QueueActionBy::QUERY());
        $queue = new MailQueueWithAction($action, $name);
        $server = new ServerWithQueueAction($queue, $name);

        $this->api->mailQueueAction($server);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:MailQueueActionRequest>'
                        . '<urn1:server name="' . $name . '">'
                            . '<urn1:queue name="' . $name . '">'
                                . '<urn1:action op="' . QueueAction::HOLD() . '" by="' . QueueActionBy::QUERY() . '">'
                                    . '<urn1:query limit="' . $limit . '" offset="' . $offset . '">'
                                        . '<urn1:field name="' . $name . '">'
                                            . '<urn1:match value="' . $value . '" />'
                                        . '</urn1:field>'
                                    . '</urn1:query>'
                                . '</urn1:action>'
                            . '</urn1:queue>'
                        . '</urn1:server>'
                    . '</urn1:MailQueueActionRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
