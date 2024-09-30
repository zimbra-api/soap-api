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
 * EnumTargetType enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class TargetType extends Enum
{
    /**
     * Constant for value 'account'
     * @return string 'account'
     */
    protected const ACCOUNT = "account";

    /**
     * Constant for value 'calresource'
     * @return string 'calresource'
     */
    protected const CALRESOURCE = "calresource";

    /**
     * Constant for value 'cos'
     * @return string 'cos'
     */
    protected const COS = "cos";

    /**
     * Constant for value 'dl'
     * @return string 'dl'
     */
    protected const DL = "dl";

    /**
     * Constant for value 'group'
     * @return string 'group'
     */
    protected const GROUP = "group";

    /**
     * Constant for value 'domain'
     * @return string 'domain'
     */
    protected const DOMAIN = "domain";

    /**
     * Constant for value 'server'
     * @return string 'server'
     */
    protected const SERVER = "server";

    /**
     * Constant for value 'alwaysoncluster'
     * @return string 'alwaysoncluster'
     */
    protected const ALWAYSONCLUSTER = "alwaysoncluster";

    /**
     * Constant for value 'ucservice'
     * @return string 'ucservice'
     */
    protected const UCSERVICE = "ucservice";

    /**
     * Constant for value 'xmppcomponent'
     * @return string 'xmppcomponent'
     */
    protected const XMPPCOMPONENT = "xmppcomponent";

    /**
     * Constant for value 'zimlet'
     * @return string 'zimlet'
     */
    protected const ZIMLET = "zimlet";

    /**
     * Constant for value 'config'
     * @return string 'config'
     */
    protected const CONFIG = "config";

    /**
     * Constant for value 'global'
     * @return string 'global'
     */
    protected const GLOBALTYPE = "global";
}
