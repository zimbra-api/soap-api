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
            'SEARCH'       => 'search',
            'SYNC'         => 'sync',
        ];
        foreach ($values as $name => $value) {
            $this->assertSame(GalConfigAction::from($value)->name, $name);
            $this->assertSame(GalConfigAction::from($value)->value, $value);
        }
    }
}
