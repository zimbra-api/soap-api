<?php

namespace Zimbra\Tests;

use \PHPUnit_Framework_TestCase;

/**
 * Base testcase class for all Zimbra testcases.
 */
abstract class ZimbraTestCase extends PHPUnit_Framework_TestCase
{
	public function invokeMethod(&$object, $methodName, array $parameters = array())
	{
		$reflection = new \ReflectionClass(get_class($object));
		$method = $reflection->getMethod($methodName);
		$method->setAccessible(true);

		return $method->invokeArgs($object, $parameters);
	}

    protected function getTz()
    {
        $standard = new \Zimbra\Struct\TzOnsetInfo(12, 2, 3, 4);
        $daylight = new \Zimbra\Struct\TzOnsetInfo(4, 3, 2, 10);
        return new \Zimbra\Mail\Struct\CalTZInfo('id', 10, 10, $standard, $daylight, 'stdname', 'dayname');
    }

    protected function getMsg()
    {
        $mp = new \Zimbra\Mail\Struct\MimePartAttachSpec('mid', 'part', true);
        $msg = new \Zimbra\Mail\Struct\MsgAttachSpec('id', false);
        $cn = new \Zimbra\Mail\Struct\ContactAttachSpec('id', false);
        $doc = new \Zimbra\Mail\Struct\DocAttachSpec('path', 'id', 10, true);
        $info = new \Zimbra\Mail\Struct\MimePartInfo(array(), null, 'ct', 'content', 'ci');

        $header = new \Zimbra\Mail\Struct\Header('name', 'value');
        $attach = new \Zimbra\Mail\Struct\AttachmentsInfo($mp, $msg, $cn, $doc, 'aid');
        $mp = new \Zimbra\Mail\Struct\MimePartInfo(array($info), $attach, 'ct', 'content', 'ci');
        $inv = new \Zimbra\Mail\Struct\InvitationInfo('method', 10, true);
        $e = new \Zimbra\Mail\Struct\EmailAddrInfo('a', 't', 'p');
        $tz = $this->getTz();

        return new \Zimbra\Mail\Struct\Msg(
            'content',
            array($header),
            $mp,
            $attach,
            $inv,
            array($e),
            array($tz),
            'fr',
            'aid',
            'origid',
            'rt',
            'idnt',
            'su',
            'irt',
            'l',
            'f'
        );
    }
}
