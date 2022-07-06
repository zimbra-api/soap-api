<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\ItemType;
use Zimbra\Common\Enum\SearchSortBy;

use Zimbra\Mail\Message\GetSearchFolderEnvelope;
use Zimbra\Mail\Message\GetSearchFolderBody;
use Zimbra\Mail\Message\GetSearchFolderRequest;
use Zimbra\Mail\Message\GetSearchFolderResponse;

use Zimbra\Mail\Struct\SearchFolder;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetSearchFolder.
 */
class GetSearchFolderTest extends ZimbraTestCase
{
    public function testGetSearchFolder()
    {
        $id = $this->faker->uuid;
        $uuid = $this->faker->uuid;
        $query = $this->faker->word;
        $sortBy = SearchSortBy::DATE_DESC();
        $types = implode(',', [ItemType::MESSAGE(), ItemType::CONVERSATION()]);
        $search = new SearchFolder(
            $id,
            $uuid,
            $query,
            $sortBy,
            $types
        );

        $request = new GetSearchFolderRequest();
        $response = new GetSearchFolderResponse([$search]);
        $this->assertSame([$search], $response->getSearchFolders());
        $response = new GetSearchFolderResponse();
        $response->setSearchFolders([$search])
            ->addSearchFolder($search);
        $this->assertSame([$search, $search], $response->getSearchFolders());
        $response = new GetSearchFolderResponse([$search]);

        $body = new GetSearchFolderBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetSearchFolderBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetSearchFolderEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetSearchFolderEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetSearchFolderRequest />
        <urn:GetSearchFolderResponse>
            <urn:search id="$id" uuid="$uuid" query="$query" sortBy="dateDesc" types="$types" />
        </urn:GetSearchFolderResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetSearchFolderEnvelope::class, 'xml'));
    }
}
