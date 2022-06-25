<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GrantRightBody;
use Zimbra\Admin\Message\GrantRightEnvelope;
use Zimbra\Admin\Message\GrantRightRequest;
use Zimbra\Admin\Message\GrantRightResponse;

use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\EffectiveRightsTargetSelector;
use Zimbra\Admin\Struct\GranteeSelector;
use Zimbra\Admin\Struct\RightModifierInfo;
use Zimbra\Admin\Struct\RightViaInfo;
use Zimbra\Admin\Struct\TargetWithType;
use Zimbra\Admin\Struct\GranteeWithType;

use Zimbra\Common\Enum\TargetBy;
use Zimbra\Common\Enum\TargetType;
use Zimbra\Common\Enum\GranteeBy;
use Zimbra\Common\Enum\GranteeType;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GrantRight.
 */
class GrantRightTest extends ZimbraTestCase
{
    public function testGrantRight()
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
        $request = new GrantRightRequest($target, $grantee, $right, [new Attr($key, $value)]);
        $this->assertSame($target, $request->getTarget());
        $this->assertSame($grantee, $request->getGrantee());
        $this->assertSame($right, $request->getRight());
        $request = new GrantRightRequest(
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

        $response = new GrantRightResponse();

        $body = new GrantRightBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new GrantRightBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GrantRightEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new GrantRightEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GrantRightRequest>
            <target type="account" by="name">$value</target>
            <grantee type="usr" by="id" secret="$secret" all="true">$value</grantee>
            <right deny="true" canDelegate="true" disinheritSubGroups="true" subDomain="true">$value</right>
        </urn:GrantRightRequest>
        <urn:GrantRightResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GrantRightEnvelope::class, 'xml'));
    }
}
