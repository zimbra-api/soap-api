<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\QueueActionBy;

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
