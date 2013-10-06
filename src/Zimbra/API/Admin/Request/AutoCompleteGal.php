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
use Zimbra\Soap\Enum\GalSearchType as SearchType;

/**
 * AutoCompleteGal class
 * Perform an autocomplete for a name against the Global Address List.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class AutoCompleteGal extends Request
{
    /**
     * The domain.
     * @var string
     */
    private $_domain;

    /**
     * The name to test for autocompletion
     * @var string
     */
    private $_name;

    /**
     * Type of addresses to auto-complete on
     * @var string
     */
    private $_type;

    /**
     * GAL Account ID
     * @var string
     */
    private $_galAcctId;

    /**
     * An integer specifying the maximum number of results to return
     * @var int
     */
    private $_limit;

    /**
     * Constructor method for AutoCompleteGal
     * @param  string $domain
     * @param  string $name
     * @param  string $type
     * @param  string $galAcctId
     * @param  int    $limit
     * @return self
     */
    public function __construct(
        $domain,
        $name,
        $type = null,
        $galAcctId = null,
        $limit = null)
    {
        parent::__construct();
        $this->_domain = trim($domain);
        $this->_name = trim($name);
        if(SearchType::isValid(trim($type)))
        {
            $this->_type = trim($type);
        }
		$this->_galAcctId = trim($galAcctId);
        if(null !== $limit)
        {
            $this->_limit = (int) $limit;
        }
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
     * Gets or sets type
     *
     * @param  string $type
     * @return string|self
     */
    public function type($type = null)
    {
        if(null === $type)
        {
            return $this->_type;
        }
        if(SearchType::isValid($type))
        {
            $this->_type = trim($type);
        }
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
     * Gets or sets int
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
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = array(
            'domain' => $this->_domain,
            'name' => $this->_name,
        );
        if(!empty($this->_type))
        {
            $this->array['type'] = $this->_type;
        }
        if(!empty($this->_galAcctId))
        {
            $this->array['galAcctId'] = $this->_galAcctId;
        }
        if(is_int($this->_limit))
        {
            $this->array['limit'] = $this->_limit;
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
        $this->xml->addAttribute('name', $this->_name)
                  ->addAttribute('domain', $this->_domain);
        if(!empty($this->_type))
        {
            $this->xml->addAttribute('type', $this->_type);
        }
        if(!empty($this->_galAcctId))
        {
            $this->xml->addAttribute('galAcctId', $this->_galAcctId);
        }
        if(is_int($this->_limit))
        {
            $this->xml->addAttribute('limit', $this->_limit);
        }
        return parent::toXml();
    }
}
