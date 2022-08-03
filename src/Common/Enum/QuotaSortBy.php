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
 * QuotaSortBy enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class QuotaSortBy extends Enum
{
    /**
     * Constant for value 'percentUsed'
     * @return string 'percentUsed'
     */
    protected const PERCENT_USED = 'percentUsed';

    /**
     * Constant for value 'totalUsed'
     * @return string 'totalUsed'
     */
    protected const TOTAL_USED = 'totalUsed';

    /**
     * Constant for value 'quotaLimit'
     * @return string 'quotaLimit'
     */
    protected const QUOTA_LIMIT = 'quotaLimit';
}
