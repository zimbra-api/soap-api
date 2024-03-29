<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetAdminSavedSearchesBody;
use Zimbra\Admin\Message\GetAdminSavedSearchesEnvelope;
use Zimbra\Admin\Message\GetAdminSavedSearchesRequest;
use Zimbra\Admin\Message\GetAdminSavedSearchesResponse;
use Zimbra\Common\Struct\NamedElement;
use Zimbra\Common\Struct\NamedValue;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetAdminSavedSearchesTest.
 */
class GetAdminSavedSearchesTest extends ZimbraTestCase
{
    public function testGetAdminSavedSearches()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;

        $search = new NamedElement($name);
        $request = new GetAdminSavedSearchesRequest([$search]);
        $this->assertSame([$search], $request->getSearches());
        $request = new GetAdminSavedSearchesRequest();
        $request->setSearches([$search])
            ->addSearch($search);
        $this->assertSame([$search, $search], $request->getSearches());
        $request->setSearches([$search]);

        $search = new NamedValue($name, $value);
        $response = new GetAdminSavedSearchesResponse([$search]);
        $this->assertSame([$search], $response->getSearches());
        $response = new GetAdminSavedSearchesResponse();
        $response->setSearches([$search]);
        $this->assertSame([$search], $response->getSearches());

        $body = new GetAdminSavedSearchesBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetAdminSavedSearchesBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetAdminSavedSearchesEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetAdminSavedSearchesEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAdminSavedSearchesRequest>
            <urn:search name="$name" />
        </urn:GetAdminSavedSearchesRequest>
        <urn:GetAdminSavedSearchesResponse>
            <urn:search name="$name">$value</urn:search>
        </urn:GetAdminSavedSearchesResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAdminSavedSearchesEnvelope::class, 'xml'));
    }
}
