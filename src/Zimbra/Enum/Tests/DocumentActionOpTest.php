<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\DocumentActionOp;

/**
 * Testcase class for DocumentActionOp.
 */
class DocumentActionOpTest extends TestCase
{
    public function testDocumentActionOp()
    {
        $values = [
            'WATCH'     => 'watch',
            'NOT_WATCH' => '!watch',
            'GRANT'     => 'grant',
            'NOT_GRANT' => '!grant',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(DocumentActionOp::$enum()->getValue(), $value);
        }
    }
}
