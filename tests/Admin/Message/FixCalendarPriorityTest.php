<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\FixCalendarPriorityBody;
use Zimbra\Admin\Message\FixCalendarPriorityEnvelope;
use Zimbra\Admin\Message\FixCalendarPriorityRequest;
use Zimbra\Admin\Message\FixCalendarPriorityResponse;
use Zimbra\Struct\NamedElement;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for FixCalendarPriority.
 */
class FixCalendarPriorityTest extends ZimbraStructTestCase
{
    public function testFixCalendarPriority()
    {
        $name = $this->faker->word;
        $account = new NamedElement($name);

        $request = new FixCalendarPriorityRequest(FALSE, [$account]);
        $this->assertFalse($request->getSync());
        $this->assertSame([$account], $request->getAccounts());
        $request = new FixCalendarPriorityRequest();
        $request->setSync(TRUE)
            ->setAccounts([$account])
            ->addAccount($account);
        $this->assertTrue($request->getSync());
        $this->assertSame([$account, $account], $request->getAccounts());
        $request = new FixCalendarPriorityRequest(TRUE, [$account]);

        $response = new FixCalendarPriorityResponse();

        $body = new FixCalendarPriorityBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new FixCalendarPriorityBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new FixCalendarPriorityEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new FixCalendarPriorityEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:FixCalendarPriorityRequest sync="true">
            <account name="$name" />
        </urn:FixCalendarPriorityRequest>
        <urn:FixCalendarPriorityResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, FixCalendarPriorityEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'FixCalendarPriorityRequest' => [
                    'sync' => TRUE,
                    'account' => [
                        [
                            'name' => $name,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'FixCalendarPriorityResponse' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, FixCalendarPriorityEnvelope::class, 'json'));
    }
}
