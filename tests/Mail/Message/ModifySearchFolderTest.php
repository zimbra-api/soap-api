<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\ItemType;
use Zimbra\Common\Enum\SearchSortBy;

use Zimbra\Mail\Message\ModifySearchFolderEnvelope;
use Zimbra\Mail\Message\ModifySearchFolderBody;
use Zimbra\Mail\Message\ModifySearchFolderRequest;
use Zimbra\Mail\Message\ModifySearchFolderResponse;

use Zimbra\Mail\Struct\ModifySearchFolderSpec;
use Zimbra\Mail\Struct\SearchFolder;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ModifySearchFolder.
 */
class ModifySearchFolderTest extends ZimbraTestCase
{
    public function testModifySearchFolder()
    {
        $id = $this->faker->uuid;
        $uuid = $this->faker->uuid;
        $query = $this->faker->word;
        $searchTypes = implode(',', [ItemType::MESSAGE(), ItemType::CONVERSATION()]);
        $sortBy = SearchSortBy::DATE_DESC();

        $newSearch = new ModifySearchFolderSpec(
            $id, $query, $searchTypes, $sortBy
        );
        $request = new ModifySearchFolderRequest($newSearch);
        $this->assertSame($newSearch, $request->getSearchFolder());
        $request = new ModifySearchFolderRequest(new ModifySearchFolderSpec());
        $request->setSearchFolder($newSearch);
        $this->assertSame($newSearch, $request->getSearchFolder());

        $search = new SearchFolder(
            $id,
            $uuid,
            $query,
            $sortBy,
            $searchTypes
        );
        $response = new ModifySearchFolderResponse($search);
        $this->assertSame($search, $response->getSearchFolder());
        $response = new ModifySearchFolderResponse();
        $response->setSearchFolder($search);
        $this->assertSame($search, $response->getSearchFolder());

        $body = new ModifySearchFolderBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ModifySearchFolderBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ModifySearchFolderEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new ModifySearchFolderEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ModifySearchFolderRequest>
            <urn:search id="$id" query="$query" types="$searchTypes" sortBy="dateDesc" />
        </urn:ModifySearchFolderRequest>
        <urn:ModifySearchFolderResponse>
            <urn:search id="$id" uuid="$uuid" query="$query" sortBy="dateDesc" types="$searchTypes" />
        </urn:ModifySearchFolderResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ModifySearchFolderEnvelope::class, 'xml'));
    }
}
