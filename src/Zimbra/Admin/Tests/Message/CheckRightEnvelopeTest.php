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
 * Testcase class for CheckRightEnvelope.
 */
class CheckRightEnvelopeTest extends ZimbraStructTestCase
{
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
