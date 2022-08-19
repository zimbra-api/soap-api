<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\XmppComponentBy;

/**
 * Testcase class for XmppComponentBy.
 */
class XmppComponentByTest extends TestCase
{
    public function testXmppComponentBy()
    {
        $values = [
            'ID'               => 'id',
            'NAME'             => 'name',
            'SERVICE_HOSTNAME' => 'serviceHostname',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(XmppComponentBy::$enum()->getValue(), $value);
        }
    }
}
