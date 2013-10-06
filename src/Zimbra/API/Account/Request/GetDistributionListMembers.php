<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Account\Request;

use Zimbra\Soap\Request;

/**
 * GetDistributionListMembers class
 * Get the list of members of a distribution list.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetDistributionListMembers extends Request
{
    /**
     * The name of the distribution list
     * @var string
     */
    private $_dl;

    /**
     * The number of members to return (0 is default and means all)
     * @var int
     */
    private $_limit;

    /**
     * The starting offset (0, 25, etc)
     * @var int
     */
    private $_offset;
    /**
     * Constructor method for getDistributionListMembers
     * @param string $ld     The name of the distribution list
     * @param int    $limit  The number of members to return (0 is default and means all)
     * @param int    $offset The starting offset (0, 25, etc)
     * @return self
     */
    public function __construct($dl, $limit = null, $offset = null)
    {
        parent::__construct();
        $this->_dl = trim($dl);
        if(empty($this->_dl))
        {
            throw new \InvalidArgumentException('GetDistributionListMembers must have a name');
        }
        if(null !== $limit)
        {
            $this->_limit = (int) $limit;
        }
        if(null !== $offset)
        {
            $this->_offset = (int) $offset;
        }
    }

    /**
     * Gets or sets dl
     *
     * @param  string $dl The name of the distribution list
     * @return string|self
     */
    public function dl($dl = null)
    {
        if(null === $dl)
        {
            return $this->_dl;
        }
        $this->_dl = trim($dl);
        if(empty($this->_dl))
        {
            throw new \InvalidArgumentException('GetDistributionListMembers must have a name');
        }
        return $this;
    }

    /**
     * Gets or sets limit
     *
     * @param  int $limit The number of members to return (0 is default and means all)
     * @return int|self
     */
    public function limit($limit = null)
    {
        if(null === $limit)
        {
            return $this->_limit;
        }
        $this->_limit = (int) $limit;
        return $this;
    }

    /**
     * Gets or sets offset
     *
     * @param  int $offset The starting offset (0, 25, etc)
     * @return int|self
     */
    public function offset($offset = null)
    {
        if(null === $offset)
        {
            return $this->_offset;
        }
        $this->_offset = (int) $offset;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = array(
            'dl' => $this->_dl,
        );
        if($this->_limit !== null)
        {
            $this->array['limit'] = (int) $this->_limit;
        }
        if($this->_offset !== null)
        {
            $this->array['offset'] = (int) $this->_offset;
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
        $this->xml->addChild('dl', (string) $this->_dl);
        if(is_int($this->_limit))
        {
            $this->xml->addAttribute('limit', $this->_limit);
        }
        if(is_int($this->_offset))
        {
            $this->xml->addAttribute('offset', (int) $this->_offset);
        }
        return parent::toXml();
    }
}
