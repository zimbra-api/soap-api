<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\DocumentPermission;

/**
 * Testcase class for DocumentPermission.
 */
class DocumentPermissionTest extends PHPUnit_Framework_TestCase
{
    public function testDocumentPermission()
    {
        $values = [
            'READ'   => 'r',
            'WRITE'  => 'w',
            'DELETE' => 'd',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(DocumentPermission::$enum()->value(), $value);
        }
    }
}
