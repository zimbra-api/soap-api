<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\SortBy;

/**
 * Testcase class for SortBy.
 */
class SortByTest extends TestCase
{
    public function testSortBy()
    {
        $values = [
            'NONE'          => 'none',
            'DATE_ASC'      => 'dateAsc',
            'DATE_DESC'     => 'dateDesc',
            'SUBJ_ASC'      => 'subjAsc',
            'SUBJ_DESC'     => 'subjDesc',
            'NAME_ASC'      => 'nameAsc',
            'NAME_DESC'     => 'nameDesc',
            'RCPT_ASC'      => 'rcptAsc',
            'RCPT_DESC'     => 'rcptDesc',
            'ATTACH_ASC'    => 'attachAsc',
            'ATTACH_DESC'   => 'attachDesc',
            'FLAG_ASC'      => 'flagAsc',
            'FLAG_DESC'     => 'flagDesc',
            'PRIORITY_ASC'  => 'priorityAsc',
            'PRIORITY_DESC' => 'priorityDesc',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(SortBy::$enum()->getValue(), $value);
        }
    }
}
