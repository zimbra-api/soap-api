<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\RevokeRightBody;
use Zimbra\Admin\Message\RevokeRightEnvelope;
use Zimbra\Admin\Message\RevokeRightRequest;
use Zimbra\Admin\Message\RevokeRightResponse;

use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\EffectiveRightsTargetSelector;
use Zimbra\Admin\Struct\GranteeSelector;
use Zimbra\Admin\Struct\RightModifierInfo;
use Zimbra\Admin\Struct\RightViaInfo;
use Zimbra\Admin\Struct\TargetWithType;
use Zimbra\Admin\Struct\GranteeWithType;

use Zimbra\Enum\TargetBy;
use Zimbra\Enum\TargetType;
use Zimbra\Enum\GranteeBy;
use Zimbra\Enum\GranteeType;

use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for RevokeRight.
 */
class RevokeRightTest extends ZimbraStructTestCase
{
    public function testRevokeRight()
    {
        $type = $this->faker->word;
        $key = $this->faker->word;
        $value= $this->faker->word;
        $secret = $this->faker->word;

        $target = new EffectiveRightsTargetSelector(
            TargetType::ACCOUNT(), TargetBy::NAME(), $value
        );
        $grantee = new GranteeSelector(
            $value, GranteeType::USR(), GranteeBy::ID(), $secret, TRUE
        );
        $right = new RightModifierInfo($value, TRUE, TRUE, TRUE, TRUE);
        $request = new RevokeRightRequest($target, $grantee, $right, [new Attr($key, $value)]);
        $this->assertSame($target, $request->getTarget());
        $this->assertSame($grantee, $request->getGrantee());
        $this->assertSame($right, $request->getRight());
        $request = new RevokeRightRequest(
            new EffectiveRightsTargetSelector(
                TargetType::DOMAIN(), TargetBy::ID(), ''
            ),
            new GranteeSelector(
                '', GranteeType::ALL(), GranteeBy::NAME(), '', FALSE
            ),
            new RightModifierInfo()
        );
        $request->setTarget($target)
            ->setGrantee($grantee)
            ->setRight($right);
        $this->assertSame($target, $request->getTarget());
        $this->assertSame($grantee, $request->getGrantee());
        $this->assertSame($right, $request->getRight());

        $response = new RevokeRightResponse();

        $body = new RevokeRightBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new RevokeRightBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new RevokeRightEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new RevokeRightEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:RevokeRightRequest>
            <target type="account" by="name">$value</target>
            <grantee type="usr" by="id" secret="$secret" all="true">$value</grantee>
            <right deny="true" canDelegate="true" disinheritSubGroups="true" subDomain="true">$value</right>
        </urn:RevokeRightRequest>
        <urn:RevokeRightResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, RevokeRightEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'RevokeRightRequest' => [
                    'target' => [
                        'type' => 'account',
                        'by' => 'name',
                        '_content' => $value,
                    ],
                    'grantee' => [
                        'type' => 'usr',
                        'by' => 'id',
                        'secret' => $secret,
                        'all' => TRUE,
                        '_content' => $value,
                    ],
                    'right' => [
                        '_content' => $value,
                        'deny' => TRUE,
                        'canDelegate' => TRUE,
                        'disinheritSubGroups' => TRUE,
                        'subDomain' => TRUE,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'RevokeRightResponse' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, RevokeRightEnvelope::class, 'json'));
    }
}
