<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\ListIMAPSubscriptionsEnvelope;
use Zimbra\Mail\Message\ListIMAPSubscriptionsBody;
use Zimbra\Mail\Message\ListIMAPSubscriptionsRequest;
use Zimbra\Mail\Message\ListIMAPSubscriptionsResponse;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ListIMAPSubscriptions.
 */
class ListIMAPSubscriptionsTest extends ZimbraTestCase
{
    public function testListIMAPSubscriptions()
    {
        $subscription1 = $this->faker->unique->word;
        $subscription2 = $this->faker->unique->word;

        $request = new ListIMAPSubscriptionsRequest();
        $response = new ListIMAPSubscriptionsResponse([$subscription1, $subscription2]);
        $this->assertSame([$subscription1, $subscription2], $response->getSubscriptions());
        $response = new ListIMAPSubscriptionsResponse();
        $response->setSubscriptions([$subscription1, $subscription2]);
        $this->assertSame([$subscription1, $subscription2], $response->getSubscriptions());

        $body = new ListIMAPSubscriptionsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ListIMAPSubscriptionsBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ListIMAPSubscriptionsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new ListIMAPSubscriptionsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ListIMAPSubscriptionsRequest />
        <urn:ListIMAPSubscriptionsResponse>
            <urn:sub>$subscription1</urn:sub>
            <urn:sub>$subscription2</urn:sub>
        </urn:ListIMAPSubscriptionsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ListIMAPSubscriptionsEnvelope::class, 'xml'));
    }
}
