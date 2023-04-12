<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\RankingActionOp;

/**
 * Testcase class for RankingActionOp.
 */
class RankingActionOpTest extends TestCase
{
    public function testRankingActionOp()
    {
        $values = [
            'RESET'  => 'reset',
            'DELETE' => 'delete',
        ];
        foreach ($values as $name => $value) {
            $this->assertSame(RankingActionOp::from($value)->name, $name);
            $this->assertSame(RankingActionOp::from($value)->value, $value);
        }
    }
}
