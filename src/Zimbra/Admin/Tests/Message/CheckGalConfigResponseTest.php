<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CheckGalConfigResponse;
use Zimbra\Admin\Struct\GalContactInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckGalConfigResponse.
 */
class CheckGalConfigResponseTest extends ZimbraStructTestCase
{
    public function testCheckGalConfigResponse()
    {
        $code = $this->faker->word;
        $message = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $cn = new GalContactInfo($id, [new Attr($key, $value)]);

        $res = new CheckGalConfigResponse(
            $code,
            $message,
            [$cn]
        );
        $this->assertSame($code, $res->getCode());
        $this->assertSame($message, $res->getMessage());
        $this->assertSame([$cn], $res->getGalContacts());

        $res = new CheckGalConfigResponse('', '');
        $res->setCode($code)
            ->setMessage($message)
            ->setGalContacts([$cn])
            ->addGalContact($cn);
        $this->assertSame($code, $res->getCode());
        $this->assertSame($message, $res->getMessage());
        $this->assertSame([$cn, $cn], $res->getGalContacts());

        $res = new CheckGalConfigResponse(
            $code,
            $message,
            [$cn]
        );
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckGalConfigResponse>'
                . '<code>' . $code . '</code>'
                . '<message>' . $message . '</message>'
                . '<cn id="' . $id . '">'
                    . '<a n="' . $key . '">' . $value . '</a>'
                . '</cn>'
            . '</CheckGalConfigResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, CheckGalConfigResponse::class, 'xml'));

        $json = json_encode([
            'code' => [
                '_content' => $code,
            ],
            'message' => [
                '_content' => $message,
            ],
            'cn' => [
                [
                    'a' => [
                        [
                            'n' => $key,
                            '_content' => $value,
                        ],
                    ],
                    'id' => $id,
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, CheckGalConfigResponse::class, 'json'));
    }
}
