<?php

namespace Zimbra\Tests;

use \PHPUnit_Framework_TestCase;

/**
 * Base testcase class for all Zimbra testcases.
 */
abstract class ZimbraTestCase extends PHPUnit_Framework_TestCase
{
	public function invokeMethod(&$object, $methodName, array $parameters = [])
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
        $info = new \Zimbra\Mail\Struct\MimePartInfo([], null, 'ct', 'content', 'ci');

        $header = new \Zimbra\Mail\Struct\Header('name', 'value');
        $attach = new \Zimbra\Mail\Struct\AttachmentsInfo($mp, $msg, $cn, $doc, 'aid');
        $mp = new \Zimbra\Mail\Struct\MimePartInfo([$info], $attach, 'ct', 'content', 'ci');
        $inv = new \Zimbra\Mail\Struct\InvitationInfo('method', 10, true);
        $e = new \Zimbra\Mail\Struct\EmailAddrInfo('a', 't', 'p');
        $tz = $this->getTz();

        return new \Zimbra\Mail\Struct\Msg(
            'content',
            [$header],
            $mp,
            $attach,
            $inv,
            [$e],
            [$tz],
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

    public static function randomValue(array $values)
    {
        $key = array_rand($values);
        return $values[$key];
    }

    public static function randomAttrs(array $attrs)
    {
        $num = mt_rand(1, count($attrs));
        $keys = array_rand($attrs, $num);
        $values = array();
        if (is_array($keys)) {
            foreach ($keys as $key)
            {
                $values[] = $attrs[$key];
            }
        }
        else
        {
            $values[] = $attrs[$keys];
        }
        return implode(',', $values);
    }

    public static function randomString($length = 8)
    {
        $str = '';
        for ($i = 0; $i < $length; $i++)
        {
            $str .= chr(mt_rand(32, 126));
        }
        return $str;
    }

    public static function randomName($length = 8)
    {
        $values = array_merge(range(65, 90), range(97, 122), range(48, 57));
        $max = count($values) - 1;
        $str = chr(mt_rand(97, 122));
        for ($i = 1; $i < $length; $i++)
        {
            $str .= chr($values[mt_rand(0, $max)]);
        }
        return $str;
    }
}
