<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Request;

use Zimbra\Admin\Struct\DistributionListSelector as DistList;

/**
 * GetDistributionList request class
 * Get a Distribution List.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetDistributionList extends BaseAttr
{
    /**
     * Constructor method for GetDistributionList
     * @param  DistributionList $dl Distribution List
     * @param  int $limit The maximum number of dls to return (0 is default and means all)
     * @param  int $offset The starting offset (0, 25 etc)
     * @param  bool $sortAscending Flag whether to sort in ascending order 1 (true) is the default
     * @param  array $attrs
     * @return self
     */
    public function __construct(
        DistList $dl = null,
        $limit = null,
        $offset = null,
        $sortAscending = null,
        array $attrs = array()
    )
    {
        parent::__construct($attrs);
        if($dl instanceof DistList)
        {
            $this->child('dl', $dl);
        }
        if(null !== $limit)
        {
            $this->property('limit', (int) $limit);
        }
        if(null !== $offset)
        {
            $this->property('offset', (int) $offset);
        }
        if(null !== $sortAscending)
        {
            $this->property('sortAscending', (bool) $sortAscending);
        }
    }

    /**
     * Gets or sets dl
     *
     * @param  DistList $dl
     * @return DistList|self
     */
    public function dl(DistList $dl = null)
    {
        if(null === $dl)
        {
            return $this->child('dl');
        }
        return $this->child('dl', $dl);
    }

    /**
     * Gets or sets limit
     *
     * @param  int $limit
     * @return int|self
     */
    public function limit($limit = null)
    {
        if(null === $limit)
        {
            return $this->property('limit');
        }
        return $this->property('limit', (int) $limit);
    }

    /**
     * Gets or sets offset
     *
     * @param  int $offset
     * @return int|self
     */
    public function offset($offset = null)
    {
        if(null === $offset)
        {
            return $this->property('offset');
        }
        return $this->property('offset', (int) $offset);
    }

    /**
     * Gets or sets sortAscending
     *
     * @param  bool $sortAscending
     * @return bool|self
     */
    public function sortAscending($sortAscending = null)
    {
        if(null === $sortAscending)
        {
            return $this->property('sortAscending');
        }
        return $this->property('sortAscending', (bool) $sortAscending);
    }
}
