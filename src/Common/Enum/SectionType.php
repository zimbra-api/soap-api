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
 * SectionType enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SectionType extends Enum
{
    /**
     * Constant for value 'mbox'
     * @return string 'mbox'
     */
    private const MBOX = 'mbox';

    /**
     * Constant for value 'prefs'
     * @return string 'prefs'
     */
    private const PREFS = 'prefs';

    /**
     * Constant for value 'attrs'
     * @return string 'attrs'
     */
    private const ATTRS = 'attrs';

    /**
     * Constant for value 'zimlets'
     * @return string 'zimlets'
     */
    private const ZIMLETS = 'zimlets';

    /**
     * Constant for value 'props'
     * @return string 'props'
     */
    private const PROPS = 'props';

    /**
     * Constant for value 'idents'
     * @return string 'idents'
     */
    private const IDENTS = 'idents';

    /**
     * Constant for value 'sigs'
     * @return string 'sigs'
     */
    private const SIGS = 'sigs';

    /**
     * Constant for value 'dsrcs'
     * @return string 'dsrcs'
     */
    private const DSRCS = 'dsrcs';

    /**
     * Constant for value 'children'
     * @return string 'children'
     */
    private const CHILDREN = 'children';
}
