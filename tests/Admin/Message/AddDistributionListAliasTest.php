<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\AddDistributionListAliasBody;
use Zimbra\Admin\Message\AddDistributionListAliasEnvelope;
use Zimbra\Admin\Message\AddDistributionListAliasRequest;
use Zimbra\Admin\Message\AddDistributionListAliasResponse;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AddDistributionListAlias.
 */
class AddDistributionListAliasTest extends ZimbraTestCase
{
    public function testAddDistributionListAlias()
    {
        $id = $this->faker->uuid;
        $alias = $this->faker->word;

        $request = new AddDistributionListAliasRequest($id, $alias);
        $this->assertSame($id, $request->getId());
        $this->assertSame($alias, $request->getAlias());

        $request = new AddDistributionListAliasRequest('', '');
        $request->setId($id)
            ->setAlias($alias);
        $this->assertSame($id, $request->getId());
        $this->assertSame($alias, $request->getAlias());

        $response = new AddDistributionListAliasResponse();

        $body = new AddDistributionListAliasBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new AddDistributionListAliasBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new AddDistributionListAliasEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new AddDistributionListAliasEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:AddDistributionListAliasRequest id="$id" alias="$alias" />
        <urn:AddDistributionListAliasResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, AddDistributionListAliasEnvelope::class, 'xml'));
    }
}
