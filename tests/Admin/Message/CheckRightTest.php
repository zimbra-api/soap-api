<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\CheckRightBody;
use Zimbra\Admin\Message\CheckRightEnvelope;
use Zimbra\Admin\Message\CheckRightRequest;
use Zimbra\Admin\Message\CheckRightResponse;

use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\EffectiveRightsTargetSelector;
use Zimbra\Admin\Struct\GranteeSelector;
use Zimbra\Admin\Struct\CheckedRight;
use Zimbra\Admin\Struct\RightViaInfo;
use Zimbra\Admin\Struct\TargetWithType;
use Zimbra\Admin\Struct\GranteeWithType;

use Zimbra\Common\Enum\TargetBy;
use Zimbra\Common\Enum\TargetType;
use Zimbra\Common\Enum\GranteeBy;
use Zimbra\Common\Enum\GranteeType;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CheckRight.
 */
class CheckRightTest extends ZimbraTestCase
{
    public function testCheckRight()
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
        $right = new CheckedRight($value);
        $request = new CheckRightRequest($target, $grantee, $right, [new Attr($key, $value)]);
        $this->assertSame($target, $request->getTarget());
        $this->assertSame($grantee, $request->getGrantee());
        $this->assertSame($right, $request->getRight());
        $request = new CheckRightRequest(
            new EffectiveRightsTargetSelector(
                TargetType::DOMAIN(), TargetBy::ID(), ''
            ),
            new GranteeSelector(
                '', GranteeType::ALL(), GranteeBy::NAME(), '', FALSE
            ),
            new CheckedRight(''),
            [new Attr($key, $value)]
        );
        $request->setTarget($target)
            ->setGrantee($grantee)
            ->setRight($right);
        $this->assertSame($target, $request->getTarget());
        $this->assertSame($grantee, $request->getGrantee());
        $this->assertSame($right, $request->getRight());

        $via = new RightViaInfo(
            new TargetWithType($type, $value),
            new GranteeWithType($type, $value),
            new CheckedRight($value)
        );
        $response = new CheckRightResponse(
            FALSE, $via
        );
        $this->assertFalse($response->getAllow());
        $this->assertSame($via, $response->getVia());

        $response = new CheckRightResponse(FALSE);
        $response->setAllow(TRUE)
            ->setVia($via);
        $this->assertTrue($response->getAllow());
        $this->assertSame($via, $response->getVia());

        $body = new CheckRightBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CheckRightBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CheckRightEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CheckRightEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CheckRightRequest>
            <urn:target type="account" by="name">$value</urn:target>
            <urn:grantee type="usr" by="id" secret="$secret" all="true">$value</urn:grantee>
            <urn:right>$value</urn:right>
            <urn:a n="$key">$value</urn:a>
        </urn:CheckRightRequest>
        <urn:CheckRightResponse allow="true">
            <urn:via>
                <urn:target type="$type">$value</urn:target>
                <urn:grantee type="$type">$value</urn:grantee>
                <urn:right>$value</urn:right>
            </urn:via>
        </urn:CheckRightResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CheckRightEnvelope::class, 'xml'));
    }
}
