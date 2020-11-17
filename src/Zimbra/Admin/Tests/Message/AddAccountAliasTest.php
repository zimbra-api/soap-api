<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\AddAccountAliasBody;
use Zimbra\Admin\Message\AddAccountAliasEnvelope;
use Zimbra\Admin\Message\AddAccountAliasRequest;
use Zimbra\Admin\Message\AddAccountAliasResponse;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AddAccountAliasTest.
 */
class AddAccountAliasTest extends ZimbraStructTestCase
{
    private $id;
    private $alias;

    protected function setUp(): void
    {
        parent::setUp();
        $this->id = $this->faker->uuid;
        $this->alias = $this->faker->word;
    }

    public function testAddAccountAliasRequest()
    {
        $req = new AddAccountAliasRequest($this->id, $this->alias);
        $this->assertSame($this->id, $req->getId());
        $this->assertSame($this->alias, $req->getAlias());

        $req = new AddAccountAliasRequest('', '');
        $req->setId($this->id)
            ->setAlias($this->alias);
        $this->assertSame($this->id, $req->getId());
        $this->assertSame($this->alias, $req->getAlias());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AddAccountAliasRequest id="' . $this->id . '" alias="' . $this->alias . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, AddAccountAliasRequest::class, 'xml'));

        $json = json_encode([
            'id' => $this->id,
            'alias' => $this->alias,
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, AddAccountAliasRequest::class, 'json'));
    }

    public function testAddAccountAliasResponse()
    {
        $res = new AddAccountAliasResponse();

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AddAccountAliasResponse />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, AddAccountAliasResponse::class, 'xml'));

        $json = '{}';
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, AddAccountAliasResponse::class, 'json'));
    }

    public function testAddAccountAliasBody()
    {
        $request = new AddAccountAliasRequest($this->id, $this->alias);
        $response = new AddAccountAliasResponse();

        $body = new AddAccountAliasBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new AddAccountAliasBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:AddAccountAliasRequest id="' . $this->id . '" alias="' . $this->alias . '" />'
                . '<urn:AddAccountAliasResponse />'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, AddAccountAliasBody::class, 'xml'));

        $json = json_encode([
            'AddAccountAliasRequest' => [
                'id' => $this->id,
                'alias' => $this->alias,
                '_jsns' => 'urn:zimbraAdmin',
            ],
            'AddAccountAliasResponse' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, AddAccountAliasBody::class, 'json'));
    }

    public function testAddAccountAliasEnvelope()
    {
        $request = new AddAccountAliasRequest($this->id, $this->alias);
        $response = new AddAccountAliasResponse();
        $body = new AddAccountAliasBody($request, $response);

        $envelope = new AddAccountAliasEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new AddAccountAliasEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:AddAccountAliasRequest id="' . $this->id . '" alias="' . $this->alias . '" />'
                    . '<urn:AddAccountAliasResponse />'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, AddAccountAliasEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'AddAccountAliasRequest' => [
                    'id' => $this->id,
                    'alias' => $this->alias,
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'AddAccountAliasResponse' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, AddAccountAliasEnvelope::class, 'json'));
    }
}
