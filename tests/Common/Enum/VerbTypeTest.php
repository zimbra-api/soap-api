<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\VerbType;

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
        foreach ($values as $name => $value) {
            $this->assertSame(VerbType::from($value)->value, $value);
            $this->assertSame(VerbType::from($value)->name, $name);
        }
    }
}
