<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\DocumentPermission;

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
        foreach ($values as $name => $value) {
            $this->assertSame(DocumentPermission::from($value)->name, $name);
            $this->assertSame(DocumentPermission::from($value)->value, $value);
        }
    }
}
