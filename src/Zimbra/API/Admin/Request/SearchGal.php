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

use Zimbra\Soap\Request;
use Zimbra\Soap\Enum\GalSearchType;

/**
 * SearchGal class
 * Search Global Address Book (GAL).
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class SearchGal extends Request
{
    /**
     * Domain name.
     * @var string
     */
    private $_domain;

    /**
     * Name
     * @var string
     */
    private $_name;

    /**
     * The maximum number of entries to return (0 is default and means all)
     * @var int
     */
    private $_limit;

    /**
     * Type of addresses to search.
     * Valid values: all|account|resource|group.
     * @var string
     */
    private $_type;

    /**
     * GAL account ID.
     * @var string
     */
    private $_galAcctId;

    /**
     * Valid types
     * @var array
     */
    private static $_validTypes = array('all', 'account', 'resource', 'group');

    /**
     * Constructor method for SearchGal
     * @see parent::__construct()
     * @param string $domain
     * @param string $name
     * @param int $limit
     * @param GalSearchType $type
     * @param string $galAcctId
     * @return self
     */
    public function __construct(
        $domain,
        $name = null,
        $limit = null,
        GalSearchType $type = null,
        $galAcctId = null
    )
    {
        parent::__construct();
        $this->_domain = trim($domain);
        $this->_name = trim($name);
        if(null !== $limit)
        {
            $this->_limit = (int) $limit;
        }
        if($type instanceof GalSearchType)
        {
            $this->_type = $type;
        }
        $this->_galAcctId = trim($galAcctId);
    }
    /**
     * Gets or sets domain
     *
     * @param  string $domain
     * @return string|self
     */
    public function domain($domain = null)
    {
        if(null === $domain)
        {
            return $this->_domain;
        }
        $this->_domain = trim($domain);
        return $this;
    }

    /**
     * Gets or sets name
     *
     * @param  string $name
     * @return string|self
     */
    public function name($name = null)
    {
        if(null === $name)
        {
            return $this->_name;
        }
        $this->_name = trim($name);
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
        $this->_limit = (int) $limit;
        return $this;
    }

    /**
     * Gets or sets type
     *
     * @param  GalSearchType $type
     * @return GalSearchType|self
     */
    public function type(GalSearchType $type = null)
    {
        if(null === $type)
        {
            return $this->_type;
        }
        $this->_type = $type;
        return $this;
    }

    /**
     * Gets or sets galAcctId
     *
     * @param  string $galAcctId
     * @return string|self
     */
    public function galAcctId($galAcctId = null)
    {
        if(null === $galAcctId)
        {
            return $this->_galAcctId;
        }
        $this->_galAcctId = trim($galAcctId);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(!empty($this->_domain))
        {
            $this->array['domain'] = $this->_domain;
        }
        if(!empty($this->_name))
        {
            $this->array['name'] = $this->_name;
        }
        if(is_int($this->_limit))
        {
            $this->array['limit'] = $this->_limit;
        }
        if($this->_type instanceof GalSearchType)
        {
            $this->array['type'] = (string) $this->_type;
        }
        if(!empty($this->_galAcctId))
        {
            $this->array['galAcctId'] = $this->_galAcctId;
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
        if(!empty($this->_domain))
        {
            $this->xml->addAttribute('domain', $this->_domain);
        }
        if(!empty($this->_name))
        {
            $this->xml->addAttribute('name', $this->_name);
        }
        if(is_int($this->_limit))
        {
            $this->xml->addAttribute('limit', $this->_limit);
        }
        if($this->_type instanceof GalSearchType)
        {
            $this->xml->addAttribute('type', (string) $this->_type);
        }
        if(!empty($this->_galAcctId))
        {
            $this->xml->addAttribute('galAcctId', $this->_galAcctId);
        }
        return parent::toXml();
    }
}
