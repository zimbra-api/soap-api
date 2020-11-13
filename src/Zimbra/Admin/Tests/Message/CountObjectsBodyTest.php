<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CountObjectsBody;
use Zimbra\Admin\Message\CountObjectsRequest;
use Zimbra\Admin\Message\CountObjectsResponse;
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Admin\Struct\UcServiceSelector;
use Zimbra\Enum\CompactIndexStatus;
use Zimbra\Enum\CountObjectsType;
use Zimbra\Enum\DomainBy;
use Zimbra\Enum\UcServiceBy;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CountObjectsBody.
 */
class CountObjectsBodyTest extends ZimbraStructTestCase
{
    public function testCountObjectsBody()
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
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CountObjectsBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:CountObjectsRequest type="' . CountObjectsType::ACCOUNT() . '" onlyrelated="true">'
                    . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>'
                    . '<ucservice by="' . UcServiceBy::NAME() . '">' . $value . '</ucservice>'
                . '</urn:CountObjectsRequest>'
                . '<urn:CountObjectsResponse num="' . $num . '" type="' . $type . '" />'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, CountObjectsBody::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, CountObjectsBody::class, 'json'));
    }
}
