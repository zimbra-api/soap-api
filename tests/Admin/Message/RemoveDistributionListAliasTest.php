<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\RemoveDistributionListAliasBody;
use Zimbra\Admin\Message\RemoveDistributionListAliasEnvelope;
use Zimbra\Admin\Message\RemoveDistributionListAliasRequest;
use Zimbra\Admin\Message\RemoveDistributionListAliasResponse;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for RemoveDistributionListAlias.
 */
class RemoveDistributionListAliasTest extends ZimbraTestCase
{
    public function testRemoveDistributionListAlias()
    {
        $id = $this->faker->uuid;
        $alias = $this->faker->email;

        $request = new RemoveDistributionListAliasRequest($id, $alias);
        $this->assertSame($id, $request->getId());
        $this->assertSame($alias, $request->getAlias());

        $request = new RemoveDistributionListAliasRequest();
        $request->setId($id)
            ->setAlias($alias);
        $this->assertSame($id, $request->getId());
        $this->assertSame($alias, $request->getAlias());

        $response = new RemoveDistributionListAliasResponse();

        $body = new RemoveDistributionListAliasBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new RemoveDistributionListAliasBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new RemoveDistributionListAliasEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new RemoveDistributionListAliasEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:RemoveDistributionListAliasRequest id="$id" alias="$alias" />
        <urn:RemoveDistributionListAliasResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, RemoveDistributionListAliasEnvelope::class, 'xml'));
    }
}
