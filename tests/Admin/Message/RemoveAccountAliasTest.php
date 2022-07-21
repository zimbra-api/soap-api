<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\RemoveAccountAliasBody;
use Zimbra\Admin\Message\RemoveAccountAliasEnvelope;
use Zimbra\Admin\Message\RemoveAccountAliasRequest;
use Zimbra\Admin\Message\RemoveAccountAliasResponse;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for RemoveAccountAliasTest.
 */
class RemoveAccountAliasTest extends ZimbraTestCase
{
    public function testRemoveAccountAlias()
    {
        $id = $this->faker->uuid;
        $alias = $this->faker->email;

        $request = new RemoveAccountAliasRequest($id, $alias);
        $this->assertSame($id, $request->getId());
        $this->assertSame($alias, $request->getAlias());

        $request = new RemoveAccountAliasRequest();
        $request->setId($id)
            ->setAlias($alias);
        $this->assertSame($id, $request->getId());
        $this->assertSame($alias, $request->getAlias());

        $response = new RemoveAccountAliasResponse();

        $body = new RemoveAccountAliasBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new RemoveAccountAliasBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new RemoveAccountAliasEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new RemoveAccountAliasEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:RemoveAccountAliasRequest id="$id" alias="$alias" />
        <urn:RemoveAccountAliasResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, RemoveAccountAliasEnvelope::class, 'xml'));
    }
}
