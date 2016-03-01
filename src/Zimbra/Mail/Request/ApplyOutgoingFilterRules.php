<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Request;

use Zimbra\Mail\Struct\IdsAttr;
use Zimbra\Mail\Struct\NamedFilterRules;

/**
 * ApplyOutgoingFilterRules request class
 * Applies one or more filter rules to messages specified by a comma-separated ID list, or returned by a search query.
 * One or the other can be specified, but not both.
 * Returns the list of ids of existing messages that were affected.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ApplyOutgoingFilterRules extends ApplyFilterRules
{
}
