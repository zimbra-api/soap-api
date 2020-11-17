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

use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckRight.
 */
class CheckRightTest extends ZimbraStructTestCase
{
    public function testCheckRightRequest()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $secret = $this->faker->word;

        $target = new EffectiveRightsTargetSelector(
            TargetType::ACCOUNT(), TargetBy::NAME(), $value
        );
        $grantee = new GranteeSelector(
            $value, GranteeType::USR(), GranteeBy::ID(), $secret, TRUE
        );
        $right = new CheckedRight($value);

        $req = new CheckRightRequest($target, $grantee, $right, [new Attr($key, $value)]);
        $this->assertSame($target, $req->getTarget());
        $this->assertSame($grantee, $req->getGrantee());
        $this->assertSame($right, $req->getRight());

        $req = new CheckRightRequest(
            new EffectiveRightsTargetSelector(
                TargetType::DOMAIN(), TargetBy::ID(), ''
            ),
            new GranteeSelector(
                '', GranteeType::ALL(), GranteeBy::NAME(), '', FALSE
            ),
            new CheckedRight(''),
            [new Attr($key, $value)]
        );
        $req->setTarget($target)
            ->setGrantee($grantee)
            ->setRight($right);
        $this->assertSame($target, $req->getTarget());
        $this->assertSame($grantee, $req->getGrantee());
        $this->assertSame($right, $req->getRight());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckRightRequest>'
                . '<target type="' . TargetType::ACCOUNT() . '" by="' . TargetBy::NAME() . '">' . $value . '</target>'
                . '<grantee type="' . GranteeType::USR() . '" by="' . GranteeBy::ID() . '" secret="' . $secret . '" all="true">' . $value . '</grantee>'
                . '<right>' . $value . '</right>'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</CheckRightRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, CheckRightRequest::class, 'xml'));

        $json = json_encode([
            'target' => [
                'type' => (string) TargetType::ACCOUNT(),
                'by' => (string) TargetBy::NAME(),
                '_content' => $value,
            ],
            'grantee' => [
                'type' => (string) GranteeType::USR(),
                'by' => (string) GranteeBy::ID(),
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
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, CheckRightRequest::class, 'json'));
    }

    public function testCheckRightResponse()
    {
        $type = $this->faker->word;
        $value = $this->faker->word;

        $target = new TargetWithType($type, $value);
        $grantee = new GranteeWithType($type, $value);
        $right = new CheckedRight($value);
        $via = new RightViaInfo($target, $grantee, $right);

        $res = new CheckRightResponse(
            FALSE, $via
        );
        $this->assertFalse($res->getAllow());
        $this->assertSame($via, $res->getVia());

        $res = new CheckRightResponse(FALSE);
        $res->setAllow(TRUE)
            ->setVia($via);
        $this->assertTrue($res->getAllow());
        $this->assertSame($via, $res->getVia());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckRightResponse allow="true">'
                . '<via>'
                    . '<target type="' . $type . '">' . $value . '</target>'
                    . '<grantee type="' . $type . '">' . $value . '</grantee>'
                    . '<right>' . $value . '</right>'
                . '</via>'
            . '</CheckRightResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, CheckRightResponse::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, CheckRightResponse::class, 'json'));
    }

    public function testCheckRightBody()
    {
        $type = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $secret = $this->faker->word;

        $request = new CheckRightRequest(
            new EffectiveRightsTargetSelector(
                TargetType::ACCOUNT(), TargetBy::NAME(), $value
            ),
            new GranteeSelector(
                $value, GranteeType::USR(), GranteeBy::ID(), $secret, TRUE
            ),
            new CheckedRight($value),
            [new Attr($key, $value)]
        );
        $response = new CheckRightResponse(
            TRUE,
            new RightViaInfo(
                new TargetWithType($type, $value),
                new GranteeWithType($type, $value),
                new CheckedRight($value)
            )
        );

        $body = new CheckRightBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CheckRightBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:CheckRightRequest>'
                    . '<target type="' . TargetType::ACCOUNT() . '" by="' . TargetBy::NAME() . '">' . $value . '</target>'
                    . '<grantee type="' . GranteeType::USR() . '" by="' . GranteeBy::ID() . '" secret="' . $secret . '" all="true">' . $value . '</grantee>'
                    . '<right>' . $value . '</right>'
                    . '<a n="' . $key . '">' . $value . '</a>'
                . '</urn:CheckRightRequest>'
                . '<urn:CheckRightResponse allow="true">'
                    . '<via>'
                        . '<target type="' . $type . '">' . $value . '</target>'
                        . '<grantee type="' . $type . '">' . $value . '</grantee>'
                        . '<right>' . $value . '</right>'
                    . '</via>'
                . '</urn:CheckRightResponse>'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, CheckRightBody::class, 'xml'));

        $json = json_encode([
            'CheckRightRequest' => [
                'target' => [
                    'type' => (string) TargetType::ACCOUNT(),
                    'by' => (string) TargetBy::NAME(),
                    '_content' => $value,
                ],
                'grantee' => [
                    'type' => (string) GranteeType::USR(),
                    'by' => (string) GranteeBy::ID(),
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
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, CheckRightBody::class, 'json'));
    }

    public function testCheckRightEnvelope()
    {
        $type = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $secret = $this->faker->word;

        $request = new CheckRightRequest(
            new EffectiveRightsTargetSelector(
                TargetType::ACCOUNT(), TargetBy::NAME(), $value
            ),
            new GranteeSelector(
                $value, GranteeType::USR(), GranteeBy::ID(), $secret, TRUE
            ),
            new CheckedRight($value),
            [new Attr($key, $value)]
        );
        $response = new CheckRightResponse(
            TRUE,
            new RightViaInfo(
                new TargetWithType($type, $value),
                new GranteeWithType($type, $value),
                new CheckedRight($value)
            )
        );
        $body = new CheckRightBody($request, $response);

        $envelope = new CheckRightEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CheckRightEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:CheckRightRequest>'
                        . '<target type="' . TargetType::ACCOUNT() . '" by="' . TargetBy::NAME() . '">' . $value . '</target>'
                        . '<grantee type="' . GranteeType::USR() . '" by="' . GranteeBy::ID() . '" secret="' . $secret . '" all="true">' . $value . '</grantee>'
                        . '<right>' . $value . '</right>'
                        . '<a n="' . $key . '">' . $value . '</a>'
                    . '</urn:CheckRightRequest>'
                    . '<urn:CheckRightResponse allow="true">'
                        . '<via>'
                            . '<target type="' . $type . '">' . $value . '</target>'
                            . '<grantee type="' . $type . '">' . $value . '</grantee>'
                            . '<right>' . $value . '</right>'
                        . '</via>'
                    . '</urn:CheckRightResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CheckRightEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'CheckRightRequest' => [
                    'target' => [
                        'type' => (string) TargetType::ACCOUNT(),
                        'by' => (string) TargetBy::NAME(),
                        '_content' => $value,
                    ],
                    'grantee' => [
                        'type' => (string) GranteeType::USR(),
                        'by' => (string) GranteeBy::ID(),
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
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CheckRightEnvelope::class, 'json'));
    }
}
