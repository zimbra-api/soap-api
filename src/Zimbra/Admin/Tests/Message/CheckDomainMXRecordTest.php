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
 * Testcase class for CheckDomainMXRecord.
 */
class CheckDomainMXRecordTest extends ZimbraStructTestCase
{
    public function testCheckDomainMXRecordRequest()
    {
        $name = $this->faker->word;

        $domain = new DomainSelector(DomainBy::NAME(), $name);
        $req = new CheckDomainMXRecordRequest(
            $domain
        );

        $this->assertSame($domain, $req->getDomain());

        $req = new CheckDomainMXRecordRequest(
            new DomainSelector(DomainBy::NAME(), $name)
        );
        $req->setDomain($domain);
        $this->assertSame($domain, $req->getDomain());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckDomainMXRecordRequest>'
                . '<domain by="' . DomainBy::NAME() . '">' . $name . '</domain>'
            . '</CheckDomainMXRecordRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, CheckDomainMXRecordRequest::class, 'xml'));

        $json = json_encode([
            'domain' => [
                'by' => (string) DomainBy::NAME(),
                '_content' => $name,
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, CheckDomainMXRecordRequest::class, 'json'));
    }

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
