<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\ModifyAdminSavedSearchesBody;
use Zimbra\Admin\Message\ModifyAdminSavedSearchesEnvelope;
use Zimbra\Admin\Message\ModifyAdminSavedSearchesRequest;
use Zimbra\Admin\Message\ModifyAdminSavedSearchesResponse;
use Zimbra\Common\Struct\NamedValue;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ModifyAdminSavedSearchesTest.
 */
class ModifyAdminSavedSearchesTest extends ZimbraTestCase
{
    public function testModifyAdminSavedSearches()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $search = new NamedValue($name, $value);

        $request = new ModifyAdminSavedSearchesRequest([$search]);
        $this->assertSame([$search], $request->getSearches());
        $request = new ModifyAdminSavedSearchesRequest();
        $request->setSearches([$search])
            ->addSearch($search);
        $this->assertSame([$search, $search], $request->getSearches());
        $request->setSearches([$search]);

        $response = new ModifyAdminSavedSearchesResponse();

        $body = new ModifyAdminSavedSearchesBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ModifyAdminSavedSearchesBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ModifyAdminSavedSearchesEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new ModifyAdminSavedSearchesEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ModifyAdminSavedSearchesRequest>
            <urn:search name="$name">$value</urn:search>
        </urn:ModifyAdminSavedSearchesRequest>
        <urn:ModifyAdminSavedSearchesResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ModifyAdminSavedSearchesEnvelope::class, 'xml'));
    }
}
