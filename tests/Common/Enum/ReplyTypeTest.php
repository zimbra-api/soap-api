<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\ReplyType;

/**
 * Testcase class for ReplyType.
 */
class ReplyTypeTest extends TestCase
{
    public function testReplyType()
    {
        $values = [
            'REPLIED'   => 'r',
            'FORWARDED' => 'w',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(ReplyType::$enum()->getValue(), $value);
        }
    }
}
