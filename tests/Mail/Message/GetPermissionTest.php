<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\AceRightType;
use Zimbra\Common\Enum\GranteeType;

use Zimbra\Mail\Message\GetPermissionBody;
use Zimbra\Mail\Message\GetPermissionEnvelope;
use Zimbra\Mail\Message\GetPermissionRequest;
use Zimbra\Mail\Message\GetPermissionResponse;

use Zimbra\Mail\Struct\AccountACEInfo;
use Zimbra\Mail\Struct\Right;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetPermissionTest.
 */
class GetPermissionTest extends ZimbraTestCase
{
    public function testGetPermission()
    {
        $name = $this->faker->name;
        $zimbraId = $this->faker->uuid;
        $displayName = $this->faker->name;
        $accessKey = $this->faker->word;
        $password = $this->faker->sha256;

        $right = new Right($name);
        $request = new GetPermissionRequest([$right]);
        $this->assertSame([$right], $request->getAces());
        $request = new GetPermissionRequest();
        $request->setAces([$right])
            ->addAce($right);
        $this->assertSame([$right, $right], $request->getAces());
        $request->setAces([$right]);

        $ace = new AccountACEInfo(
            GranteeType::USR, AceRightType::INVITE->value, $zimbraId, $displayName, $accessKey, $password, TRUE
        );
        $response = new GetPermissionResponse([$ace]);
        $this->assertSame([$ace], $response->getAces());
        $response = new GetPermissionResponse();
        $response->setAces([$ace]);
        $this->assertSame([$ace], $response->getAces());

        $body = new GetPermissionBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetPermissionBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetPermissionEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetPermissionEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetPermissionRequest>
            <urn:ace right="$name" />
        </urn:GetPermissionRequest>
        <urn:GetPermissionResponse>
            <urn:ace gt="usr" right="invite" zid="$zimbraId" d="$displayName" key="$accessKey" pw="$password" deny="true" />
        </urn:GetPermissionResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetPermissionEnvelope::class, 'xml'));
    }
}
