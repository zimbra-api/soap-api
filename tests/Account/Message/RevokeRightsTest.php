<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

use Zimbra\Account\Message\RevokeRightsBody;
use Zimbra\Account\Message\RevokeRightsEnvelope;
use Zimbra\Account\Message\RevokeRightsRequest;
use Zimbra\Account\Message\RevokeRightsResponse;
use Zimbra\Account\Struct\AccountACEInfo;
use Zimbra\Enum\AceRightType;
use Zimbra\Enum\GranteeType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for RevokeRightsTest.
 */
class RevokeRightsTest extends ZimbraTestCase
{
    public function testRevokeRights()
    {
        $zimbraId = $this->faker->uuid;
        $displayName = $this->faker->name;
        $accessKey = $this->faker->word;
        $password = $this->faker->sha256;

        $ace = new AccountACEInfo(
            GranteeType::USR(), AceRightType::INVITE(), $zimbraId, $displayName, $accessKey, $password, TRUE, TRUE
        );

        $request = new RevokeRightsRequest([$ace]);
        $this->assertSame([$ace], $request->getAces());
        $request = new RevokeRightsRequest();
        $request->setAces([$ace])
            ->addAce($ace);
        $this->assertSame([$ace, $ace], $request->getAces());
        $request->setAces([$ace]);

        $response = new RevokeRightsResponse([$ace]);
        $this->assertSame([$ace], $response->getAces());
        $response = new RevokeRightsResponse();
        $response->setAces([$ace])
            ->addAce($ace);
        $this->assertSame([$ace, $ace], $response->getAces());
        $response->setAces([$ace]);

        $body = new RevokeRightsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new RevokeRightsBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new RevokeRightsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new RevokeRightsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:RevokeRightsRequest>
            <ace gt="usr" right="invite" zid="$zimbraId" d="$displayName" key="$accessKey" pw="$password" deny="true" chkgt="true" />
        </urn:RevokeRightsRequest>
        <urn:RevokeRightsResponse>
            <ace gt="usr" right="invite" zid="$zimbraId" d="$displayName" key="$accessKey" pw="$password" deny="true" chkgt="true" />
        </urn:RevokeRightsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, RevokeRightsEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'RevokeRightsRequest' => [
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
                'RevokeRightsResponse' => [
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
        $this->assertEquals($envelope, $this->serializer->deserialize($json, RevokeRightsEnvelope::class, 'json'));
    }
}
