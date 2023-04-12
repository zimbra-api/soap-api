<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\ZimletDeployAction;

/**
 * Testcase class for ZimletDeployAction.
 */
class ZimletDeployActionTest extends TestCase
{
    public function testZimletDeployAction()
    {
        $values = [
            'DEPLOY_ALL'  => 'deployAll',
            'DEPLOY_LOCAL' => 'deployLocal',
            'STATUS' => 'status',
        ];
        foreach ($values as $name => $value) {
            $this->assertSame(ZimletDeployAction::from($value)->value, $value);
            $this->assertSame(ZimletDeployAction::from($value)->name, $name);
        }
    }
}
