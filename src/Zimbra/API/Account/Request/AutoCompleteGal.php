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
     * The name to test for autocompletion
     * - use : required
     * @var string
     */
    private $_name;

    /**
     * Flag whether the {exp} flag is needed in the response for group entries.
     * @var boolean
     */
    private $_needExp;

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
     * @param  string $name
     * @param  bool   $needExp
     * @param  string $type
     * @param  string $galAcctId
     * @param  int    $limit
     * @return self
     */
    public function __construct(
        $name,
        $needExp = null,
        SearchType $type = null,
        $galAcctId = null,
        $limit = null)
    {
        parent::__construct();
        $this->_name = trim($name);
        $this->_galAcctId = trim($galAcctId);
        if(null !== $needExp)
        {
            $this->_needExp = (bool) $needExp;
        }
        if($type instanceof SearchType)
        {
            $this->_type = $type;
        }
        if(null !== $limit)
        {
            $this->_limit = (int) $limit;
        }
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
     * Gets or sets needExp
     *
     * @param  bool $needExp
     * @return bool|self
     */
    public function needExp($needExp = null)
    {
        if(null === $needExp)
        {
            return $this->_needExp;
        }
        $this->_needExp = (bool) $needExp;
        return $this;
    }

    /**
     * Gets or sets type
     *
     * @param  SearchType $type
     * @return SearchType|self
     */
    public function type(SearchType $type = null)
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
            'name' => $this->_name,
        );
        if(is_bool($this->_needExp))
        {
            $this->array['needExp'] = $this->_needExp ? 1 : 0;
        }
        if($this->_type instanceof SearchType)
        {
            $this->array['type'] = (string) $this->_type;
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
        $this->xml->addAttribute('name', $this->_name);
        if(is_bool($this->_needExp))
        {
            $this->xml->addAttribute('needExp', $this->_needExp ? 1 : 0);
        }
        if($this->_type instanceof SearchType)
        {
            $this->xml->addAttribute('type', (string) $this->_type);
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
