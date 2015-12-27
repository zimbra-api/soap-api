<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\DeployZimletAction;

/**
 * Testcase class for DeployZimletAction.
 */
class DeployZimletActionTest extends PHPUnit_Framework_TestCase
{
    public function testDeployZimletAction()
    {
        $values = [
            'DEPLOY_ALL' => 'deployAll',
            'DEPLOY_LOCAL' => 'deployLocal',
            'STATUS' => 'status',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(DeployZimletAction::$enum()->value(), $value);
        }
    }
}
