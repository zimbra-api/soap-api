<?php

namespace Zimbra\Tests\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\DocumentPermission;

/**
 * Testcase class for DocumentPermission.
 */
class DocumentPermissionTest extends TestCase
{
    public function testDocumentPermission()
    {
        $values = [
            'READ'   => 'r',
            'WRITE'  => 'w',
            'DELETE' => 'd',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(DocumentPermission::$enum()->getValue(), $value);
        }
    }
}
