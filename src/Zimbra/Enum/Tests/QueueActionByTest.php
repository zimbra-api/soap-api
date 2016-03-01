<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\QueueActionBy;

/**
 * Testcase class for QueueActionBy.
 */
class QueueActionByTest extends PHPUnit_Framework_TestCase
{
    public function testQueueActionBy()
    {
        $values = [
            'ID'    => 'id',
            'QUERY' => 'query',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(QueueActionBy::$enum()->value(), $value);
        }
    }
}
