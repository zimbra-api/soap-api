<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\NewFileCreationTypes;

/**
 * Testcase class for NewFileCreationTypes.
 */
class NewFileCreationTypesTest extends TestCase
{
    public function testNewFileCreationTypes()
    {
        $values = [
            'DOCUMENT'     => 'document',
            'PRESENTATION' => 'presentation',
            'SPREADSHEET'  => 'spreadsheet',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(NewFileCreationTypes::$enum()->getValue(), $value);
        }
    }
}
