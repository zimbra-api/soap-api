<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

use Zimbra\Account\Message\SearchGalBody;
use Zimbra\Account\Message\SearchGalEnvelope;
use Zimbra\Account\Message\SearchGalRequest;
use Zimbra\Account\Message\SearchGalResponse;

use Zimbra\Account\Struct\AccountCustomMetadata;
use Zimbra\Account\Struct\ContactInfo;
use Zimbra\Account\Struct\ContactGroupMember;
use Zimbra\Account\Struct\{EntrySearchFilterInfo, EntrySearchFilterMultiCond, EntrySearchFilterSingleCond};

use Zimbra\Common\Enum\ConditionOperator as CondOp;
use Zimbra\Common\Enum\GalSearchType;
use Zimbra\Common\Enum\MemberOfSelector;

use Zimbra\Common\Struct\ContactAttr;
use Zimbra\Common\Struct\CursorInfo;
use Zimbra\Common\Struct\KeyValuePair;
use Zimbra\Tests\ZimbraTestCase;


/**
 * Testcase class for SearchGalTest.
 */
class SearchGalTest extends ZimbraTestCase
{
    public function testSearchGal()
    {
        $sortBy = $this->faker->word;
        $limit = $this->faker->randomNumber;
        $offset = $this->faker->randomNumber;
        $locale = $this->faker->word;
        $query = $this->faker->word;
        $galAccountId = $this->faker->uuid;
        $ref = $this->faker->word;
        $name = $this->faker->word;
        $searchType = GalSearchType::ALL();
        $needIsMember = MemberOfSelector::ALL();
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $attr = $this->faker->word;
        $sortVal = $this->faker->word;
        $endSortVal = $this->faker->word;

        $sortField = $this->faker->word;
        $folder = $this->faker->word;
        $flags = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;
        $changeDate = $this->faker->unixTime;
        $modifiedSequenceId = $this->faker->randomNumber;
        $date = $this->faker->unixTime;
        $revisionId = $this->faker->randomNumber;
        $fileAs = $this->faker->word;
        $email = $this->faker->email;
        $email2 = $this->faker->email;
        $email3 = $this->faker->email;
        $type = $this->faker->word;
        $dlist = $this->faker->word;
        $reference = $this->faker->word;

        $section = $this->faker->word;
        $part = $this->faker->word;
        $contentType = $this->faker->mimeType;
        $size = $this->faker->randomNumber;
        $contentFilename = $this->faker->word;

        $cursor = new CursorInfo($id, $sortVal, $endSortVal, TRUE);

        $cond = new EntrySearchFilterSingleCond($attr, CondOp::EQUAL(), $value, TRUE);
        $singleCond = new EntrySearchFilterSingleCond($attr, CondOp::GREATER_EQUAL(), $value, FALSE);
        $multiConds = new EntrySearchFilterMultiCond(FALSE, TRUE, [$singleCond]);
        $conds = new EntrySearchFilterMultiCond(TRUE, FALSE, [$cond, $multiConds]);
        $searchFilter = new EntrySearchFilterInfo($conds);

        $request = new SearchGalRequest(
            $cursor, $searchFilter, $ref, $name, $searchType, FALSE, FALSE, $needIsMember, FALSE, $galAccountId, FALSE, $sortBy, $limit, $offset, $locale, $query
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
        $this->assertSame($query, $request->getQuery());

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
            ->setLocale($locale)
            ->setQuery($query);
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
        $this->assertSame($query, $request->getQuery());

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
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:SearchGalRequest ref="$ref" name="$name" type="all" needExp="true" needIsOwner="true" needIsMember="all" needSMIMECerts="true" galAcctId="$galAccountId" quick="true" sortBy="$sortBy" limit="$limit" offset="$offset">
            <urn:locale>$locale</urn:locale>
            <urn:cursor id="$id" sortVal="$sortVal" endSortVal="$endSortVal" includeOffset="true" />
            <urn:query>$query</urn:query>
            <urn:searchFilter>
                <urn:conds not="true" or="false">
                    <urn:conds not="false" or="true">
                        <urn:cond attr="$attr" op="ge" value="$value" not="false" />
                    </urn:conds>
                    <urn:cond attr="$attr" op="eq" value="$value" not="true" />
                </urn:conds>
            </urn:searchFilter>
        </urn:SearchGalRequest>
        <urn:SearchGalResponse sortBy="$sortBy" offset="$offset" more="true" paginationSupported="true" tokenizeKey="true">
            <urn:cn sf="$sortField" exp="true" id="$id" l="$folder" f="$flags" t="$tags" tn="$tagNames" md="$changeDate" ms="$modifiedSequenceId" d="$date" rev="$revisionId" fileAsStr="$fileAs" email="$email" email2="$email2" email3="$email3" type="$type" dlist="$dlist" ref="$reference" tooManyMembers="false" isOwner="true" isMember="false">
                <urn:meta section="$section" />
                <urn:a n="$key" part="$part" ct="$contentType" s="$size" filename="$contentFilename">$value</urn:a>
                <urn:m type="$type" value="$value" />
            </urn:cn>
        </urn:SearchGalResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, SearchGalEnvelope::class, 'xml'));
    }
}
