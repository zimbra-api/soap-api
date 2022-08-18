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
 * SectionType enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum SectionType: string
{
    /**
     * Constant for value 'mbox'
     * @return string 'mbox'
     */
    case MBOX = 'mbox';

    /**
     * Constant for value 'prefs'
     * @return string 'prefs'
     */
    case PREFS = 'prefs';

    /**
     * Constant for value 'attrs'
     * @return string 'attrs'
     */
    case ATTRS = 'attrs';

    /**
     * Constant for value 'zimlets'
     * @return string 'zimlets'
     */
    case ZIMLETS = 'zimlets';

    /**
     * Constant for value 'props'
     * @return string 'props'
     */
    case PROPS = 'props';

    /**
     * Constant for value 'idents'
     * @return string 'idents'
     */
    case IDENTS = 'idents';

    /**
     * Constant for value 'sigs'
     * @return string 'sigs'
     */
    case SIGS = 'sigs';

    /**
     * Constant for value 'dsrcs'
     * @return string 'dsrcs'
     */
    case DSRCS = 'dsrcs';

    /**
     * Constant for value 'children'
     * @return string 'children'
     */
    case CHILDREN = 'children';
}
