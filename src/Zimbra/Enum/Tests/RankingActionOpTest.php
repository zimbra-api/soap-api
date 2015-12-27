<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\RankingActionOp;

/**
 * Testcase class for RankingActionOp.
 */
class RankingActionOpTest extends PHPUnit_Framework_TestCase
{
    public function testRankingActionOp()
    {
        $values = [
            'RESET'  => 'reset',
            'DELETE' => 'delete',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(RankingActionOp::$enum()->value(), $value);
        }
    }
}
