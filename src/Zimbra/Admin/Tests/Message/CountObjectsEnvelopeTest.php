<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CountObjectsBody;
use Zimbra\Admin\Message\CountObjectsEnvelope;
use Zimbra\Admin\Message\CountObjectsRequest;
use Zimbra\Admin\Message\CountObjectsResponse;
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Admin\Struct\UcServiceSelector;
use Zimbra\Enum\CompactIndexStatus;
use Zimbra\Enum\CountObjectsType;
use Zimbra\Enum\DomainBy;
use Zimbra\Enum\UcServiceBy;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CountObjectsEnvelope.
 */
class CountObjectsEnvelopeTest extends ZimbraStructTestCase
{
    public function testCountObjectsEnvelope()
    {
        $value = $this->faker->word;
        $num = mt_rand(1, 100);
        $type = $this->faker->word;

        $domain = new DomainSelector(DomainBy::NAME(), $value);
        $ucs = new UcServiceSelector(UcServiceBy::NAME(), $value);

        $request = new CountObjectsRequest(
            CountObjectsType::ACCOUNT(), [$domain], $ucs, TRUE
        );
        $response = new CountObjectsResponse($num, $type);
        $body = new CountObjectsBody($request, $response);

        $envelope = new CountObjectsEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CountObjectsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:CountObjectsRequest type="' . CountObjectsType::ACCOUNT() . '" onlyrelated="true">'
                        . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>'
                        . '<ucservice by="' . UcServiceBy::NAME() . '">' . $value . '</ucservice>'
                    . '</urn:CountObjectsRequest>'
                    . '<urn:CountObjectsResponse num="' . $num . '" type="' . $type . '" />'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CountObjectsEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'CountObjectsRequest' => [
                    'type' => (string) CountObjectsType::ACCOUNT(),
                    'domain' => [
                        [
                            'by' => (string) DomainBy::NAME(),
                            '_content' => $value,
                        ],
                    ],
                    'ucservice' => [
                        'by' => (string) UcServiceBy::NAME(),
                        '_content' => $value,
                    ],
                    'onlyrelated' => TRUE,
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'CountObjectsResponse' => [
                    'num' => $num,
                    'type' => $type,
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CountObjectsEnvelope::class, 'json'));
    }
}
