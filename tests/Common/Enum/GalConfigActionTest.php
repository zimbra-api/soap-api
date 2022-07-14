<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\GalConfigAction;

/**
 * Testcase class for GalConfigAction.
 */
class GalConfigActionTest extends TestCase
{
    public function testGalConfigAction()
    {
        $values = [
            'AUTOCOMPLETE' => 'autocomplete',
            'SEARCH_'       => 'search',
            'SYNC'         => 'sync',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(GalConfigAction::$enum()->getValue(), $value);
        }
    }
}