<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\DocumentActionOp;

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
        foreach ($values as $name => $value) {
            $this->assertSame(DocumentActionOp::from($value)->name, $name);
            $this->assertSame(DocumentActionOp::from($value)->value, $value);
        }
    }
}
