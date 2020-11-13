<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CheckDomainMXRecordBody;
use Zimbra\Admin\Message\CheckDomainMXRecordRequest;
use Zimbra\Admin\Message\CheckDomainMXRecordResponse;
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Enum\DomainBy;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckDomainMXRecordBody.
 */
class CheckDomainMXRecordBodyTest extends ZimbraStructTestCase
{
    public function testCheckDomainMXRecordBody()
    {
        $name = $this->faker->word;
        $entry = $this->faker->word;
        $code = $this->faker->word;
        $message = $this->faker->word;

        $domain = new DomainSelector(DomainBy::NAME(), $name);
        $request = new CheckDomainMXRecordRequest(
            $domain
        );
        $response = new CheckDomainMXRecordResponse(
            [$entry],
            $code,
            $message
        );

        $body = new CheckDomainMXRecordBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CheckDomainMXRecordBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:CheckDomainMXRecordRequest>'
                    . '<domain by="' . DomainBy::NAME() . '">' . $name . '</domain>'
                . '</urn:CheckDomainMXRecordRequest>'
                . '<urn:CheckDomainMXRecordResponse>'
                    . '<entry>' . $entry . '</entry>'
                    . '<code>' . $code . '</code>'
                    . '<message>' . $message . '</message>'
                . '</urn:CheckDomainMXRecordResponse>'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, CheckDomainMXRecordBody::class, 'xml'));

        $json = json_encode([
            'CheckDomainMXRecordRequest' => [
                'domain' => [
                    'by' => (string) DomainBy::NAME(),
                    '_content' => $name,
                ],
                '_jsns' => 'urn:zimbraAdmin',
            ],
            'CheckDomainMXRecordResponse' => [
                'entry' => [
                    [
                        '_content' => $entry
                    ],
                ],
                'code' => [
                    '_content' => $code,
                ],
                'message' => [
                    '_content' => $message,
                ],
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, CheckDomainMXRecordBody::class, 'json'));
    }
}
