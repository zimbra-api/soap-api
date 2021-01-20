<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Message;

use Zimbra\Common\SerializerFactory;
use Zimbra\Account\SerializerHandler;

use Zimbra\Account\Message\SearchGalBody;
use Zimbra\Account\Message\SearchGalEnvelope;
use Zimbra\Account\Message\SearchGalRequest;
use Zimbra\Account\Message\SearchGalResponse;

use Zimbra\Account\Struct\AccountCustomMetadata;
use Zimbra\Account\Struct\ContactInfo;
use Zimbra\Account\Struct\ContactGroupMember;
use Zimbra\Account\Struct\{EntrySearchFilterInfo, EntrySearchFilterMultiCond, EntrySearchFilterSingleCond};

use Zimbra\Enum\ConditionOperator as CondOp;
use Zimbra\Enum\GalSearchType;
use Zimbra\Enum\MemberOfSelector;

use Zimbra\Struct\ContactAttr;
use Zimbra\Struct\CursorInfo;
use Zimbra\Struct\KeyValuePair;
use Zimbra\Struct\Tests\ZimbraStructTestCase;


/**
 * Testcase class for SearchGalTest.
 */
class SearchGalTest extends ZimbraStructTestCase
{
    protected function setUp(): void
    {
        SerializerFactory::addSerializerHandler(new SerializerHandler);
        parent::setUp();
    }

    public function testSearchGal()
    {
        $sortBy = $this->faker->word;
        $limit = mt_rand(1, 100);
        $offset = mt_rand(1, 100);
        $locale = $this->faker->word;
        $galAccountId = $this->faker->uuid;
        $ref = $this->faker->word;
        $name = $this->faker->word;
        $searchType = GalSearchType::ALL();
        $needIsMember = MemberOfSelector::ALL();
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value= $this->faker->word;
        $attr = $this->faker->word;
        $sortVal = $this->faker->word;
        $endSortVal = $this->faker->word;

        $sortField = $this->faker->word;
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
        $part = $this->faker->word;
        $contentType = $this->faker->word;
        $size = mt_rand(1, 99);
        $contentFilename = $this->faker->word;

        $cursor = new CursorInfo($id, $sortVal, $endSortVal, TRUE);

        $cond = new EntrySearchFilterSingleCond($attr, CondOp::EQ(), $value, TRUE);
        $singleCond = new EntrySearchFilterSingleCond($attr, CondOp::GE(), $value, FALSE);
        $multiConds = new EntrySearchFilterMultiCond(FALSE, TRUE, [$singleCond]);
        $conds = new EntrySearchFilterMultiCond(TRUE, FALSE, [$cond, $multiConds]);
        $searchFilter = new EntrySearchFilterInfo($conds);

        $request = new SearchGalRequest(
            $cursor, $searchFilter, $ref, $name, $searchType, FALSE, FALSE, $needIsMember, FALSE, $galAccountId, FALSE, $sortBy, $limit, $offset, $locale
        );
        $this->assertSame($cursor, $request->getCursor());
        $this->assertSame($searchFilter, $request->getSearchFilter());
        $this->assertSame($ref, $request->getRef());
        $this->assertSame($name, $request->getName());
        $this->assertSame($searchType, $request->getType());
        $this->assertFalse($request->getNeedCanExpand());
        $this->assertFalse($request->getNeedIsOwner());
        $this->assertSame($needIsMember, $request->getNeedIsMember());
        $this->assertFalse($request->getNeedSMIMECerts());
        $this->assertSame($galAccountId, $request->getGalAccountId());
        $this->assertFalse($request->getQuick());
        $this->assertSame($sortBy, $request->getSortBy());
        $this->assertSame($limit, $request->getLimit());
        $this->assertSame($offset, $request->getOffset());
        $this->assertSame($locale, $request->getLocale());

        $request = new SearchGalRequest();
        $request->setCursor($cursor)
            ->setSearchFilter($searchFilter)
            ->setRef($ref)
            ->setName($name)
            ->setType($searchType)
            ->setNeedCanExpand(TRUE)
            ->setNeedIsOwner(TRUE)
            ->setNeedIsMember($needIsMember)
            ->setNeedSMIMECerts(TRUE)
            ->setGalAccountId($galAccountId)
            ->setQuick(TRUE)
            ->setSortBy($sortBy)
            ->setLimit($limit)
            ->setOffset($offset)
            ->setLocale($locale);
        $this->assertSame($cursor, $request->getCursor());
        $this->assertSame($searchFilter, $request->getSearchFilter());
        $this->assertSame($ref, $request->getRef());
        $this->assertSame($name, $request->getName());
        $this->assertSame($searchType, $request->getType());
        $this->assertTrue($request->getNeedCanExpand());
        $this->assertTrue($request->getNeedIsOwner());
        $this->assertSame($needIsMember, $request->getNeedIsMember());
        $this->assertTrue($request->getNeedSMIMECerts());
        $this->assertSame($galAccountId, $request->getGalAccountId());
        $this->assertTrue($request->getQuick());
        $this->assertSame($sortBy, $request->getSortBy());
        $this->assertSame($limit, $request->getLimit());
        $this->assertSame($offset, $request->getOffset());
        $this->assertSame($locale, $request->getLocale());

        $metadata = new AccountCustomMetadata($section);
        $contactAttr = new ContactAttr($key, $value, $part, $contentType, $size, $contentFilename);
        $contactMember = new ContactGroupMember($type, $value);

        $contact = new ContactInfo(
            $sortField, TRUE, $id, $folder, $flags, $tags, $tagNames, $changeDate, $modifiedSequenceId, $date, $revisionId, $fileAs, $email, $email2, $email3, $type, $dlist, $reference, FALSE, [$metadata], [$contactAttr], [$contactMember], TRUE, FALSE
        );

        $response = new SearchGalResponse($sortBy, $offset, FALSE, FALSE, FALSE, [$contact]);
        $this->assertSame($sortBy, $response->getSortBy());
        $this->assertSame($offset, $response->getOffset());
        $this->assertFalse($response->getMore());
        $this->assertFalse($response->getPagingSupported());
        $this->assertFalse($response->getTokenizeKey());
        $this->assertSame([$contact], $response->getContacts());

        $response = new SearchGalResponse();
        $response->setContacts([$contact])
            ->addContact($contact)
            ->setSortBy($sortBy)
            ->setOffset($offset)
            ->setMore(TRUE)
            ->setPagingSupported(TRUE)
            ->setTokenizeKey(TRUE);
        $this->assertSame($sortBy, $response->getSortBy());
        $this->assertSame($offset, $response->getOffset());
        $this->assertTrue($response->getMore());
        $this->assertTrue($response->getPagingSupported());
        $this->assertTrue($response->getTokenizeKey());
        $this->assertSame([$contact, $contact], $response->getContacts());
        $response->setContacts([$contact]);

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
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:SearchGalRequest ref="$ref" name="$name" type="all" needExp="true" needIsOwner="true" needIsMember="all" needSMIMECerts="true" galAcctId="$galAccountId" quick="true" sortBy="$sortBy" limit="$limit" offset="$offset">
            <locale>$locale</locale>
            <cursor id="$id" sortVal="$sortVal" endSortVal="$endSortVal" includeOffset="true" />
            <searchFilter>
                <conds not="true" or="false">
                    <conds not="false" or="true">
                        <cond attr="$attr" op="ge" value="$value" not="false" />
                    </conds>
                    <cond attr="$attr" op="eq" value="$value" not="true" />
                </conds>
            </searchFilter>
        </urn:SearchGalRequest>
        <urn:SearchGalResponse sortBy="$sortBy" offset="$offset" more="true" paginationSupported="true" tokenizeKey="true">
            <cn sf="$sortField" exp="true" id="$id" l="$folder" f="$flags" t="$tags" tn="$tagNames" md="$changeDate" ms="$modifiedSequenceId" d="$date" rev="$revisionId" fileAsStr="$fileAs" email="$email" email2="$email2" email3="$email3" type="$type" dlist="$dlist" ref="$reference" tooManyMembers="false" isOwner="true" isMember="false">
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
                    'ref' => $ref,
                    'name' => $name,
                    'type' => 'all',
                    'needExp' => TRUE,
                    'needIsOwner' => TRUE,
                    'needIsMember' => 'all',
                    'needSMIMECerts' => TRUE,
                    'galAcctId' => $galAccountId,
                    'quick' => TRUE,
                    'sortBy' => $sortBy,
                    'limit' => $limit,
                    'offset' => $offset,
                    'locale' => [
                        '_content' => $locale,
                    ],
                    'cursor' => [
                        'id' => $id,
                        'sortVal' => $sortVal,
                        'endSortVal' => $endSortVal,
                        'includeOffset' => TRUE,
                    ],
                    'searchFilter' => [
                        'conds' => [
                            'not' => TRUE,
                            'or' => FALSE,
                            'conds' => [
                                [
                                    'not' => FALSE,
                                    'or' => TRUE,
                                    'cond' => [
                                        [
                                            'attr' => $attr,
                                            'op' => 'ge',
                                            'value' => $value,
                                            'not' => FALSE,
                                        ],
                                    ],
                                ],
                            ],
                            'cond' => [
                                [
                                    'attr' => $attr,
                                    'op' => 'eq',
                                    'value' => $value,
                                    'not' => TRUE,
                                ],
                            ],
                        ]
                    ],
                    '_jsns' => 'urn:zimbraAccount',
                ],
                'SearchGalResponse' => [
                    'sortBy' => $sortBy,
                    'offset' => $offset,
                    'more' => TRUE,
                    'paginationSupported' => TRUE,
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
                            'tooManyMembers' => FALSE,
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
                            'isOwner' => TRUE,
                            'isMember' => FALSE,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAccount',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, SearchGalEnvelope::class, 'json'));
    }
}
