<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Struct;

/**
 * EntrySearchFilterInterface interface
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
interface EntrySearchFilterInterface
{
    /**
     * Get simple search filter condition
     *
     * @return SearchFilterCondition
     */
    function getCondition(): ?SearchFilterCondition;

    /**
     * Get compound search filter condition
     *
     * @return SearchFilterCondition
     */
    function getConditions(): ?SearchFilterCondition;

    /**
     * Set search filter condition
     *
     * @param  SearchFilterCondition $condition
     * @return self
     */
    function setCondition(SearchFilterCondition $condition): self;
}
