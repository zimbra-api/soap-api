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
        foreach ($values as $enum => $value) {
            $this->assertSame(ZimletDeployAction::$enum()->getValue(), $value);
        }
    }
}
