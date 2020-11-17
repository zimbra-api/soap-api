<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\AddDistributionListAliasBody;
use Zimbra\Admin\Message\AddDistributionListAliasEnvelope;
use Zimbra\Admin\Message\AddDistributionListAliasRequest;
use Zimbra\Admin\Message\AddDistributionListAliasResponse;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AddDistributionListAlias.
 */
class AddDistributionListAliasTest extends ZimbraStructTestCase
{
    private $id;
    private $alias;

    protected function setUp(): void
    {
        parent::setUp();
        $this->id = $this->faker->uuid;
        $this->alias = $this->faker->word;
    }

    public function testAddDistributionListAliasRequest()
    {
        $req = new AddDistributionListAliasRequest($this->id, $this->alias);
        $this->assertSame($this->id, $req->getId());
        $this->assertSame($this->alias, $req->getAlias());

        $req = new AddDistributionListAliasRequest('', '');
        $req->setId($this->id)
            ->setAlias($this->alias);
        $this->assertSame($this->id, $req->getId());
        $this->assertSame($this->alias, $req->getAlias());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AddDistributionListAliasRequest id="' . $this->id . '" alias="' . $this->alias . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, AddDistributionListAliasRequest::class, 'xml'));

        $json = json_encode([
            'id' => $this->id,
            'alias' => $this->alias,
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, AddDistributionListAliasRequest::class, 'json'));
    }

    public function testAddDistributionListAliasResponse()
    {
        $res = new AddDistributionListAliasResponse();

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AddDistributionListAliasResponse />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, AddDistributionListAliasResponse::class, 'xml'));

        $json = '{}';
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, AddDistributionListAliasResponse::class, 'json'));
    }

    public function testAddDistributionListAliasBody()
    {
        $request = new AddDistributionListAliasRequest($this->id, $this->alias);
        $response = new AddDistributionListAliasResponse();

        $body = new AddDistributionListAliasBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new AddDistributionListAliasBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:AddDistributionListAliasRequest id="' . $this->id . '" alias="' . $this->alias . '" />'
                . '<urn:AddDistributionListAliasResponse />'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, AddDistributionListAliasBody::class, 'xml'));

        $json = json_encode([
            'AddDistributionListAliasRequest' => [
                'id' => $this->id,
                'alias' => $this->alias,
                '_jsns' => 'urn:zimbraAdmin',
            ],
            'AddDistributionListAliasResponse' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, AddDistributionListAliasBody::class, 'json'));
    }

    public function testAddDistributionListAliasEnvelope()
    {
        $request = new AddDistributionListAliasRequest($this->id, $this->alias);
        $response = new AddDistributionListAliasResponse();
        $body = new AddDistributionListAliasBody($request, $response);

        $envelope = new AddDistributionListAliasEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new AddDistributionListAliasEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:AddDistributionListAliasRequest id="' . $this->id . '" alias="' . $this->alias . '" />'
                    . '<urn:AddDistributionListAliasResponse />'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, AddDistributionListAliasEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'AddDistributionListAliasRequest' => [
                    'id' => $this->id,
                    'alias' => $this->alias,
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'AddDistributionListAliasResponse' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, AddDistributionListAliasEnvelope::class, 'json'));
    }
}
