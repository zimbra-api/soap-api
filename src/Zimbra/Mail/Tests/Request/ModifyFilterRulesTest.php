<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\FilterCondition;
use Zimbra\Enum\Importance;
use Zimbra\Mail\Request\ModifyFilterRules;

/**
 * Testcase class for ModifyFilterRules.
 */
class ModifyFilterRulesTest extends ZimbraMailApiTestCase
{
    public function testModifyFilterRulesRequest()
    {
        $name = $this->faker->word;
        $index = mt_rand(1, 100);
        $header = $this->faker->word;
        $part = $this->faker->word;
        $comparison = $this->faker->word;
        $value = $this->faker->word;
        $where = $this->faker->word;
        $date = mt_rand(1, 10);
        $time = $this->faker->word;
        $method = $this->faker->word;
        $size = $this->faker->word;
        $folder = $this->faker->word;

        $flag = $this->faker->word;
        $tag = $this->faker->word;
        $address = $this->faker->word;
        $content = $this->faker->word;
        $max = mt_rand(1, 10);
        $subject = $this->faker->word;
        $headers = $this->faker->word;

        $addressBookTest = new \Zimbra\Mail\Struct\AddressBookTest(
            $index, $header, true
        );
        $addressTest = new \Zimbra\Mail\Struct\AddressTest(
            $index, $header, $part, $comparison, $value, true, true
        );
        $attachmentTest = new \Zimbra\Mail\Struct\AttachmentTest(
            $index, true
        );
        $bodyTest = new \Zimbra\Mail\Struct\BodyTest(
            $index, $value, true, true
        );
        $bulkTest = new \Zimbra\Mail\Struct\BulkTest(
            $index, true
        );
        $contactRankingTest = new \Zimbra\Mail\Struct\ContactRankingTest(
            $index, $header, true
        );
        $conversationTest = new \Zimbra\Mail\Struct\ConversationTest(
            $index, $where, true
        );
        $currentDayOfWeekTest = new \Zimbra\Mail\Struct\CurrentDayOfWeekTest(
            $index, $value, true
        );
        $currentTimeTest = new \Zimbra\Mail\Struct\CurrentTimeTest(
            $index, $comparison, $time, true
        );
        $dateTest = new \Zimbra\Mail\Struct\DateTest(
            $index, $comparison, $date, true
        );
        $facebookTest = new \Zimbra\Mail\Struct\FacebookTest(
            $index, true
        );
        $flaggedTest = new \Zimbra\Mail\Struct\FlaggedTest(
            $index, $flag, true
        );
        $headerExistsTest = new \Zimbra\Mail\Struct\HeaderExistsTest(
            $index, $header, true
        );
        $headerTest = new \Zimbra\Mail\Struct\HeaderTest(
            $index, $header, $comparison, $value, true, true
        );
        $importanceTest = new \Zimbra\Mail\Struct\ImportanceTest(
            $index, Importance::HIGH(), true
        );
        $inviteTest = new \Zimbra\Mail\Struct\InviteTest(
            $index, [$method], true
        );
        $linkedinTest = new \Zimbra\Mail\Struct\LinkedInTest(
            $index, true
        );
        $listTest = new \Zimbra\Mail\Struct\ListTest(
            $index, true
        );
        $meTest = new \Zimbra\Mail\Struct\MeTest(
            $index, $header, true
        );
        $mimeHeaderTest = new \Zimbra\Mail\Struct\MimeHeaderTest(
            $index, $header, $comparison, $value, true, true
        );
        $sizeTest = new \Zimbra\Mail\Struct\SizeTest(
            $index, $comparison, $size, true
        );
        $socialcastTest = new \Zimbra\Mail\Struct\SocialcastTest(
            $index, true
        );
        $trueTest = new \Zimbra\Mail\Struct\TrueTest(
            $index, true
        );
        $twitterTest = new \Zimbra\Mail\Struct\TwitterTest(
            $index, true
        );

        $tests = [
            $addressBookTest,
            $addressTest,
            $attachmentTest,
            $bodyTest,
            $bulkTest,
            $contactRankingTest,
            $conversationTest,
            $currentDayOfWeekTest,
            $currentTimeTest,
            $dateTest,
            $facebookTest,
            $flaggedTest,
            $headerExistsTest,
            $headerTest,
            $importanceTest,
            $inviteTest,
            $linkedinTest,
            $listTest,
            $meTest,
            $mimeHeaderTest,
            $sizeTest,
            $socialcastTest,
            $trueTest,
            $twitterTest
        ];
        $filterTests = new \Zimbra\Mail\Struct\FilterTests(
            FilterCondition::ALL_OF(), $tests
        );

        $actionKeep = new \Zimbra\Mail\Struct\KeepAction($index);
        $actionDiscard = new \Zimbra\Mail\Struct\DiscardAction($index);
        $actionFileInto = new \Zimbra\Mail\Struct\FileIntoAction($index, $folder);
        $actionFlag = new \Zimbra\Mail\Struct\FlagAction($index, $flag);
        $actionTag = new \Zimbra\Mail\Struct\TagAction($index, $tag);
        $actionRedirect = new \Zimbra\Mail\Struct\RedirectAction($index, $address);
        $actionReply = new \Zimbra\Mail\Struct\ReplyAction($index, $content);
        $actionNotify = new \Zimbra\Mail\Struct\NotifyAction(
            $index, $content, $address, $subject, $max, $headers
        );
        $actionStop = new \Zimbra\Mail\Struct\StopAction($index);
        $actions = [
            $actionKeep,
            $actionDiscard,
            $actionFileInto,
            $actionFlag,
            $actionTag,
            $actionRedirect,
            $actionReply,
            $actionNotify,
            $actionStop
        ];
        $filterActions = new \Zimbra\Mail\Struct\FilterActions($actions);

        $filterRule = new \Zimbra\Mail\Struct\FilterRule(
            $name, true, $filterTests, $filterActions
        );
        $filterRules = new \Zimbra\Mail\Struct\FilterRules([$filterRule]);

        $req = new ModifyFilterRules(
            $filterRules
        );
        $this->assertSame($filterRules, $req->getFilterRules());

        $req = new ModifyFilterRules(
            new \Zimbra\Mail\Struct\FilterRules([])
        );
        $req->setFilterRules($filterRules);
        $this->assertSame($filterRules, $req->getFilterRules());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifyFilterRulesRequest>'
                .'<filterRules>'
                    .'<filterRule name="' . $name . '" active="true">'
                        .'<filterTests condition="' . FilterCondition::ALL_OF() . '">'
                            .'<addressBookTest index="' . $index . '" negative="true" header="' . $header . '" />'
                            .'<addressTest index="' . $index . '" negative="true" header="' . $header . '" part="' . $part . '" stringComparison="' . $comparison . '" value="' . $value . '" caseSensitive="true" />'
                            .'<attachmentTest index="' . $index . '" negative="true" />'
                            .'<bodyTest index="' . $index . '" negative="true" value="' . $value . '" caseSensitive="true" />'
                            .'<bulkTest index="' . $index . '" negative="true" />'
                            .'<contactRankingTest index="' . $index . '" negative="true" header="' . $header . '" />'
                            .'<conversationTest index="' . $index . '" negative="true" where="' . $where . '" />'
                            .'<currentDayOfWeekTest index="' . $index . '" negative="true" value="' . $value . '" />'
                            .'<currentTimeTest index="' . $index . '" negative="true" dateComparison="' . $comparison . '" time="' . $time . '" />'
                            .'<dateTest index="' . $index . '" negative="true" dateComparison="' . $comparison . '" d="' . $date . '" />'
                            .'<facebookTest index="' . $index . '" negative="true" />'
                            .'<flaggedTest index="' . $index . '" negative="true" flagName="' . $flag . '" />'
                            .'<headerExistsTest index="' . $index . '" negative="true" header="' . $header . '" />'
                            .'<headerTest index="' . $index . '" negative="true" header="' . $header . '" stringComparison="' . $comparison . '" value="' . $value . '" caseSensitive="true" />'
                            .'<importanceTest index="' . $index . '" negative="true" imp="' . Importance::HIGH() . '" />'
                            .'<inviteTest index="' . $index . '" negative="true">'
                                .'<method>' . $method . '</method>'
                            .'</inviteTest>'
                            .'<linkedinTest index="' . $index . '" negative="true" />'
                            .'<listTest index="' . $index . '" negative="true" />'
                            .'<meTest index="' . $index . '" negative="true" header="' . $header . '" />'
                            .'<mimeHeaderTest index="' . $index . '" negative="true" header="' . $header . '" stringComparison="' . $comparison . '" value="' . $value . '" caseSensitive="true" />'
                            .'<sizeTest index="' . $index . '" negative="true" numberComparison="' . $comparison . '" s="' . $size . '" />'
                            .'<socialcastTest index="' . $index . '" negative="true" />'
                            .'<trueTest index="' . $index . '" negative="true" />'
                            .'<twitterTest index="' . $index . '" negative="true" />'
                        .'</filterTests>'
                        .'<filterActions>'
                            .'<actionKeep index="' . $index . '" />'
                            .'<actionDiscard index="' . $index . '" />'
                            .'<actionFileInto index="' . $index . '" folderPath="' . $folder . '" />'
                            .'<actionFlag index="' . $index . '" flagName="' . $flag . '" />'
                            .'<actionTag index="' . $index . '" tagName="' . $tag . '" />'
                            .'<actionRedirect index="' . $index . '" a="' . $address . '" />'
                            .'<actionReply index="' . $index . '">'
                                .'<content>' . $content . '</content>'
                            .'</actionReply>'
                            .'<actionNotify index="' . $index . '" a="' . $address . '" su="' . $subject . '" maxBodySize="' . $max . '" origHeaders="' . $headers . '">'
                                .'<content>' . $content . '</content>'
                            .'</actionNotify>'
                            .'<actionStop index="' . $index . '" />'
                        .'</filterActions>'
                    .'</filterRule>'
                .'</filterRules>'
            .'</ModifyFilterRulesRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ModifyFilterRulesRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'filterRules' => array(
                    'filterRule' => array(
                        array(
                            'name' => $name,
                            'active' => true,
                            'filterTests' => array(
                                'condition' => FilterCondition::ALL_OF()->value(),
                                'addressBookTest' => array(
                                    'index' => $index,
                                    'negative' => true,
                                    'header' => $header,
                                ),
                                'addressTest' => array(
                                    'index' => $index,
                                    'negative' => true,
                                    'header' => $header,
                                    'part' => $part,
                                    'stringComparison' => $comparison,
                                    'value' => $value,
                                    'caseSensitive' => true,
                                ),
                                'attachmentTest' => array(
                                    'index' => $index,
                                    'negative' => true,
                                ),
                                'bodyTest' => array(
                                    'index' => $index,
                                    'negative' => true,
                                    'value' => $value,
                                    'caseSensitive' => true,
                                ),
                                'bulkTest' => array(
                                    'index' => $index,
                                    'negative' => true,
                                ),
                                'contactRankingTest' => array(
                                    'index' => $index,
                                    'negative' => true,
                                    'header' => $header,
                                ),
                                'conversationTest' => array(
                                    'index' => $index,
                                    'negative' => true,
                                    'where' => $where,
                                ),
                                'currentDayOfWeekTest' => array(
                                    'index' => $index,
                                    'negative' => true,
                                    'value' => $value,
                                ),
                                'currentTimeTest' => array(
                                    'index' => $index,
                                    'negative' => true,
                                    'dateComparison' => $comparison,
                                    'time' => $time,
                                ),
                                'dateTest' => array(
                                    'index' => $index,
                                    'negative' => true,
                                    'dateComparison' => $comparison,
                                    'd' => $date,
                                ),
                                'facebookTest' => array(
                                    'index' => $index,
                                    'negative' => true,
                                ),
                                'flaggedTest' => array(
                                    'index' => $index,
                                    'negative' => true,
                                    'flagName' => $flag,
                                ),
                                'headerExistsTest' => array(
                                    'index' => $index,
                                    'negative' => true,
                                    'header' => $header,
                                ),
                                'headerTest' => array(
                                    'index' => $index,
                                    'negative' => true,
                                    'header' => $header,
                                    'stringComparison' => $comparison,
                                    'value' => $value,
                                    'caseSensitive' => true,
                                ),
                                'importanceTest' => array(
                                    'index' => $index,
                                    'negative' => true,
                                    'imp' => Importance::HIGH()->value(),
                                ),
                                'inviteTest' => array(
                                    'index' => $index,
                                    'negative' => true,
                                    'method' => array(
                                        $method,
                                    ),
                                ),
                                'linkedinTest' => array(
                                    'index' => $index,
                                    'negative' => true,
                                ),
                                'listTest' => array(
                                    'index' => $index,
                                    'negative' => true,
                                ),
                                'meTest' => array(
                                    'index' => $index,
                                    'negative' => true,
                                    'header' => $header,
                                ),
                                'mimeHeaderTest' => array(
                                    'index' => $index,
                                    'negative' => true,
                                    'header' => $header,
                                    'stringComparison' => $comparison,
                                    'value' => $value,
                                    'caseSensitive' => true,
                                ),
                                'sizeTest' => array(
                                    'index' => $index,
                                    'negative' => true,
                                    'numberComparison' => $comparison,
                                    's' => $size,
                                ),
                                'socialcastTest' => array(
                                    'index' => $index,
                                    'negative' => true,
                                ),
                                'trueTest' => array(
                                    'index' => $index,
                                    'negative' => true,
                                ),
                                'twitterTest' => array(
                                    'index' => $index,
                                    'negative' => true,
                                ),
                            ),
                            'filterActions' => array(
                                'actionKeep' => array(
                                    'index' => $index,
                                ),
                                'actionDiscard' => array(
                                    'index' => $index,
                                ),
                                'actionFileInto' => array(
                                    'index' => $index,
                                    'folderPath' => $folder,
                                ),
                                'actionFlag' => array(
                                    'index' => $index,
                                    'flagName' => $flag,
                                ),
                                'actionTag' => array(
                                    'index' => $index,
                                    'tagName' => $tag,
                                ),
                                'actionRedirect' => array(
                                    'index' => $index,
                                    'a' => $address,
                                ),
                                'actionReply' => array(
                                    'index' => $index,
                                    'content' => $content,
                                ),
                                'actionNotify' => array(
                                    'index' => $index,
                                    'content' => $content,
                                    'a' => $address,
                                    'su' => $subject,
                                    'maxBodySize' => $max,
                                    'origHeaders' => $headers,
                                ),
                                'actionStop' => array(
                                    'index' => $index,
                                ),
                            ),
                        ),
                    ),
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyFilterRulesApi()
    {
        $name = $this->faker->word;
        $index = mt_rand(1, 100);
        $header = $this->faker->word;
        $part = $this->faker->word;
        $comparison = $this->faker->word;
        $value = $this->faker->word;
        $where = $this->faker->word;
        $date = mt_rand(1, 10);
        $time = $this->faker->word;
        $method = $this->faker->word;
        $size = $this->faker->word;
        $folder = $this->faker->word;

        $flag = $this->faker->word;
        $tag = $this->faker->word;
        $address = $this->faker->word;
        $content = $this->faker->word;
        $max = mt_rand(1, 10);
        $subject = $this->faker->word;
        $headers = $this->faker->word;

        $addressBookTest = new \Zimbra\Mail\Struct\AddressBookTest(
            $index, $header, true
        );
        $addressTest = new \Zimbra\Mail\Struct\AddressTest(
            $index, $header, $part, $comparison, $value, true, true
        );
        $attachmentTest = new \Zimbra\Mail\Struct\AttachmentTest(
            $index, true
        );
        $bodyTest = new \Zimbra\Mail\Struct\BodyTest(
            $index, $value, true, true
        );
        $bulkTest = new \Zimbra\Mail\Struct\BulkTest(
            $index, true
        );
        $contactRankingTest = new \Zimbra\Mail\Struct\ContactRankingTest(
            $index, $header, true
        );
        $conversationTest = new \Zimbra\Mail\Struct\ConversationTest(
            $index, $where, true
        );
        $currentDayOfWeekTest = new \Zimbra\Mail\Struct\CurrentDayOfWeekTest(
            $index, $value, true
        );
        $currentTimeTest = new \Zimbra\Mail\Struct\CurrentTimeTest(
            $index, $comparison, $time, true
        );
        $dateTest = new \Zimbra\Mail\Struct\DateTest(
            $index, $comparison, $date, true
        );
        $facebookTest = new \Zimbra\Mail\Struct\FacebookTest(
            $index, true
        );
        $flaggedTest = new \Zimbra\Mail\Struct\FlaggedTest(
            $index, $flag, true
        );
        $headerExistsTest = new \Zimbra\Mail\Struct\HeaderExistsTest(
            $index, $header, true
        );
        $headerTest = new \Zimbra\Mail\Struct\HeaderTest(
            $index, $header, $comparison, $value, true, true
        );
        $importanceTest = new \Zimbra\Mail\Struct\ImportanceTest(
            $index, Importance::HIGH(), true
        );
        $inviteTest = new \Zimbra\Mail\Struct\InviteTest(
            $index, [$method], true
        );
        $linkedinTest = new \Zimbra\Mail\Struct\LinkedInTest(
            $index, true
        );
        $listTest = new \Zimbra\Mail\Struct\ListTest(
            $index, true
        );
        $meTest = new \Zimbra\Mail\Struct\MeTest(
            $index, $header, true
        );
        $mimeHeaderTest = new \Zimbra\Mail\Struct\MimeHeaderTest(
            $index, $header, $comparison, $value, true, true
        );
        $sizeTest = new \Zimbra\Mail\Struct\SizeTest(
            $index, $comparison, $size, true
        );
        $socialcastTest = new \Zimbra\Mail\Struct\SocialcastTest(
            $index, true
        );
        $trueTest = new \Zimbra\Mail\Struct\TrueTest(
            $index, true
        );
        $twitterTest = new \Zimbra\Mail\Struct\TwitterTest(
            $index, true
        );

        $tests = [
            $addressBookTest,
            $addressTest,
            $attachmentTest,
            $bodyTest,
            $bulkTest,
            $contactRankingTest,
            $conversationTest,
            $currentDayOfWeekTest,
            $currentTimeTest,
            $dateTest,
            $facebookTest,
            $flaggedTest,
            $headerExistsTest,
            $headerTest,
            $importanceTest,
            $inviteTest,
            $linkedinTest,
            $listTest,
            $meTest,
            $mimeHeaderTest,
            $sizeTest,
            $socialcastTest,
            $trueTest,
            $twitterTest
        ];
        $filterTests = new \Zimbra\Mail\Struct\FilterTests(
            FilterCondition::ALL_OF(), $tests
        );

        $actionKeep = new \Zimbra\Mail\Struct\KeepAction($index);
        $actionDiscard = new \Zimbra\Mail\Struct\DiscardAction($index);
        $actionFileInto = new \Zimbra\Mail\Struct\FileIntoAction($index, $folder);
        $actionFlag = new \Zimbra\Mail\Struct\FlagAction($index, $flag);
        $actionTag = new \Zimbra\Mail\Struct\TagAction($index, $tag);
        $actionRedirect = new \Zimbra\Mail\Struct\RedirectAction($index, $address);
        $actionReply = new \Zimbra\Mail\Struct\ReplyAction($index, $content);
        $actionNotify = new \Zimbra\Mail\Struct\NotifyAction(
            $index, $content, $address, $subject, $max, $headers
        );
        $actionStop = new \Zimbra\Mail\Struct\StopAction($index);
        $actions = [
            $actionKeep,
            $actionDiscard,
            $actionFileInto,
            $actionFlag,
            $actionTag,
            $actionRedirect,
            $actionReply,
            $actionNotify,
            $actionStop
        ];
        $filterActions = new \Zimbra\Mail\Struct\FilterActions($actions);

        $filterRule = new \Zimbra\Mail\Struct\FilterRule(
            $name, true, $filterTests, $filterActions
        );
        $filterRules = new \Zimbra\Mail\Struct\FilterRules([$filterRule]);

        $this->api->modifyFilterRules(
            $filterRules
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ModifyFilterRulesRequest>'
                        .'<urn1:filterRules>'
                            .'<urn1:filterRule name="' . $name . '" active="true">'
                                .'<urn1:filterTests condition="' . FilterCondition::ALL_OF() . '">'
                                    .'<urn1:addressBookTest index="' . $index . '" negative="true" header="' . $header . '" />'
                                    .'<urn1:addressTest index="' . $index . '" negative="true" header="' . $header . '" part="' . $part . '" stringComparison="' . $comparison . '" value="' . $value . '" caseSensitive="true" />'
                                    .'<urn1:attachmentTest index="' . $index . '" negative="true" />'
                                    .'<urn1:bodyTest index="' . $index . '" negative="true" value="' . $value . '" caseSensitive="true" />'
                                    .'<urn1:bulkTest index="' . $index . '" negative="true" />'
                                    .'<urn1:contactRankingTest index="' . $index . '" negative="true" header="' . $header . '" />'
                                    .'<urn1:conversationTest index="' . $index . '" negative="true" where="' . $where . '" />'
                                    .'<urn1:currentDayOfWeekTest index="' . $index . '" negative="true" value="' . $value . '" />'
                                    .'<urn1:currentTimeTest index="' . $index . '" negative="true" dateComparison="' . $comparison . '" time="' . $time . '" />'
                                    .'<urn1:dateTest index="' . $index . '" negative="true" dateComparison="' . $comparison . '" d="' . $date . '" />'
                                    .'<urn1:facebookTest index="' . $index . '" negative="true" />'
                                    .'<urn1:flaggedTest index="' . $index . '" negative="true" flagName="' . $flag . '" />'
                                    .'<urn1:headerExistsTest index="' . $index . '" negative="true" header="' . $header . '" />'
                                    .'<urn1:headerTest index="' . $index . '" negative="true" header="' . $header . '" stringComparison="' . $comparison . '" value="' . $value . '" caseSensitive="true" />'
                                    .'<urn1:importanceTest index="' . $index . '" negative="true" imp="' . Importance::HIGH() . '" />'
                                    .'<urn1:inviteTest index="' . $index . '" negative="true">'
                                        .'<urn1:method>' . $method . '</urn1:method>'
                                    .'</urn1:inviteTest>'
                                    .'<urn1:linkedinTest index="' . $index . '" negative="true" />'
                                    .'<urn1:listTest index="' . $index . '" negative="true" />'
                                    .'<urn1:meTest index="' . $index . '" negative="true" header="' . $header . '" />'
                                    .'<urn1:mimeHeaderTest index="' . $index . '" negative="true" header="' . $header . '" stringComparison="' . $comparison . '" value="' . $value . '" caseSensitive="true" />'
                                    .'<urn1:sizeTest index="' . $index . '" negative="true" numberComparison="' . $comparison . '" s="' . $size . '" />'
                                    .'<urn1:socialcastTest index="' . $index . '" negative="true" />'
                                    .'<urn1:trueTest index="' . $index . '" negative="true" />'
                                    .'<urn1:twitterTest index="' . $index . '" negative="true" />'
                                .'</urn1:filterTests>'
                                .'<urn1:filterActions>'
                                    .'<urn1:actionKeep index="' . $index . '" />'
                                    .'<urn1:actionDiscard index="' . $index . '" />'
                                    .'<urn1:actionFileInto index="' . $index . '" folderPath="' . $folder . '" />'
                                    .'<urn1:actionFlag index="' . $index . '" flagName="' . $flag . '" />'
                                    .'<urn1:actionTag index="' . $index . '" tagName="' . $tag . '" />'
                                    .'<urn1:actionRedirect index="' . $index . '" a="' . $address . '" />'
                                    .'<urn1:actionReply index="' . $index . '">'
                                        .'<urn1:content>' . $content . '</urn1:content>'
                                    .'</urn1:actionReply>'
                                    .'<urn1:actionNotify index="' . $index . '" a="' . $address . '" su="' . $subject . '" maxBodySize="' . $max . '" origHeaders="' . $headers . '">'
                                        .'<urn1:content>' . $content . '</urn1:content>'
                                    .'</urn1:actionNotify>'
                                    .'<urn1:actionStop index="' . $index . '" />'
                                .'</urn1:filterActions>'
                            .'</urn1:filterRule>'
                        .'</urn1:filterRules>'
                    .'</urn1:ModifyFilterRulesRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
