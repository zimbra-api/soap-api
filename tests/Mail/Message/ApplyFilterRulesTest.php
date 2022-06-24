<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Struct\NamedElement;

use Zimbra\Mail\Message\ApplyFilterRulesEnvelope;
use Zimbra\Mail\Message\ApplyFilterRulesBody;
use Zimbra\Mail\Message\ApplyFilterRulesRequest;
use Zimbra\Mail\Message\ApplyFilterRulesResponse;

use Zimbra\Mail\Struct\IdsAttr;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ApplyFilterRules.
 */
class ApplyFilterRulesTest extends ZimbraTestCase
{
    public function testApplyFilterRules()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $query = $this->faker->word;
        $ids = implode(',', [
            $this->faker->uuid,
            $this->faker->uuid,
        ]);

        $filterRule = new NamedElement($name);
        $msgIds = new IdsAttr($ids);

        $request = new ApplyFilterRulesRequest([$filterRule], $msgIds, $query);
        $this->assertSame([$filterRule], $request->getFilterRules());
        $this->assertSame($msgIds, $request->getMsgIds());
        $this->assertSame($query, $request->getQuery());
        $request = new ApplyFilterRulesRequest();
        $request->setFilterRules([$filterRule])
            ->addFilterRule($filterRule)
            ->setMsgIds($msgIds)
            ->setQuery($query);
        $this->assertSame([$filterRule, $filterRule], $request->getFilterRules());
        $this->assertSame($msgIds, $request->getMsgIds());
        $this->assertSame($query, $request->getQuery());
        $request->setFilterRules([$filterRule]);

        $response = new ApplyFilterRulesResponse($msgIds);
        $this->assertSame($msgIds, $response->getMsgIds());
        $response = new ApplyFilterRulesResponse();
        $response->setMsgIds($msgIds);
        $this->assertSame($msgIds, $response->getMsgIds());

        $body = new ApplyFilterRulesBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ApplyFilterRulesBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ApplyFilterRulesEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new ApplyFilterRulesEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ApplyFilterRulesRequest>
            <filterRules>
                <filterRule name="$name" />
            </filterRules>
            <m ids="$ids" />
            <query>$query</query>
        </urn:ApplyFilterRulesRequest>
        <urn:ApplyFilterRulesResponse>
            <m ids="$ids" />
        </urn:ApplyFilterRulesResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ApplyFilterRulesEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'ApplyFilterRulesRequest' => [
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
                'ApplyFilterRulesResponse' => [
                    'm' => [
                        'ids' => $ids,
                    ],
                    '_jsns' => 'urn:zimbraMail',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, ApplyFilterRulesEnvelope::class, 'json'));
    }
}
