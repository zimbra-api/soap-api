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
 * GetDistributionListMembership request class
 * Request a list of DLs that a particular DL is a member of.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetDistributionListMembership extends Base
{
    /**
     * Constructor method for GetDistributionList
     * @param  DistList $dl Distribution List
     * @param  int $limit The maximum number of accounts to return (0 is default and means all)
     * @param  int $offset The starting offset (0, 25 etc)
     * @return self
     */
    public function __construct(
        DistList $dl = null,
        $limit = null,
        $offset = null
    )
    {
        parent::__construct();
        if($dl instanceof DistList)
        {
            $this->setChild('dl', $dl);
        }
        if(null !== $limit)
        {
            $this->setProperty('limit', (int) $limit);
        }
        if(null !== $offset)
        {
            $this->setProperty('offset', (int) $offset);
        }
    }

    /**
     * Gets the dl.
     *
     * @return DistList
     */
    public function getDl()
    {
        return $this->getChild('dl');
    }

    /**
     * Sets the dl.
     *
     * @param  DistList $dl
     * @return self
     */
    public function setDl(DistList $dl)
    {
        return $this->setChild('dl', $dl);
    }

    /**
     * Gets limit
     *
     * @return int
     */
    public function getLimit()
    {
        return $this->getProperty('limit');
    }

    /**
     * Sets limit
     *
     * @param  int $limit
     * @return self
     */
    public function setLimit($limit)
    {
        return $this->setProperty('limit', (int) $limit);
    }

    /**
     * Gets offset
     *
     * @return int
     */
    public function getOffset()
    {
        return $this->getProperty('offset');
    }

    /**
     * Sets offset
     *
     * @param  int $offset
     * @return self
     */
    public function setOffset($offset)
    {
        return $this->setProperty('offset', (int) $offset);
    }
}
