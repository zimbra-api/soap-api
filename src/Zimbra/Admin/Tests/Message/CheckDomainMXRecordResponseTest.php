<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CheckDomainMXRecordResponse;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckDomainMXRecordResponse.
 */
class CheckDomainMXRecordResponseTest extends ZimbraStructTestCase
{
    public function testCheckDomainMXRecordResponse()
    {
        $entry1 = $this->faker->word;
        $entry2 = $this->faker->word;
        $code = $this->faker->word;
        $message = $this->faker->word;

        $res = new CheckDomainMXRecordResponse(
            [$entry1],
            $code,
            $message
        );
        $this->assertSame([$entry1], $res->getEntries());
        $this->assertSame($code, $res->getCode());
        $this->assertSame($message, $res->getMessage());

        $res = new CheckDomainMXRecordResponse([], '');
        $res->setCode($code)
            ->setMessage($message)
            ->setEntries([$entry1])
            ->addEntry($entry2);
        $this->assertSame([$entry1, $entry2], $res->getEntries());
        $this->assertSame($code, $res->getCode());
        $this->assertSame($message, $res->getMessage());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckDomainMXRecordResponse>'
                . '<entry>' . $entry1 . '</entry>'
                . '<entry>' . $entry2 . '</entry>'
                . '<code>' . $code . '</code>'
                . '<message>' . $message . '</message>'
            . '</CheckDomainMXRecordResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, CheckDomainMXRecordResponse::class, 'xml'));

        $json = json_encode([
            'entry' => [
                [
                    '_content' => $entry1,
                ],
                [
                    '_content' => $entry2,
                ],
            ],
            'code' => [
                '_content' => $code,
            ],
            'message' => [
                '_content' => $message,
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, CheckDomainMXRecordResponse::class, 'json'));
    }
}
