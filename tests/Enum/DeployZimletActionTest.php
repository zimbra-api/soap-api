<?php

namespace Zimbra\Tests\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\DeployZimletAction;

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
        foreach ($values as $enum => $value) {
            $this->assertSame(DeployZimletAction::$enum()->getValue(), $value);
        }
    }
}
