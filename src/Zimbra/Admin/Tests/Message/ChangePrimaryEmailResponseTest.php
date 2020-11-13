<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\ChangePrimaryEmailResponse;
use Zimbra\Admin\Struct\AccountInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ChangePrimaryEmailResponse.
 */
class ChangePrimaryEmailResponseTest extends ZimbraStructTestCase
{
    public function testChangePrimaryEmailResponse()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $attr = new Attr($key, $value);
        $account = new AccountInfo($name, $id, TRUE, [$attr]);

        $res = new ChangePrimaryEmailResponse($account);
        $this->assertEquals($account, $res->getAccount());

        $res = new ChangePrimaryEmailResponse(new AccountInfo('', ''));
        $res->setAccount($account);
        $this->assertEquals($account, $res->getAccount());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ChangePrimaryEmailResponse>'
                . '<account name="' . $name . '" id="' . $id . '" isExternal="true">'
                    . '<a n="' . $key . '">' . $value . '</a>'
                . '</account>'
            . '</ChangePrimaryEmailResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, ChangePrimaryEmailResponse::class, 'xml'));

        $json = json_encode([
            'account' => [
                'name' => $name,
                'id' => $id,
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
                'isExternal' => TRUE,
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, ChangePrimaryEmailResponse::class, 'json'));
    }
}
