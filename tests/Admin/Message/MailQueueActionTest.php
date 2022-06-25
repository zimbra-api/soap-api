<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\MailQueueActionBody;
use Zimbra\Admin\Message\MailQueueActionEnvelope;
use Zimbra\Admin\Message\MailQueueActionRequest;
use Zimbra\Admin\Message\MailQueueActionResponse;

use Zimbra\Admin\Struct\ServerWithQueueAction;
use Zimbra\Admin\Struct\QueueQueryField;
use Zimbra\Admin\Struct\QueueQuery;
use Zimbra\Admin\Struct\MailQueueAction;
use Zimbra\Admin\Struct\MailQueueWithAction;
use Zimbra\Admin\Struct\ValueAttrib;
use Zimbra\Common\Enum\QueueActionBy;
use Zimbra\Common\Enum\QueueAction;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for MailQueueAction.
 */
class MailQueueActionTest extends ZimbraTestCase
{
    public function testMailQueueAction()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);

        $query = new QueueQuery(
            [new QueueQueryField($name, [new ValueAttrib($value)])], $limit, $offset
        );
        $action = new MailQueueAction($query, QueueAction::HOLD(), QueueActionBy::QUERY());
        $server = new ServerWithQueueAction(new MailQueueWithAction($action, $name), $name);

        $request = new MailQueueActionRequest($server);
        $this->assertSame($server, $request->getServer());
        $request = new MailQueueActionRequest(
            new ServerWithQueueAction(new MailQueueWithAction($action, ''), '')
        );
        $request->setServer($server);
        $this->assertSame($server, $request->getServer());

        $response = new MailQueueActionResponse();

        $body = new MailQueueActionBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new MailQueueActionBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new MailQueueActionEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new MailQueueActionEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:MailQueueActionRequest>
            <server name="$name">
                <queue name="$name">
                    <action op="hold" by="query">
                        <query limit="$limit" offset="$offset">
                            <field name="$name">
                                <match value="$value" />
                            </field>
                        </query>
                    </action>
                </queue>
            </server>
        </urn:MailQueueActionRequest>
        <urn:MailQueueActionResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, MailQueueActionEnvelope::class, 'xml'));
    }
}
