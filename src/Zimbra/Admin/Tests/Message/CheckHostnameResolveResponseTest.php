<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CheckHostnameResolveResponse;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckHostnameResolveResponse.
 */
class CheckHostnameResolveResponseTest extends ZimbraStructTestCase
{
    public function testCheckHostnameResolveResponse()
    {
        $code = $this->faker->word;
        $message = $this->faker->word;

        $res = new CheckHostnameResolveResponse(
            $code,
            $message
        );
        $this->assertSame($code, $res->getCode());
        $this->assertSame($message, $res->getMessage());

        $res = new CheckHostnameResolveResponse('', '');
        $res->setCode($code)
            ->setMessage($message);
        $this->assertSame($code, $res->getCode());
        $this->assertSame($message, $res->getMessage());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckHostnameResolveResponse>'
                . '<code>' . $code . '</code>'
                . '<message>' . $message . '</message>'
            . '</CheckHostnameResolveResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, CheckHostnameResolveResponse::class, 'xml'));

        $json = json_encode([
            'code' => [
                '_content' => $code,
            ],
            'message' => [
                '_content' => $message,
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, CheckHostnameResolveResponse::class, 'json'));
    }
}
