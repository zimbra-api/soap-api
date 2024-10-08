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

/**
 * ZimletDeployAction enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum ZimletDeployAction: string
{
    /**
     * Constant for value 'deployAll'
     * @return string 'deployAll'
     */
    case DEPLOY_ALL = "deployAll";

    /**
     * Constant for value 'deployLocal'
     * @return string 'deployLocal'
     */
    case DEPLOY_LOCAL = "deployLocal";

    /**
     * Constant for value 'status'
     * @return string 'status'
     */
    case STATUS = "status";
}
