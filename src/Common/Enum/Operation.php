<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Enum;

use MyCLabs\Enum\Enum;

/**
 * Operation enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class Operation extends Enum
{
    /**
     * Constant for value 'delete'
     * @return string 'delete'
     */
    protected const DELETE = 'delete';

    /**
     * Constant for value 'modify'
     * @return string 'modify'
     */
    protected const MODIFY = 'modify';

    /**
     * Constant for value 'rename'
     * @return string 'rename'
     */
    protected const RENAME = 'rename';

    /**
     * Constant for value 'addOwners'
     * @return string 'addOwners'
     */
    protected const ADD_OWNERS = 'addOwners';

    /**
     * Constant for value 'removeOwners'
     * @return string 'removeOwners'
     */
    protected const REMOVE_OWNERS = 'removeOwners';

    /**
     * Constant for value 'setOwners'
     * @return string 'setOwners'
     */
    protected const SET_OWNERS = 'setOwners';

    /**
     * Constant for value 'grantRights'
     * @return string 'grantRights'
     */
    protected const GRANT_RIGHTS = 'grantRights';

    /**
     * Constant for value 'revokeRights'
     * @return string 'revokeRights'
     */
    protected const REVOKE_RIGHTS = 'revokeRights';

    /**
     * Constant for value 'setRights'
     * @return string 'setRights'
     */
    protected const SET_RIGHTS = 'setRights';

    /**
     * Constant for value 'addMembers'
     * @return string 'addMembers'
     */
    protected const ADD_MEMBERS = 'addMembers';

    /**
     * Constant for value 'removeMembers'
     * @return string 'removeMembers'
     */
    protected const REMOVE_MEMBERS = 'removeMembers';

    /**
     * Constant for value 'acceptSubsReq'
     * @return string 'acceptSubsReq'
     */
    protected const ACCEPT_SUBS_REQ = 'acceptSubsReq';

    /**
     * Constant for value 'rejectSubsReq'
     * @return string 'rejectSubsReq'
     */
    protected const REJECT_SUBS_REQ = 'rejectSubsReq';
}
