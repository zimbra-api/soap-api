<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\AddAccountAliasBody;
use Zimbra\Admin\Message\AddAccountAliasEnvelope;
use Zimbra\Admin\Message\AddAccountAliasRequest;
use Zimbra\Admin\Message\AddAccountAliasResponse;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AddAccountAliasTest.
 */
class AddAccountAliasTest extends ZimbraTestCase
{
    public function testAddAccountAlias()
    {
        $id = $this->faker->uuid;
        $alias = $this->faker->email;

        $request = new AddAccountAliasRequest($id, $alias);
        $this->assertSame($id, $request->getId());
        $this->assertSame($alias, $request->getAlias());

        $request = new AddAccountAliasRequest();
        $request->setId($id)
            ->setAlias($alias);
        $this->assertSame($id, $request->getId());
        $this->assertSame($alias, $request->getAlias());

        $response = new AddAccountAliasResponse();

        $body = new AddAccountAliasBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new AddAccountAliasBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new AddAccountAliasEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new AddAccountAliasEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:AddAccountAliasRequest id="$id" alias="$alias" />
        <urn:AddAccountAliasResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, AddAccountAliasEnvelope::class, 'xml'));
    }
}
