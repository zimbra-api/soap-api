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

use Zimbra\Enum\GranteeBy;
use Zimbra\Enum\GranteeType;
use Zimbra\Enum\TargetBy;
use Zimbra\Enum\TargetType;

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
            TargetType::ACCOUNT(), TargetBy::NAME(), $value
        );
        $grantee = new GranteeSelector(
            $value, GranteeType::USR(), GranteeBy::NAME(), $secret, TRUE
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
            new GranteeInfo($id, $name, GranteeType::USR()),
            new RightModifierInfo($value, TRUE, TRUE, TRUE, TRUE)
        );
        $response = new GetGrantsResponse([$grant]);
        $this->assertSame([$grant], $response->getGrants());
        $response = new GetGrantsResponse();
        $response->setGrants([$grant])
            ->addGrant($grant);
        $this->assertSame([$grant, $grant], $response->getGrants());
        $response->setGrants([$grant]);

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
            <target type="account" by="name">$value</target>
            <grantee type="usr" by="name" secret="$secret" all="true">$value</grantee>
        </urn:GetGrantsRequest>
        <urn:GetGrantsResponse>
            <grant>
                <target type="$type" id="$id" name="$name" />
                <grantee id="$id" name="$name" type="usr" />
                <right deny="true" canDelegate="true" disinheritSubGroups="true" subDomain="true">$value</right>
            </grant>
        </urn:GetGrantsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetGrantsEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetGrantsRequest' => [
                    'target' => [
                        'type' => 'account',
                        'by' => 'name',
                        '_content' => $value,
                    ],
                    'grantee' => [
                        'type' => 'usr',
                        'by' => 'name',
                        '_content' => $value,
                        'secret' => $secret,
                        'all' => TRUE,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'GetGrantsResponse' => [
                    'grant' => [
                        [
                            'target' => [
                                'type' => $type,
                                'id' => $id,
                                'name' => $name,
                            ],
                            'grantee' => [
                                'id' => $id,
                                'name' => $name,
                                'type' => 'usr',
                            ],
                            'right' => [
                                'deny' => TRUE,
                                'canDelegate' => TRUE,
                                'disinheritSubGroups' => TRUE,
                                'subDomain' => TRUE,
                                '_content' => $value,
                            ],
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetGrantsEnvelope::class, 'json'));
    }
}
