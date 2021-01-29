<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\PushFreeBusyBody;
use Zimbra\Admin\Message\PushFreeBusyEnvelope;
use Zimbra\Admin\Message\PushFreeBusyRequest;
use Zimbra\Admin\Message\PushFreeBusyResponse;
use Zimbra\Admin\Struct\Names;
use Zimbra\Struct\Id;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for PushFreeBusyTest.
 */
class PushFreeBusyTest extends ZimbraStructTestCase
{
    public function testPushFreeBusy()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $domains = new Names($name);
        $account = new Id($id);

        $request = new PushFreeBusyRequest($domains, [$account]);
        $this->assertSame($domains, $request->getDomains());
        $this->assertSame([$account], $request->getAccounts());

        $request = new PushFreeBusyRequest();
        $request->setDomains($domains)
            ->setAccounts([$account])
            ->addAccount($account);
        $this->assertSame($domains, $request->getDomains());
        $this->assertSame([$account, $account], $request->getAccounts());
        $request->setAccounts([$account]);

        $response = new PushFreeBusyResponse();

        $body = new PushFreeBusyBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new PushFreeBusyBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new PushFreeBusyEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new PushFreeBusyEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:PushFreeBusyRequest>
            <domain name="$name" />
            <account id="$id" />
        </urn:PushFreeBusyRequest>
        <urn:PushFreeBusyResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, PushFreeBusyEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'PushFreeBusyRequest' => [
                    'domain' => [
                        'name' => $name,
                    ],
                    'account' => [
                        [
                            'id' => $id,
                        ]
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'PushFreeBusyResponse' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, PushFreeBusyEnvelope::class, 'json'));
    }
}
