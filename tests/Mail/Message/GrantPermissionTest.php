<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\AceRightType;
use Zimbra\Common\Enum\GranteeType;

use Zimbra\Mail\Message\GrantPermissionBody;
use Zimbra\Mail\Message\GrantPermissionEnvelope;
use Zimbra\Mail\Message\GrantPermissionRequest;
use Zimbra\Mail\Message\GrantPermissionResponse;

use Zimbra\Mail\Struct\AccountACEInfo;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GrantPermissionTest.
 */
class GrantPermissionTest extends ZimbraTestCase
{
    public function testGrantPermission()
    {
        $zimbraId = $this->faker->uuid;
        $displayName = $this->faker->name;
        $accessKey = $this->faker->word;
        $password = $this->faker->sha256;
        $ace = new AccountACEInfo(
            GranteeType::USR(), AceRightType::INVITE()->getValue(), $zimbraId, $displayName, $accessKey, $password, TRUE
        );

        $request = new GrantPermissionRequest([$ace]);
        $this->assertSame([$ace], $request->getAces());
        $request = new GrantPermissionRequest();
        $request->setAces([$ace])
            ->addAce($ace);
        $this->assertSame([$ace, $ace], $request->getAces());
        $request->setAces([$ace]);

        $response = new GrantPermissionResponse([$ace]);
        $this->assertSame([$ace], $response->getAces());
        $response = new GrantPermissionResponse();
        $response->setAces([$ace])
            ->addAce($ace);
        $this->assertSame([$ace, $ace], $response->getAces());
        $response->setAces([$ace]);

        $body = new GrantPermissionBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GrantPermissionBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GrantPermissionEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GrantPermissionEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GrantPermissionRequest>
            <urn:ace gt="usr" right="invite" zid="$zimbraId" d="$displayName" key="$accessKey" pw="$password" deny="true" />
        </urn:GrantPermissionRequest>
        <urn:GrantPermissionResponse>
            <urn:ace gt="usr" right="invite" zid="$zimbraId" d="$displayName" key="$accessKey" pw="$password" deny="true" />
        </urn:GrantPermissionResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GrantPermissionEnvelope::class, 'xml'));
    }
}
