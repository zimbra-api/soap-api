<?php

namespace Zimbra\Tests\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\QueueActionBy;

/**
 * Testcase class for QueueActionBy.
 */
class QueueActionByTest extends TestCase
{
    public function testQueueActionBy()
    {
        $values = [
            'ID'    => 'id',
            'QUERY' => 'query',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(QueueActionBy::$enum()->getValue(), $value);
        }
    }
}
