<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Struct;

/**
 * SearchFilterCondition interface
 *
 * @package   Zimbra
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
interface SearchFilterCondition
{
    /**
     * Gets not flag
     *
     * @return bool
     */
    function getNot();

    /**
     * Sets not flag
     *
     * @param  bool $not
     * @return self
     */
    function setNot($not);
}
