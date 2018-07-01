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
 * SectionType enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class SectionType extends Base
{
    /**
     * Constant for value 'mbox'
     * @return string 'mbox'
     */
    const MBOX = 'mbox';

    /**
     * Constant for value 'prefs'
     * @return string 'prefs'
     */
    const PREFS = 'prefs';

    /**
     * Constant for value 'attrs'
     * @return string 'attrs'
     */
    const ATTRS = 'attrs';

    /**
     * Constant for value 'zimlets'
     * @return string 'zimlets'
     */
    const ZIMLETS = 'zimlets';

    /**
     * Constant for value 'props'
     * @return string 'props'
     */
    const PROPS = 'props';

    /**
     * Constant for value 'idents'
     * @return string 'idents'
     */
    const IDENTS = 'idents';

    /**
     * Constant for value 'sigs'
     * @return string 'sigs'
     */
    const SIGS = 'sigs';

    /**
     * Constant for value 'dsrcs'
     * @return string 'dsrcs'
     */
    const DSRCS = 'dsrcs';

    /**
     * Constant for value 'children'
     * @return string 'children'
     */
    const CHILDREN = 'children';
}
