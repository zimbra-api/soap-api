<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Utils\SimpleXML;

/**
 * StatsSpec class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class StatsSpec
{
    /**
     * Stats value wrapper
     * @var StatsValueWrapper
     */
    private $_values;

    /**
     * Name
     * @var string
     */
    private $_name;

    /**
     * if limit="true" is specified, attempt to reduce result set to under 500 records
     * @var string
     */
    private $_limit;

    /**
     * Constructor method for StatsSpec
     * @param  StatsValueWrapper $values
     * @param  string $name
     * @param  string $limit
     * @return self
     */
    public function __construct(StatsValueWrapper $values, $name = null, $limit = null)
    {
        $this->_values = $values;
        $this->_name = trim($name);
        $this->_limit = trim($limit);
    }

    /**
     * Gets or sets values
     *
     * @param  StatsValueWrapper $values
     * @return StatsValueWrapper|self
     */
    public function values(StatsValueWrapper $values = null)
    {
        if(null === $values)
        {
            return $this->_values;
        }
        $this->_values = $values;
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
     * @param  string $limit
     * @return string|self
     */
    public function limit($limit = null)
    {
        if(null === $limit)
        {
            return $this->_limit;
        }
        $this->_limit = trim($limit);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $arr = $this->_values->toArray();
        if(!empty($this->_name))
        {
            $arr['name'] = $this->_name;
        }
        if(!empty($this->_limit))
        {
            $arr['limit'] = $this->_limit;
        }

        return array('stats' => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $xml = new SimpleXML('<stats />');
        $xml->append($this->_values->toXml());
        if(!empty($this->_name))
        {
            $xml->addAttribute('name', $this->_name);
        }
        if(!empty($this->_limit))
        {
            $xml->addAttribute('limit', $this->_limit);
        }
        return $xml;
    }

    /**
     * Method returning the xml string representative this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
