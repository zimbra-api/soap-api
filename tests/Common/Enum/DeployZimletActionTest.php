<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\DeployZimletAction;

/**
 * Testcase class for DeployZimletAction.
 */
class DeployZimletActionTest extends TestCase
{
    public function testDeployZimletAction()
    {
        $values = [
            'DEPLOY_ALL' => 'deployAll',
            'DEPLOY_LOCAL' => 'deployLocal',
            'STATUS' => 'status',
        ];
        foreach ($values as $name => $value) {
            $this->assertSame(DeployZimletAction::from($value)->name, $name);
            $this->assertSame(DeployZimletAction::from($value)->value, $value);
        }
    }
}
