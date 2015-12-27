<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\DocumentActionOp;

/**
 * Testcase class for DocumentActionOp.
 */
class DocumentActionOpTest extends PHPUnit_Framework_TestCase
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
            $this->assertSame(DocumentActionOp::$enum()->value(), $value);
        }
    }
}
