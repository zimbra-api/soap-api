<?php declare(strict_types=1);
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
 * EntrySearchFilterInterface interface
 *
 * @package   Zimbra
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
interface EntrySearchFilterInterface
{
    /**
     * Gets simple search filter condition
     *
     * @return SearchFilterCondition
     */
    function getCondition(): ?SearchFilterCondition;

    /**
     * Gets compound search filter condition
     *
     * @return SearchFilterCondition
     */
    function getConditions(): ?SearchFilterCondition;

    /**
     * Sets search filter condition
     *
     * @param  SearchFilterCondition $condition
     * @return self
     */
    function setCondition(SearchFilterCondition $condition): self;
}