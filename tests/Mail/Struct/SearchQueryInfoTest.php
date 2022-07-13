<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Struct\WildcardExpansionQueryInfo;
use Zimbra\Mail\Struct\SearchQueryInfo;
use Zimbra\Mail\Struct\SuggestedQueryString;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SearchQueryInfo.
 */
class SearchQueryInfoTest extends ZimbraTestCase
{
    public function testSearchQueryInfo()
    {
        $string = $this->faker->word;
        $numExpanded = $this->faker->randomNumber;

        $suggest = new SuggestedQueryString($string);
        $wildcard = new WildcardExpansionQueryInfo($string, TRUE, $numExpanded);

        $info = new StubSearchQueryInfo([$suggest], [$wildcard]);
        $this->assertSame([$suggest], $info->getSuggests());
        $this->assertSame([$wildcard], $info->getWildcards());

        $info = new StubSearchQueryInfo();
        $info->setSuggests([$suggest])
            ->addSuggest($suggest)
            ->setWildcards([$wildcard])
            ->addWildcard($wildcard);
        $this->assertSame([$suggest, $suggest], $info->getSuggests());
        $this->assertSame([$wildcard, $wildcard], $info->getWildcards());
        $info = new StubSearchQueryInfo([$suggest], [$wildcard]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result xmlns:urn="urn:zimbraMail">
    <urn:suggest>$string</urn:suggest>
    <urn:wildcard str="$string" expanded="true" numExpanded="$numExpanded" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($info, 'xml'));
        $this->assertEquals($info, $this->serializer->deserialize($xml, StubSearchQueryInfo::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
class StubSearchQueryInfo extends SearchQueryInfo
{
}
