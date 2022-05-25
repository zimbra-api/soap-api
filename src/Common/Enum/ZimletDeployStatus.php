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
 * ZimletDeployStatus enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ZimletDeployStatus extends Enum
{
    /**
     * Constant for value 'succeeded'
     * @return string 'succeeded'
     */
    private const SUCCEEDED = 'succeeded';

    /**
     * Constant for value 'failed'
     * @return string 'failed'
     */
    private const FAILED = 'failed';

    /**
     * Constant for value 'pending'
     * @return string 'pending'
     */
    private const PENDING = 'pending';
}
