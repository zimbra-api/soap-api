<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\AceRightType;
use Zimbra\Common\Enum\GranteeType;

use Zimbra\Mail\Message\RevokePermissionBody;
use Zimbra\Mail\Message\RevokePermissionEnvelope;
use Zimbra\Mail\Message\RevokePermissionRequest;
use Zimbra\Mail\Message\RevokePermissionResponse;

use Zimbra\Mail\Struct\AccountACEInfo;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for RevokePermissionTest.
 */
class RevokePermissionTest extends ZimbraTestCase
{
    public function testRevokePermission()
    {
        $zimbraId = $this->faker->uuid;
        $displayName = $this->faker->name;
        $accessKey = $this->faker->word;
        $password = $this->faker->sha256;
        $ace = new AccountACEInfo(
            GranteeType::USR(), AceRightType::INVITE()->getValue(), $zimbraId, $displayName, $accessKey, $password, TRUE
        );

        $request = new RevokePermissionRequest([$ace]);
        $this->assertSame([$ace], $request->getAces());
        $request = new RevokePermissionRequest();
        $request->setAces([$ace])
            ->addAce($ace);
        $this->assertSame([$ace, $ace], $request->getAces());
        $request->setAces([$ace]);

        $response = new RevokePermissionResponse([$ace]);
        $this->assertSame([$ace], $response->getAces());
        $response = new RevokePermissionResponse();
        $response->setAces([$ace]);
        $this->assertSame([$ace], $response->getAces());

        $body = new RevokePermissionBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new RevokePermissionBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new RevokePermissionEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new RevokePermissionEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:RevokePermissionRequest>
            <urn:ace gt="usr" right="invite" zid="$zimbraId" d="$displayName" key="$accessKey" pw="$password" deny="true" />
        </urn:RevokePermissionRequest>
        <urn:RevokePermissionResponse>
            <urn:ace gt="usr" right="invite" zid="$zimbraId" d="$displayName" key="$accessKey" pw="$password" deny="true" />
        </urn:RevokePermissionResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, RevokePermissionEnvelope::class, 'xml'));
    }
}
