<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

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

use Zimbra\Enum\TargetBy;
use Zimbra\Enum\TargetType;
use Zimbra\Enum\GranteeBy;
use Zimbra\Enum\GranteeType;

use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckRight.
 */
class CheckRightTest extends ZimbraStructTestCase
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
            <target type="account" by="name">$value</target>
            <grantee type="usr" by="id" secret="$secret" all="true">$value</grantee>
            <right>$value</right>
            <a n="$key">$value</a>
        </urn:CheckRightRequest>
        <urn:CheckRightResponse allow="true">
            <via>
                <target type="$type">$value</target>
                <grantee type="$type">$value</grantee>
                <right>$value</right>
            </via>
        </urn:CheckRightResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CheckRightEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'CheckRightRequest' => [
                    'target' => [
                        'type' => 'account',
                        'by' => 'name',
                        '_content' => $value,
                    ],
                    'grantee' => [
                        'type' => 'usr',
                        'by' => 'id',
                        '_content' => $value,
                        'secret' => $secret,
                        'all' => TRUE,
                    ],
                    'right' => [
                        '_content' => $value,
                    ],
                    'a' => [
                        [
                            'n' => $key,
                            '_content' => $value,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'CheckRightResponse' => [
                    'allow' => TRUE,
                    'via' => [
                        'target' => [
                            'type' => $type,
                            '_content' => $value,
                        ],
                        'grantee' => [
                            'type' => $type,
                            '_content' => $value,
                        ],
                        'right' => [
                            '_content' => $value,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CheckRightEnvelope::class, 'json'));
    }
}
