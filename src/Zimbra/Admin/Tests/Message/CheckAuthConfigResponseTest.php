<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CheckAuthConfigResponse;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckAuthConfigResponse.
 */
class CheckAuthConfigResponseTest extends ZimbraStructTestCase
{
    public function testCheckAuthConfigResponse()
    {
        $code = $this->faker->word;
        $bindDn = $this->faker->word;
        $message = $this->faker->word;

        $res = new CheckAuthConfigResponse(
            $code,
            $bindDn,
            $message
        );
        $this->assertSame($code, $res->getCode());
        $this->assertSame($bindDn, $res->getBindDn());
        $this->assertSame($message, $res->getMessage());

        $res = new CheckAuthConfigResponse('', '');
        $res->setCode($code)
            ->setBindDn($bindDn)
            ->setMessage($message);
        $this->assertSame($code, $res->getCode());
        $this->assertSame($bindDn, $res->getBindDn());
        $this->assertSame($message, $res->getMessage());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckAuthConfigResponse>'
                . '<code>' . $code . '</code>'
                . '<message>' . $message . '</message>'
                . '<bindDn>' . $bindDn . '</bindDn>'
            . '</CheckAuthConfigResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, CheckAuthConfigResponse::class, 'xml'));

        $json = json_encode([
            'code' => [
                '_content' => $code,
            ],
            'message' => [
                '_content' => $message,
            ],
            'bindDn' => [
                '_content' => $bindDn,
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, CheckAuthConfigResponse::class, 'json'));
    }
}
