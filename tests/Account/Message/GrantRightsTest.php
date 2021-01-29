<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

use Zimbra\Account\Message\GrantRightsBody;
use Zimbra\Account\Message\GrantRightsEnvelope;
use Zimbra\Account\Message\GrantRightsRequest;
use Zimbra\Account\Message\GrantRightsResponse;
use Zimbra\Account\Struct\AccountACEInfo;
use Zimbra\Enum\AceRightType;
use Zimbra\Enum\GranteeType;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for GrantRightsTest.
 */
class GrantRightsTest extends ZimbraStructTestCase
{
    public function testGrantRights()
    {
        $zimbraId = $this->faker->uuid;
        $displayName = $this->faker->name;
        $accessKey = $this->faker->word;
        $password = $this->faker->sha256;

        $ace = new AccountACEInfo(
            GranteeType::USR(), AceRightType::INVITE(), $zimbraId, $displayName, $accessKey, $password, TRUE, TRUE
        );

        $request = new GrantRightsRequest([$ace]);
        $this->assertSame([$ace], $request->getAces());
        $request = new GrantRightsRequest();
        $request->setAces([$ace])
            ->addAce($ace);
        $this->assertSame([$ace, $ace], $request->getAces());
        $request->setAces([$ace]);

        $response = new GrantRightsResponse([$ace]);
        $this->assertSame([$ace], $response->getAces());
        $response = new GrantRightsResponse();
        $response->setAces([$ace])
            ->addAce($ace);
        $this->assertSame([$ace, $ace], $response->getAces());
        $response->setAces([$ace]);

        $body = new GrantRightsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GrantRightsBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GrantRightsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GrantRightsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:GrantRightsRequest>
            <ace gt="usr" right="invite" zid="$zimbraId" d="$displayName" key="$accessKey" pw="$password" deny="true" chkgt="true" />
        </urn:GrantRightsRequest>
        <urn:GrantRightsResponse>
            <ace gt="usr" right="invite" zid="$zimbraId" d="$displayName" key="$accessKey" pw="$password" deny="true" chkgt="true" />
        </urn:GrantRightsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GrantRightsEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GrantRightsRequest' => [
                    'ace' => [
                        [
                            'gt' => 'usr',
                            'right' => 'invite',
                            'zid' => $zimbraId,
                            'd' => $displayName,
                            'key' => $accessKey,
                            'pw' => $password,
                            'deny' => TRUE,
                            'chkgt' => TRUE,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAccount',
                ],
                'GrantRightsResponse' => [
                    'ace' => [
                        [
                            'gt' => 'usr',
                            'right' => 'invite',
                            'zid' => $zimbraId,
                            'd' => $displayName,
                            'key' => $accessKey,
                            'pw' => $password,
                            'deny' => TRUE,
                            'chkgt' => TRUE,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAccount',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GrantRightsEnvelope::class, 'json'));
    }
}
