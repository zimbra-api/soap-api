<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Response;

use Zimbra\Admin\Message\CheckRightResponse;
use Zimbra\Admin\Struct\RightViaInfo;
use Zimbra\Admin\Struct\TargetWithType;
use Zimbra\Admin\Struct\GranteeWithType;
use Zimbra\Admin\Struct\CheckedRight;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckRightResponse.
 */
class CheckRightResponseTest extends ZimbraStructTestCase
{
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
}
