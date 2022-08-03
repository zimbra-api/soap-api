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
 * InfoSection enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class InfoSection extends Enum
{
    /**
     * Constant for value 'mbox'
     * @return string 'mbox'
     */
    protected const MBOX = 'mbox';

    /**
     * Constant for value 'prefs'
     * @return string 'prefs'
     */
    protected const PREFS = 'prefs';

    /**
     * Constant for value 'attrs'
     * @return string 'attrs'
     */
    protected const ATTRS = 'attrs';

    /**
     * Constant for value 'zimlets'
     * @return string 'zimlets'
     */
    protected const ZIMLETS = 'zimlets';

    /**
     * Constant for value 'props'
     * @return string 'props'
     */
    protected const PROPS = 'props';

    /**
     * Constant for value 'idents'
     * @return string 'idents'
     */
    protected const IDENTS = 'idents';

    /**
     * Constant for value 'sigs'
     * @return string 'sigs'
     */
    protected const SIGS = 'sigs';

    /**
     * Constant for value 'dsrcs'
     * @return string 'dsrcs'
     */
    protected const DSRCS = 'dsrcs';

    /**
     * Constant for value 'children'
     * @return string 'children'
     */
    protected const CHILDREN = 'children';
}
