<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CheckRightRequest;

use Zimbra\Admin\Struct\EffectiveRightsTargetSelector;
use Zimbra\Admin\Struct\GranteeSelector;
use Zimbra\Admin\Struct\CheckedRight;
use Zimbra\Admin\Struct\Attr;

use Zimbra\Enum\TargetBy;
use Zimbra\Enum\TargetType;
use Zimbra\Enum\GranteeBy;
use Zimbra\Enum\GranteeType;

use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckRightRequest.
 */
class CheckRightRequestTest extends ZimbraStructTestCase
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
}
