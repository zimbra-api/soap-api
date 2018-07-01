<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\XmppComponentBy;

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
        foreach ($values as $enum => $value)
        {
            $this->assertSame(XmppComponentBy::$enum()->value(), $value);
        }
    }
}
