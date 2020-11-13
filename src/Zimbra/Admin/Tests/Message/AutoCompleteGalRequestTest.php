<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\AutoCompleteGalRequest;
use Zimbra\Enum\GalSearchType;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AutoCompleteGalRequest.
 */
class AutoCompleteGalRequestTest extends ZimbraStructTestCase
{
    public function testAutoCompleteGalRequest()
    {
        $domain = $this->faker->word;
        $name = $this->faker->word;
        $galAccountId = $this->faker->uuid;
        $limit = mt_rand();

        $req = new AutoCompleteGalRequest($domain, $name, GalSearchType::ALL(), $galAccountId, $limit);
        $this->assertSame($domain, $req->getDomain());
        $this->assertSame($name, $req->getName());
        $this->assertEquals(GalSearchType::ALL(), $req->getType());
        $this->assertSame($galAccountId, $req->getGalAccountId());
        $this->assertSame($limit, $req->getLimit());

        $req = new AutoCompleteGalRequest('', '');
        $req->setDomain($domain)
            ->setName($name)
            ->setType(GalSearchType::ACCOUNT())
            ->setGalAccountId($galAccountId)
            ->setLimit($limit);
        $this->assertSame($domain, $req->getDomain());
        $this->assertSame($name, $req->getName());
        $this->assertEquals(GalSearchType::ACCOUNT(), $req->getType());
        $this->assertSame($galAccountId, $req->getGalAccountId());
        $this->assertSame($limit, $req->getLimit());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AutoCompleteGalRequest domain="' . $domain . '" name="' . $name . '" type="' . GalSearchType::ACCOUNT() . '" galAcctId="' . $galAccountId . '" limit="' . $limit . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, AutoCompleteGalRequest::class, 'xml'));

        $json = json_encode([
            'domain' => $domain,
            'name' => $name,
            'type' => GalSearchType::ACCOUNT(),
            'galAcctId' => $galAccountId,
            'limit' => $limit,
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, AutoCompleteGalRequest::class, 'json'));
    }
}
