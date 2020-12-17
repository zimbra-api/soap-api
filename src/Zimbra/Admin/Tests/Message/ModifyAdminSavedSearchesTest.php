<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\ModifyAdminSavedSearchesBody;
use Zimbra\Admin\Message\ModifyAdminSavedSearchesEnvelope;
use Zimbra\Admin\Message\ModifyAdminSavedSearchesRequest;
use Zimbra\Admin\Message\ModifyAdminSavedSearchesResponse;
use Zimbra\Struct\NamedValue;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ModifyAdminSavedSearchesTest.
 */
class ModifyAdminSavedSearchesTest extends ZimbraStructTestCase
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
            <search name="$name">$value</search>
        </urn:ModifyAdminSavedSearchesRequest>
        <urn:ModifyAdminSavedSearchesResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ModifyAdminSavedSearchesEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'ModifyAdminSavedSearchesRequest' => [
                    'search' => [
                        [
                            'name' => $name,
                            '_content' => $value,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'ModifyAdminSavedSearchesResponse' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, ModifyAdminSavedSearchesEnvelope::class, 'json'));
    }
}
