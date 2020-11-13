<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\ContactBackupBody;
use Zimbra\Admin\Message\ContactBackupRequest;
use Zimbra\Admin\Message\ContactBackupResponse;
use Zimbra\Admin\Struct\{ContactBackupServer, ServerSelector};
use Zimbra\Enum\ContactBackupStatus;
use Zimbra\Enum\ContactBackupOp;
use Zimbra\Enum\ServerBy;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ContactBackupBody.
 */
class ContactBackupBodyTest extends ZimbraStructTestCase
{
    public function testContactBackupBody()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $request = new ContactBackupRequest([new ServerSelector(ServerBy::NAME(), $value)], ContactBackupOp::START());
        $response = new ContactBackupResponse([new ContactBackupServer($name, ContactBackupStatus::STOPPED())]);

        $body = new ContactBackupBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new ContactBackupBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:ContactBackupRequest op="' . ContactBackupOp::START() . '">'
                    .'<servers>'
                        . '<server by="' . ServerBy::NAME() . '">' . $value . '</server>'
                    .'</servers>'
                . '</urn:ContactBackupRequest>'
                . '<urn:ContactBackupResponse>'
                    .'<servers>'
                        . '<server name="' . $name . '" status="' . ContactBackupStatus::STOPPED() . '" />'
                    .'</servers>'
                . '</urn:ContactBackupResponse>'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, ContactBackupBody::class, 'xml'));

        $json = json_encode([
            'ContactBackupRequest' => [
                'servers' => [
                    'server' => [
                        [
                            'by' => (string) ServerBy::NAME(),
                            '_content' => $value,
                        ],
                    ]
                ],
                'op' => (string) ContactBackupOp::START(),
                '_jsns' => 'urn:zimbraAdmin',
            ],
            'ContactBackupResponse' => [
                'servers' => [
                    'server' => [
                        [
                            'name' => $name,
                            'status' => (string) ContactBackupStatus::STOPPED(),
                        ],
                    ]
                ],
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, ContactBackupBody::class, 'json'));
    }
}
