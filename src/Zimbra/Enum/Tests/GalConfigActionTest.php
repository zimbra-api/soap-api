<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\GalConfigAction;

/**
 * Testcase class for GalConfigAction.
 */
class GalConfigActionTest extends TestCase
{
    public function testGalConfigAction()
    {
        $values = [
            'AUTOCOMPLETE' => 'autocomplete',
            'SEARCH'       => 'search',
            'SYNC'         => 'sync',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(GalConfigAction::$enum()->value(), $value);
        }
    }
}
