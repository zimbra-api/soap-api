<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\SearchSortBy;

/**
 * Testcase class for SearchSortBy.
 */
class SearchSortByTest extends TestCase
{
    public function testSearchSortBy()
    {
        $values = [
            'DATE_DESC' => 'dateDesc',
            'DATE_ASC' => 'dateAsc',
            'ID_DESC' => 'idDesc',
            'ID_ASC' => 'idAsc',
            'SUBJ_DESC' => 'subjDesc',
            'SUBJ_ASC' => 'subjAsc',
            'NAME_DESC' => 'nameDesc',
            'NAME_ASC' => 'nameAsc',
            'DUR_DESC' => 'durDesc',
            'DUR_ASC' => 'durAsc',
            'NONE' => 'none',
            'TASK_DUE_ASC' => 'taskDueAsc',
            'TASK_DUE_DESC' => 'taskDueDesc',
            'TASK_STATUS_ASC' => 'taskStatusAsc',
            'TASK_STATUS_DESC' => 'taskStatusDesc',
            'TASK_PERC_COMPLETED_ASC' => 'taskPercCompletedAsc',
            'TASK_PERC_COMPLETED_DESC' => 'taskPercCompletedDesc',
            'RCPT_ASC' => 'rcptAsc',
            'RCPT_DESC' => 'rcptDesc',
            'READ_ASC' => 'readAsc',
            'READ_DESC' => 'readDesc',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(SearchSortBy::$enum()->getValue(), $value);
        }
    }
}
