<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\FilterActions;
use Zimbra\Mail\Struct\KeepAction;
use Zimbra\Mail\Struct\DiscardAction;
use Zimbra\Mail\Struct\FileIntoAction;
use Zimbra\Mail\Struct\FlagAction;
use Zimbra\Mail\Struct\TagAction;
use Zimbra\Mail\Struct\RedirectAction;
use Zimbra\Mail\Struct\ReplyAction;
use Zimbra\Mail\Struct\StopAction;
use Zimbra\Mail\Struct\NotifyAction;

/**
 * Testcase class for FilterActions.
 */
class FilterActionsTest extends ZimbraMailTestCase
{
    public function testFilterActions()
    {
        $index = mt_rand(1, 10);
        $folder = $this->faker->word;
        $flag = $this->faker->word;
        $tag = $this->faker->word;
        $address = $this->faker->word;
        $content = $this->faker->word;
        $max = mt_rand(1, 10);
        $subject = $this->faker->word;
        $headers = $this->faker->word;

        $actionKeep = new KeepAction($index);
        $actionDiscard = new DiscardAction($index);
        $actionFileInto = new FileIntoAction($index, $folder);
        $actionFlag = new FlagAction($index, $flag);
        $actionTag = new TagAction($index, $tag);
        $actionRedirect = new RedirectAction($index, $address);
        $actionReply = new ReplyAction($index, $content);
        $actionNotify = new NotifyAction(
            $index, $content, $address, $subject, $max, $headers
        );
        $actionStop = new StopAction($index);

        $actions = [
            $actionKeep,
            $actionDiscard,
            $actionFileInto,
            $actionFlag,
            $actionTag,
            $actionRedirect,
            $actionReply,
            $actionNotify,
        ];
        $filterActions = new FilterActions($actions);
        $this->assertSame($actions, $filterActions->getActions()->all());

        $filterActions = new FilterActions();
        $filterActions->setActions($actions);
        $this->assertSame($actions, $filterActions->getActions()->all());
        $actions[] = $actionStop;
        $filterActions->addAction($actionStop);
        $this->assertSame($actions, $filterActions->getActions()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
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
            .'</filterActions>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $filterActions);

        $array = array(
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
        );
        $this->assertEquals($array, $filterActions->toArray());
    }
}
