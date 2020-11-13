<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CheckDomainMXRecordBody;
use Zimbra\Admin\Message\CheckDomainMXRecordEnvelope;
use Zimbra\Admin\Message\CheckDomainMXRecordRequest;
use Zimbra\Admin\Message\CheckDomainMXRecordResponse;
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Enum\DomainBy;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckDomainMXRecordEnvelope.
 */
class CheckDomainMXRecordEnvelopeTest extends ZimbraStructTestCase
{
    public function testCheckDomainMXRecordEnvelope()
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

        $envelope = new CheckDomainMXRecordEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CheckDomainMXRecordEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:CheckDomainMXRecordRequest>'
                        . '<domain by="' . DomainBy::NAME() . '">' . $name . '</domain>'
                    . '</urn:CheckDomainMXRecordRequest>'
                    . '<urn:CheckDomainMXRecordResponse>'
                        . '<entry>' . $entry . '</entry>'
                        . '<code>' . $code . '</code>'
                        . '<message>' . $message . '</message>'
                    . '</urn:CheckDomainMXRecordResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CheckDomainMXRecordEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
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
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CheckDomainMXRecordEnvelope::class, 'json'));
    }
}
