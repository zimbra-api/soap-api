<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\SearchGalBody;
use Zimbra\Admin\Message\SearchGalEnvelope;
use Zimbra\Admin\Message\SearchGalRequest;
use Zimbra\Admin\Message\SearchGalResponse;

use Zimbra\Admin\Struct\AdminCustomMetadata;
use Zimbra\Admin\Struct\ContactInfo;
use Zimbra\Admin\Struct\ContactGroupMember;
use Zimbra\Common\Enum\GalSearchType;
use Zimbra\Common\Struct\ContactAttr;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SearchGalTest.
 */
class SearchGalTest extends ZimbraTestCase
{
    public function testSearchGal()
    {
        $domain = $this->faker->domainName;
        $name = $this->faker->word;
        $sortBy = $this->faker->word;
        $limit = mt_rand(1, 100);
        $offset = mt_rand(1, 100);
        $type = GalSearchType::ACCOUNT();
        $galAccountId = $this->faker->uuid;

        $request = new SearchGalRequest($domain, $name, $limit, $type, $galAccountId);
        $this->assertSame($domain, $request->getDomain());
        $this->assertSame($name, $request->getName());
        $this->assertSame($limit, $request->getLimit());
        $this->assertSame($type, $request->getType());
        $this->assertSame($galAccountId, $request->getGalAccountId());

        $request = new SearchGalRequest('');
        $request->setDomain($domain)
            ->setName($name)
            ->setLimit($limit)
            ->setType($type)
            ->setGalAccountId($galAccountId);
        $this->assertSame($domain, $request->getDomain());
        $this->assertSame($name, $request->getName());
        $this->assertSame($limit, $request->getLimit());
        $this->assertSame($type, $request->getType());
        $this->assertSame($galAccountId, $request->getGalAccountId());

        $sortField = $this->faker->word;
        $id = $this->faker->word;
        $folder = $this->faker->word;
        $flags = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;
        $changeDate = mt_rand(1, 99);
        $modifiedSequenceId = mt_rand(1, 99);
        $date = mt_rand(1, 99);
        $revisionId = mt_rand(1, 99);
        $fileAs = $this->faker->word;
        $email = $this->faker->word;
        $email2 = $this->faker->word;
        $email3 = $this->faker->word;
        $type = $this->faker->word;
        $dlist = $this->faker->word;
        $reference = $this->faker->word;

        $section = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $part = $this->faker->word;
        $contentType = $this->faker->word;
        $size = mt_rand(1, 99);
        $contentFilename = $this->faker->word;

        $meta = new AdminCustomMetadata($section);
        $attr = new ContactAttr($key, $value, $part, $contentType, $size, $contentFilename);
        $member = new ContactGroupMember($type, $value);
        $contact = new ContactInfo(
            $sortField, TRUE, $id, $folder, $flags, $tags, $tagNames, $changeDate, $modifiedSequenceId, $date, $revisionId, $fileAs, $email, $email2, $email3, $type, $dlist, $reference, TRUE, [$meta], [$attr], [$member]
        );
        $response = new SearchGalResponse($sortBy, $offset, FALSE, FALSE, [$contact]);
        $this->assertSame($sortBy, $response->getSortBy());
        $this->assertSame($offset, $response->getOffset());
        $this->assertFalse($response->getMore());
        $this->assertFalse($response->getTokenizeKey());
        $this->assertSame([$contact], $response->getContacts());
        $response = new SearchGalResponse();
        $response->setSortBy($sortBy)
            ->setOffset($offset)
            ->setMore(TRUE)
            ->setTokenizeKey(TRUE)
            ->setContacts([$contact]);
        $this->assertSame($sortBy, $response->getSortBy());
        $this->assertSame($offset, $response->getOffset());
        $this->assertTrue($response->getMore());
        $this->assertTrue($response->getTokenizeKey());
        $this->assertSame([$contact], $response->getContacts());

        $body = new SearchGalBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new SearchGalBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new SearchGalEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new SearchGalEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:SearchGalRequest domain="$domain" name="$name" limit="$limit" type="account" galAcctId="$galAccountId" />
        <urn:SearchGalResponse sortBy="$sortBy" offset="$offset" more="true" tokenizeKey="true">
            <cn sf="$sortField" exp="true" id="$id" l="$folder" f="$flags" t="$tags" tn="$tagNames" md="$changeDate" ms="$modifiedSequenceId" d="$date" rev="$revisionId" fileAsStr="$fileAs" email="$email" email2="$email2" email3="$email3" type="$type" dlist="$dlist" ref="$reference" tooManyMembers="true">
                <meta section="$section" />
                <a n="$key" part="$part" ct="$contentType" s="$size" filename="$contentFilename">$value</a>
                <m type="$type" value="$value" />
            </cn>
        </urn:SearchGalResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, SearchGalEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'SearchGalRequest' => [
                    'domain' => $domain,
                    'name' => $name,
                    'limit' => $limit,
                    'type' => 'account',
                    'galAcctId' => $galAccountId,
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'SearchGalResponse' => [
                    'sortBy' => $sortBy,
                    'offset' => $offset,
                    'more' => TRUE,
                    'tokenizeKey' => TRUE,
                    'cn' => [
                        [
                            'sf' => $sortField,
                            'exp' => TRUE,
                            'id' => $id,
                            'l' => $folder,
                            'f' => $flags,
                            't' => $tags,
                            'tn' => $tagNames,
                            'md' => $changeDate,
                            'ms' => $modifiedSequenceId,
                            'd' => $date,
                            'rev' => $revisionId,
                            'fileAsStr' => $fileAs,
                            'email' => $email,
                            'email2' => $email2,
                            'email3' => $email3,
                            'type' => $type,
                            'dlist' => $dlist,
                            'ref' => $reference,
                            'tooManyMembers' => TRUE,
                            'meta' => [
                                [
                                    'section' => $section,
                                ]
                            ],
                            'a' => [
                                [
                                    'n' => $key,
                                    '_content' => $value,
                                    'part' => $part,
                                    'ct' => $contentType,
                                    's' => $size,
                                    'filename' => $contentFilename,
                                ],
                            ],
                            'm' => [
                                [
                                    'type' => $type,
                                    'value' => $value,
                                ]
                            ],
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, SearchGalEnvelope::class, 'json'));
    }
}
