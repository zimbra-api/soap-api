<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\SaveIMAPSubscriptionsEnvelope;
use Zimbra\Mail\Message\SaveIMAPSubscriptionsBody;
use Zimbra\Mail\Message\SaveIMAPSubscriptionsRequest;
use Zimbra\Mail\Message\SaveIMAPSubscriptionsResponse;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SaveIMAPSubscriptions.
 */
class SaveIMAPSubscriptionsTest extends ZimbraTestCase
{
    public function testSaveIMAPSubscriptions()
    {
        $subscription1 = $this->faker->unique()->word;
        $subscription2 = $this->faker->unique()->word;

        $request = new SaveIMAPSubscriptionsRequest([$subscription1, $subscription2]);
        $this->assertSame([$subscription1, $subscription2], $request->getSubscriptions());
        $request = new SaveIMAPSubscriptionsRequest();
        $request->setSubscriptions([$subscription1])
            ->addSubscription($subscription2);
        $this->assertSame([$subscription1, $subscription2], $request->getSubscriptions());

        $response = new SaveIMAPSubscriptionsResponse();

        $body = new SaveIMAPSubscriptionsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new SaveIMAPSubscriptionsBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new SaveIMAPSubscriptionsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new SaveIMAPSubscriptionsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:SaveIMAPSubscriptionsRequest>
            <urn:sub>$subscription1</urn:sub>
            <urn:sub>$subscription2</urn:sub>
        </urn:SaveIMAPSubscriptionsRequest>
        <urn:SaveIMAPSubscriptionsResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, SaveIMAPSubscriptionsEnvelope::class, 'xml'));
    }
}
