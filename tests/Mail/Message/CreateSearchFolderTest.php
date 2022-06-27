<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\ItemType;
use Zimbra\Common\Enum\SearchSortBy;

use Zimbra\Mail\Message\CreateSearchFolderEnvelope;
use Zimbra\Mail\Message\CreateSearchFolderBody;
use Zimbra\Mail\Message\CreateSearchFolderRequest;
use Zimbra\Mail\Message\CreateSearchFolderResponse;

use Zimbra\Mail\Struct\NewSearchFolderSpec;
use Zimbra\Mail\Struct\SearchFolder;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CreateSearchFolder.
 */
class CreateSearchFolderTest extends ZimbraTestCase
{
    public function testCreateSearchFolder()
    {
        $id = $this->faker->uuid;
        $uuid = $this->faker->uuid;
        $name = $this->faker->word;
        $query = $this->faker->word;
        $searchTypes = implode(',', [ItemType::MESSAGE(), ItemType::CONVERSATION()]);
        $sortBy = SearchSortBy::DATE_DESC();
        $flags = $this->faker->word;
        $color = $this->faker->numberBetween(0, 127);
        $rgb = $this->faker->hexcolor;
        $parentFolderId = $this->faker->uuid;

        $newSearch = new NewSearchFolderSpec(
            $name, $query, $searchTypes, $sortBy, $flags, $color, $rgb, $parentFolderId
        );
        $request = new CreateSearchFolderRequest($newSearch);
        $this->assertSame($newSearch, $request->getSearchFolder());
        $request = new CreateSearchFolderRequest(new NewSearchFolderSpec('', ''));
        $request->setSearchFolder($newSearch);
        $this->assertSame($newSearch, $request->getSearchFolder());

        $search = new SearchFolder(
            $id,
            $uuid,
            $query,
            $sortBy,
            $searchTypes
        );
        $response = new CreateSearchFolderResponse($search);
        $this->assertSame($search, $response->getSearchFolder());
        $response = new CreateSearchFolderResponse(new SearchFolder('', ''));
        $response->setSearchFolder($search);
        $this->assertSame($search, $response->getSearchFolder());

        $body = new CreateSearchFolderBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new CreateSearchFolderBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CreateSearchFolderEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new CreateSearchFolderEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:CreateSearchFolderRequest>
            <search name="$name" query="$query" types="$searchTypes" sortBy="dateDesc" f="$flags" color="$color" rgb="$rgb" l="$parentFolderId" />
        </urn:CreateSearchFolderRequest>
        <urn:CreateSearchFolderResponse>
            <search id="$id" uuid="$uuid" query="$query" sortBy="dateDesc" types="$searchTypes" />
        </urn:CreateSearchFolderResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CreateSearchFolderEnvelope::class, 'xml'));
    }
}
