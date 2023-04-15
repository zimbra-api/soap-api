<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\{ComparisonComparator, LoggingLevel, MatchType, RelationalComparator};

use Zimbra\Mail\Struct\FilterVariable;
use Zimbra\Mail\Struct\FilterVariables;
use Zimbra\Mail\Struct\KeepAction;
use Zimbra\Mail\Struct\DiscardAction;
use Zimbra\Mail\Struct\FileIntoAction;
use Zimbra\Mail\Struct\FlagAction;
use Zimbra\Mail\Struct\TagAction;
use Zimbra\Mail\Struct\RedirectAction;
use Zimbra\Mail\Struct\ReplyAction;
use Zimbra\Mail\Struct\NotifyAction;
use Zimbra\Mail\Struct\RFCCompliantNotifyAction;
use Zimbra\Mail\Struct\StopAction;
use Zimbra\Mail\Struct\RejectAction;
use Zimbra\Mail\Struct\ErejectAction;
use Zimbra\Mail\Struct\LogAction;
use Zimbra\Mail\Struct\AddheaderAction;
use Zimbra\Mail\Struct\DeleteheaderAction;
use Zimbra\Mail\Struct\ReplaceheaderAction;
use Zimbra\Mail\Struct\EditheaderTest;

use Zimbra\Mail\Struct\FilterActions;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for FilterActions.
 */
class FilterActionsTest extends ZimbraTestCase
{
    public function testFilterActions()
    {
        $index = $this->faker->randomNumber;
        $header = $this->faker->word;
        $name = $this->faker->word;
        $value = $this->faker->word;
        $time = $this->faker->time;
        $flag = $this->faker->word;
        $tag = $this->faker->word;
        $method = $this->faker->word;
        $folder = $this->faker->word;
        $address = $this->faker->word;
        $content = $this->faker->word;
        $subject = $this->faker->word;
        $maxBodySize = $this->faker->randomNumber;
        $origHeaders = $this->faker->word;
        $from = $this->faker->word;
        $importance = $this->faker->word;
        $options = $this->faker->word;
        $message = $this->faker->word;
        $headerName = $this->faker->word;
        $headerValue = $this->faker->word;
        $offset = $this->faker->randomNumber;
        $newName = $this->faker->word;
        $newValue = $this->faker->word;

        $filterVariables = new FilterVariables($index, [new FilterVariable($name, $value)]);
        $actionKeep = new KeepAction($index);
        $actionDiscard = new DiscardAction($index);
        $actionFileInto = new FileIntoAction($index, $folder, TRUE);
        $actionFlag = new FlagAction($index, $flag);
        $actionTag = new TagAction($index, $tag, TRUE);
        $actionRedirect = new RedirectAction($index, $address, TRUE);
        $actionReply = new ReplyAction($index, $content, TRUE);
        $actionNotify = new NotifyAction($index, $address, $subject, $maxBodySize, $content, $origHeaders);
        $actionRFCCompliantNotify = new RFCCompliantNotifyAction($index, $from, $importance, $options, $message, $method);
        $actionStop = new StopAction($index);
        $actionReject = new RejectAction($index, $content);
        $actionEreject = new ErejectAction($index, $content);
        $actionLog = new LogAction($index, LoggingLevel::INFO, $content);
        $actionAddheader = new AddheaderAction($index, $headerName, $headerValue, TRUE);
        $actionDeleteheader = new DeleteheaderAction(
            $index, TRUE, $offset
            , new EditheaderTest(MatchType::IS, TRUE, TRUE, RelationalComparator::EQUAL, ComparisonComparator::OCTET, $headerName, [$headerValue])
        );
        $actionReplaceheader = new ReplaceheaderAction(
            $index, TRUE, $offset,
            new EditheaderTest(MatchType::IS, TRUE, TRUE, RelationalComparator::EQUAL, ComparisonComparator::OCTET, $headerName, [$headerValue]),
            $newName, $newValue
        );

        $filterActions = new StubFilterActions([
            $filterVariables,
            $actionKeep,
            $actionDiscard,
            $actionFileInto,
            $actionFlag,
            $actionTag,
            $actionRedirect,
            $actionReply,
            $actionNotify,
            $actionRFCCompliantNotify,
            $actionStop,
            $actionReject,
            $actionEreject,
            $actionLog,
            $actionAddheader,
            $actionDeleteheader,
            $actionReplaceheader,
        ]);
        $this->assertSame([
            $filterVariables,
            $actionKeep,
            $actionDiscard,
            $actionFileInto,
            $actionFlag,
            $actionTag,
            $actionRedirect,
            $actionReply,
            $actionNotify,
            $actionRFCCompliantNotify,
            $actionStop,
            $actionReject,
            $actionEreject,
            $actionLog,
            $actionAddheader,
            $actionDeleteheader,
            $actionReplaceheader,
        ], array_values($filterActions->getFilterActions()));

        $filterActions = new StubFilterActions();
        $filterActions->setFilterActions([
                $filterVariables,
                $actionKeep,
                $actionDiscard,
                $actionFileInto,
                $actionFlag,
                $actionTag,
                $actionRedirect,
                $actionReply,
                $actionNotify,
                $actionRFCCompliantNotify,
                $actionStop,
                $actionReject,
                $actionEreject,
                $actionLog,
            ])
            ->addFilterAction($actionAddheader)
            ->addFilterAction($actionDeleteheader)
            ->addFilterAction($actionReplaceheader);
        $this->assertSame([
            $filterVariables,
            $actionKeep,
            $actionDiscard,
            $actionFileInto,
            $actionFlag,
            $actionTag,
            $actionRedirect,
            $actionReply,
            $actionNotify,
            $actionRFCCompliantNotify,
            $actionStop,
            $actionReject,
            $actionEreject,
            $actionLog,
            $actionAddheader,
            $actionDeleteheader,
            $actionReplaceheader,
        ], array_values($filterActions->getFilterActions()));

        $xml = <<<EOT
<?xml version="1.0"?>
<result xmlns:urn="urn:zimbraMail">
    <urn:filterVariables index="$index">
        <urn:filterVariable name="$name" value="$value" />
    </urn:filterVariables>
    <urn:actionKeep index="$index" />
    <urn:actionDiscard index="$index" />
    <urn:actionFileInto index="$index" folderPath="$folder" copy="true" />
    <urn:actionFlag index="$index" flagName="$flag" />
    <urn:actionTag index="$index" tagName="$tag" />
    <urn:actionRedirect index="$index" a="$address" copy="true" />
    <urn:actionReply index="$index">
        <urn:content>$content</urn:content>
    </urn:actionReply>
    <urn:actionNotify index="$index" a="$address" su="$subject" maxBodySize="$maxBodySize" origHeaders="$origHeaders">
        <urn:content>$content</urn:content>
    </urn:actionNotify>
    <urn:actionRFCCompliantNotify index="$index" from="$from" importance="$importance" options="$options" message="$message">
        <urn:method>$method</urn:method>
    </urn:actionRFCCompliantNotify>
    <urn:actionStop index="$index" />
    <urn:actionReject index="$index">$content</urn:actionReject>
    <urn:actionEreject index="$index">$content</urn:actionEreject>
    <urn:actionLog index="$index" level="info">$content</urn:actionLog>
    <urn:actionAddheader index="$index" last="true">
        <urn:headerName>$headerName</urn:headerName>
        <urn:headerValue>$headerValue</urn:headerValue>
    </urn:actionAddheader>
    <urn:actionDeleteheader index="$index" last="true" offset="$offset">
        <urn:test matchType="is" countComparator="true" valueComparator="true" relationalComparator="eq" comparator="i;octet">
            <urn:headerName>$headerName</urn:headerName>
            <urn:headerValue>$headerValue</urn:headerValue>
        </urn:test>
    </urn:actionDeleteheader>
    <urn:actionReplaceheader index="$index" last="true" offset="$offset">
        <urn:test matchType="is" countComparator="true" valueComparator="true" relationalComparator="eq" comparator="i;octet">
            <urn:headerName>$headerName</urn:headerName>
            <urn:headerValue>$headerValue</urn:headerValue>
        </urn:test>
        <urn:newName>$newName</urn:newName>
        <urn:newValue>$newValue</urn:newValue>
    </urn:actionReplaceheader>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($filterActions, 'xml'));
        $this->assertEquals($filterActions, $this->serializer->deserialize($xml, StubFilterActions::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraMail', prefix: "urn")]
class StubFilterActions extends FilterActions
{
}
