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
 * DistributionListSubscribeStatus enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DistributionListSubscribeStatus extends Enum
{
    /**
     * Constant for value 'subscribe'
     * @return string 'subscribed'
     */
    protected const SUBSCRIBED = "subscribed";

    /**
     * Constant for value 'unsubscribed'
     * @return string 'unsubscribed'
     */
    protected const UNSUBSCRIBED = "unsubscribed";

    /**
     * Constant for value 'awaiting_approval'
     * @return string 'awaiting_approval'
     */
    protected const AWAITING_APPROVAL = "awaiting_approval";
}
