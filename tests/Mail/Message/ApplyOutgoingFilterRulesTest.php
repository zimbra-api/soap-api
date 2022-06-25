<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Struct\IdsAttr;

use Zimbra\Mail\Message\ApplyOutgoingFilterRulesEnvelope;
use Zimbra\Mail\Message\ApplyOutgoingFilterRulesBody;
use Zimbra\Mail\Message\ApplyOutgoingFilterRulesRequest;
use Zimbra\Mail\Message\ApplyOutgoingFilterRulesResponse;

use Zimbra\Common\Struct\NamedElement;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ApplyOutgoingFilterRules.
 */
class ApplyOutgoingFilterRulesTest extends ZimbraTestCase
{
    public function testApplyOutgoingFilterRules()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $query = $this->faker->word;
        $ids = $this->faker->word;

        $filterRule = new NamedElement($name);
        $msgIds = new IdsAttr($ids);

        $request = new ApplyOutgoingFilterRulesRequest([$filterRule], $msgIds, $query);
        $this->assertSame([$filterRule], $request->getFilterRules());
        $this->assertSame($msgIds, $request->getMsgIds());
        $this->assertSame($query, $request->getQuery());
        $request = new ApplyOutgoingFilterRulesRequest();
        $request->setFilterRules([$filterRule])
            ->addFilterRule($filterRule)
            ->setMsgIds($msgIds)
            ->setQuery($query);
        $this->assertSame([$filterRule, $filterRule], $request->getFilterRules());
        $this->assertSame($msgIds, $request->getMsgIds());
        $this->assertSame($query, $request->getQuery());
        $request->setFilterRules([$filterRule]);

        $response = new ApplyOutgoingFilterRulesResponse($msgIds);
        $this->assertSame($msgIds, $response->getMsgIds());
        $response = new ApplyOutgoingFilterRulesResponse();
        $response->setMsgIds($msgIds);
        $this->assertSame($msgIds, $response->getMsgIds());

        $body = new ApplyOutgoingFilterRulesBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ApplyOutgoingFilterRulesBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ApplyOutgoingFilterRulesEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new ApplyOutgoingFilterRulesEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ApplyOutgoingFilterRulesRequest>
            <filterRules>
                <filterRule name="$name" />
            </filterRules>
            <m ids="$ids" />
            <query>$query</query>
        </urn:ApplyOutgoingFilterRulesRequest>
        <urn:ApplyOutgoingFilterRulesResponse>
            <m ids="$ids" />
        </urn:ApplyOutgoingFilterRulesResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ApplyOutgoingFilterRulesEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'ApplyOutgoingFilterRulesRequest' => [
                    'filterRules' => [
                        'filterRule' => [
                            [
                                'name' => $name,
                            ],
                        ],
                    ],
                    'm' => [
                        'ids' => $ids,
                    ],
                    'query' => [
                        '_content' => $query,
                    ],
                    '_jsns' => 'urn:zimbraMail',
                ],
                'ApplyOutgoingFilterRulesResponse' => [
                    'm' => [
                        'ids' => $ids,
                    ],
                    '_jsns' => 'urn:zimbraMail',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, ApplyOutgoingFilterRulesEnvelope::class, 'json'));
    }
}
