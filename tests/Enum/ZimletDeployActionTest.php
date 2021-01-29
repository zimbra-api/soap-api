<?php

namespace Zimbra\Tests\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\ZimletDeployAction;

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
        foreach ($values as $enum => $value) {
            $this->assertSame(ZimletDeployAction::$enum()->getValue(), $value);
        }
    }
}
