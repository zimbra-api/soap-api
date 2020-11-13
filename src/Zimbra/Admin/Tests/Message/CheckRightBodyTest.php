<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CheckRightBody;
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
 * Testcase class for CheckRightBody.
 */
class CheckRightBodyTest extends ZimbraStructTestCase
{
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
}
