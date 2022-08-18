<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetGrantsBody;
use Zimbra\Admin\Message\GetGrantsEnvelope;
use Zimbra\Admin\Message\GetGrantsRequest;
use Zimbra\Admin\Message\GetGrantsResponse;

use Zimbra\Admin\Struct\EffectiveRightsTargetSelector;
use Zimbra\Admin\Struct\GranteeSelector;
use Zimbra\Admin\Struct\GrantInfo;
use Zimbra\Admin\Struct\TypeIdName;
use Zimbra\Admin\Struct\GranteeInfo;
use Zimbra\Admin\Struct\RightModifierInfo;

use Zimbra\Common\Enum\GranteeBy;
use Zimbra\Common\Enum\GranteeType;
use Zimbra\Common\Enum\TargetBy;
use Zimbra\Common\Enum\TargetType;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetGrants.
 */
class GetGrantsTest extends ZimbraTestCase
{
    public function testGetGrants()
    {
        $value = $this->faker->word;
        $secret = $this->faker->word;
        $type = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->uuid;

        $target = new EffectiveRightsTargetSelector(
            TargetType::ACCOUNT, TargetBy::NAME, $value
        );
        $grantee = new GranteeSelector(
            $value, GranteeType::USR, GranteeBy::NAME, $secret, TRUE
        );

        $request = new GetGrantsRequest($target, $grantee);
        $this->assertSame($target, $request->getTarget());
        $this->assertSame($grantee, $request->getGrantee());
        $request = new GetGrantsRequest();
        $request->setTarget($target)
            ->setGrantee($grantee);
        $this->assertSame($target, $request->getTarget());
        $this->assertSame($grantee, $request->getGrantee());

        $grant = new GrantInfo(
            new TypeIdName($type, $id, $name),
            new GranteeInfo($id, $name, GranteeType::USR),
            new RightModifierInfo($value, TRUE, TRUE, TRUE, TRUE)
        );
        $response = new GetGrantsResponse([$grant]);
        $this->assertSame([$grant], $response->getGrants());
        $response = new GetGrantsResponse();
        $response->setGrants([$grant]);
        $this->assertSame([$grant], $response->getGrants());

        $body = new GetGrantsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new GetGrantsBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetGrantsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new GetGrantsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetGrantsRequest>
            <urn:target type="account" by="name">$value</urn:target>
            <urn:grantee type="usr" by="name" secret="$secret" all="true">$value</urn:grantee>
        </urn:GetGrantsRequest>
        <urn:GetGrantsResponse>
            <urn:grant>
                <urn:target type="$type" id="$id" name="$name" />
                <urn:grantee id="$id" name="$name" type="usr" />
                <urn:right deny="true" canDelegate="true" disinheritSubGroups="true" subDomain="true">$value</urn:right>
            </urn:grant>
        </urn:GetGrantsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetGrantsEnvelope::class, 'xml'));
    }
}
