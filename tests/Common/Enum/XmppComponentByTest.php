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
        foreach ($values as $name => $value) {
            $this->assertSame(XmppComponentBy::from($value)->value, $value);
            $this->assertSame(XmppComponentBy::from($value)->name, $name);
        }
    }
}
