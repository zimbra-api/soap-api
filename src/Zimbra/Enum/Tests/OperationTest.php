<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\Operation;

/**
 * Testcase class for Operation.
 */
class OperationTest extends PHPUnit_Framework_TestCase
{
    public function testOperation()
    {
        $values = [
            'DELETE'          => 'delete',
            'MODIFY'          => 'modify',
            'RENAME'          => 'rename',
            'ADD_OWNERS'      => 'addOwners',
            'REMOVE_OWNERS'   => 'removeOwners',
            'SET_OWNERS'      => 'setOwners',
            'GRANT_RIGHTS'    => 'grantRights',
            'REVOKE_RIGHTS'   => 'revokeRights',
            'SET_RIGHTS'      => 'setRights',
            'ADD_MEMBERS'     => 'addMembers',
            'REMOVE_MEMBERS'  => 'removeMembers',
            'ACCEPT_SUBS_REQ' => 'acceptSubsReq',
            'REJECT_SUBS_REQ' => 'rejectSubsReq',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(Operation::$enum()->value(), $value);
        }
    }
}
