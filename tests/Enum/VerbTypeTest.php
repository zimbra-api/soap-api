<?php

namespace Zimbra\Tests\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\VerbType;

/**
 * Testcase class for VerbType.
 */
class VerbTypeTest extends TestCase
{
    public function testVerbType()
    {
        $values = [
            'ACCEPT'    => 'ACCEPT',
            'DECLINE'   => 'DECLINE',
            'TENTATIVE' => 'TENTATIVE',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(VerbType::$enum()->getValue(), $value);
        }
    }
}
