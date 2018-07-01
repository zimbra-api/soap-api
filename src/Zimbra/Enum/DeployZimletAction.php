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
 * DeployZimletAction enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class DeployZimletAction extends Base
{
    /**
     * Constant for value 'deployAll'
     * @return string 'deployAll'
     */
    const DEPLOY_ALL = 'deployAll';

    /**
     * Constant for value 'deployLocal'
     * @return string 'deployLocal'
     */
    const DEPLOY_LOCAL = 'deployLocal';

    /**
     * Constant for value 'status'
     * @return string 'status'
     */
    const STATUS = 'status';
}
