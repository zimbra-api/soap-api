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
 * ShareAction enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ShareAction extends Enum
{
    /**
     * Constant for value 'edit'
     * @return string 'edit'
     */
    private const EDIT = 'edit';

    /**
     * Constant for value 'revoke'
     * @return string 'revoke'
     */
    private const REVOKE = 'revoke';

    /**
     * Constant for value 'expire'
     * @return string 'expire'
     */
    private const EXPIRE = 'expire';
}
