<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

use Zimbra\Account\Message\GetRightsBody;
use Zimbra\Account\Message\GetRightsEnvelope;
use Zimbra\Account\Message\GetRightsRequest;
use Zimbra\Account\Message\GetRightsResponse;
use Zimbra\Account\Struct\AccountACEInfo;
use Zimbra\Account\Struct\Right;
use Zimbra\Enum\AceRightType;
use Zimbra\Enum\GranteeType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetRightsTest.
 */
class GetRightsTest extends ZimbraTestCase
{
    public function testGetRights()
    {
        $name = $this->faker->name;
        $zimbraId = $this->faker->uuid;
        $displayName = $this->faker->name;
        $accessKey = $this->faker->word;
        $password = $this->faker->sha256;

        $right = new Right($name);
        $request = new GetRightsRequest([$right]);
        $this->assertSame([$right], $request->getAces());
        $request = new GetRightsRequest();
        $request->setAces([$right])
            ->addAce($right);
        $this->assertSame([$right, $right], $request->getAces());
        $request->setAces([$right]);

        $ace = new AccountACEInfo(
            GranteeType::USR(), AceRightType::INVITE()->getValue(), $zimbraId, $displayName, $accessKey, $password, TRUE, TRUE
        );
        $response = new GetRightsResponse([$ace]);
        $this->assertSame([$ace], $response->getAces());
        $response = new GetRightsResponse();
        $response->setAces([$ace])
            ->addAce($ace);
        $this->assertSame([$ace, $ace], $response->getAces());
        $response->setAces([$ace]);

        $body = new GetRightsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetRightsBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetRightsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetRightsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:GetRightsRequest>
            <ace right="$name" />
        </urn:GetRightsRequest>
        <urn:GetRightsResponse>
            <ace gt="usr" right="invite" zid="$zimbraId" d="$displayName" key="$accessKey" pw="$password" deny="true" chkgt="true" />
        </urn:GetRightsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetRightsEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetRightsRequest' => [
                    'ace' => [
                        [
                            'right' => $name,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAccount',
                ],
                'GetRightsResponse' => [
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
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetRightsEnvelope::class, 'json'));
    }
}
