<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Enum;

/**
 * Operation enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class Operation extends Base
{
    /**
     * Constant for value 'delete'
     * @return string 'delete'
     */
    const DELETE = 'delete';

    /**
     * Constant for value 'modify'
     * @return string 'modify'
     */
    const MODIFY = 'modify';

    /**
     * Constant for value 'rename'
     * @return string 'rename'
     */
    const RENAME = 'rename';

    /**
     * Constant for value 'addOwners'
     * @return string 'addOwners'
     */
    const ADD_OWNERS = 'addOwners';

    /**
     * Constant for value 'removeOwners'
     * @return string 'removeOwners'
     */
    const REMOVE_OWNERS = 'removeOwners';

    /**
     * Constant for value 'setOwners'
     * @return string 'setOwners'
     */
    const SET_OWNERS = 'setOwners';

    /**
     * Constant for value 'grantRights'
     * @return string 'grantRights'
     */
    const GRANT_RIGHTS = 'grantRights';

    /**
     * Constant for value 'revokeRights'
     * @return string 'revokeRights'
     */
    const REVOKE_RIGHTS = 'revokeRights';

    /**
     * Constant for value 'setRights'
     * @return string 'setRights'
     */
    const SET_RIGHTS = 'setRights';

    /**
     * Constant for value 'addMembers'
     * @return string 'addMembers'
     */
    const ADD_MEMBERS = 'addMembers';

    /**
     * Constant for value 'removeMembers'
     * @return string 'removeMembers'
     */
    const REMOVE_MEMBERS = 'removeMembers';

    /**
     * Constant for value 'acceptSubsReq'
     * @return string 'acceptSubsReq'
     */
    const ACCEPT_SUBS_REQ = 'acceptSubsReq';

    /**
     * Constant for value 'rejectSubsReq'
     * @return string 'rejectSubsReq'
     */
    const REJECT_SUBS_REQ = 'rejectSubsReq';
}
