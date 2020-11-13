<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Message\CountObjectsRequest;
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Admin\Struct\UcServiceSelector;
use Zimbra\Enum\CountObjectsType;
use Zimbra\Enum\DomainBy;
use Zimbra\Enum\UcServiceBy;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CountObjectsRequest.
 */
class CountObjectsRequestTest extends ZimbraStructTestCase
{
    public function testCountObjectsRequest()
    {
        $value = $this->faker->word;
        $domain = new DomainSelector(DomainBy::NAME(), $value);
        $ucs = new UcServiceSelector(UcServiceBy::NAME(), $value);

        $req = new CountObjectsRequest(
            CountObjectsType::USER_ACCOUNT(), [$domain], $ucs, FALSE
        );
        $this->assertEquals(CountObjectsType::USER_ACCOUNT(), $req->getType());
        $this->assertSame([$domain], $req->getDomains());
        $this->assertSame($ucs, $req->getUcService());
        $this->assertFalse($req->getOnlyRelated());

        $req = new CountObjectsRequest(
            CountObjectsType::USER_ACCOUNT()
        );
        $req->setType(CountObjectsType::ACCOUNT())
            ->setDomains([$domain])
            ->addDomain($domain)
            ->setUcService($ucs)
            ->setOnlyRelated(TRUE);
        $this->assertEquals(CountObjectsType::ACCOUNT(), $req->getType());
        $this->assertSame([$domain, $domain], $req->getDomains());
        $this->assertSame($ucs, $req->getUcService());
        $this->assertTrue($req->getOnlyRelated());

        $req = new CountObjectsRequest(
            CountObjectsType::ACCOUNT(), [$domain], $ucs, TRUE
        );
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CountObjectsRequest type="' . CountObjectsType::ACCOUNT() . '" onlyrelated="true">'
                . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>'
                . '<ucservice by="' . UcServiceBy::NAME() . '">' . $value . '</ucservice>'
            . '</CountObjectsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, CountObjectsRequest::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, CountObjectsRequest::class, 'json'));
    }
}
