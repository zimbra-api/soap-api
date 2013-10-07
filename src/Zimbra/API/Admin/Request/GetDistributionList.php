<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Admin\Request;

use Zimbra\Soap\Request\Attr;
use Zimbra\Soap\Struct\DistributionListSelector as DistList;

/**
 * GetDistributionList class
 * Get a Distribution List.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetDistributionList extends Attr
{
    /**
     * Distribution List
     * @var DistList
     */
    private $_dl;

    /**
     * The maximum number of accounts to return (0 is default and means all)
     * @var int
     */
    private $_limit;

    /**
     * The starting offset (0, 25 etc)
     * @var int
     */
    private $_offset;

    /**
     * Flag whether to sort in ascending order 1 (true) is the default
     * @var bool
     */
    private $_sortAscending;

    /**
     * Constructor method for GetDistributionList
     * @param  DistributionList $dl
     * @param  int $limit
     * @param  int $offset
     * @param  bool $sortAscending
     * @param  array $attr
     * @return self
     */
    public function __construct(
        DistList $dl = null,
        $limit = null,
        $offset = null,
        $sortAscending = null,
        array $attr = array())
    {
        parent::__construct($attr);
        if($dl instanceof DistList)
        {
            $this->_dl = $dl;
        }
        if(null !== $limit)
        {
            $this->_limit = (int) $limit;
        }
        if(null !== $offset)
        {
            $this->_offset = (int) $offset;
        }
        if(null !== $sortAscending)
        {
            $this->_sortAscending = (bool) $sortAscending;
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
            return $this->_dl;
        }
        $this->_dl = $dl;
        return $this;
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
            return $this->_limit;
        }
        $this->_limit = intval($limit);
        return $this;
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
            return $this->_offset;
        }
        $this->_offset = intval($offset);
        return $this;
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
            return $this->_sortAscending;
        }
        $this->_sortAscending = (bool) $sortAscending;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if($this->_dl instanceof DistList)
        {
            $this->array += $this->_dl->toArray();
        }
        if(is_int($this->_limit))
        {
            $this->array['limit'] = $this->_limit;
        }
        if(is_int($this->_offset))
        {
            $this->array['offset'] = $this->_offset;
        }
        if(is_bool($this->_sortAscending))
        {
            $this->array['sortAscending'] = $this->_sortAscending ? 1 : 0;
        }
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        if($this->_dl instanceof DistList)
        {
            $this->xml->append($this->_dl->toXml());
        }
        if(is_int($this->_limit))
        {
            $this->xml->addAttribute('limit', $this->_limit);
        }
        if(is_int($this->_offset))
        {
            $this->xml->addAttribute('offset', $this->_offset);
        }
        if(is_bool($this->_sortAscending))
        {
            $this->xml->addAttribute('sortAscending', $this->_sortAscending ? 1 : 0);
        }
        return parent::toXml();
    }
}
