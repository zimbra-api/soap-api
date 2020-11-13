<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CheckExchangeAuthResponse;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckExchangeAuthResponse.
 */
class CheckExchangeAuthResponseTest extends ZimbraStructTestCase
{
    public function testCheckExchangeAuthResponse()
    {
        $code = $this->faker->word;
        $message = $this->faker->word;

        $res = new CheckExchangeAuthResponse(
            $code,
            $message
        );
        $this->assertSame($code, $res->getCode());
        $this->assertSame($message, $res->getMessage());

        $res = new CheckExchangeAuthResponse('', '');
        $res->setCode($code)
            ->setMessage($message);
        $this->assertSame($code, $res->getCode());
        $this->assertSame($message, $res->getMessage());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckExchangeAuthResponse>'
                . '<code>' . $code . '</code>'
                . '<message>' . $message . '</message>'
            . '</CheckExchangeAuthResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, CheckExchangeAuthResponse::class, 'xml'));

        $json = json_encode([
            'code' => [
                '_content' => $code,
            ],
            'message' => [
                '_content' => $message,
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, CheckExchangeAuthResponse::class, 'json'));
    }
}
