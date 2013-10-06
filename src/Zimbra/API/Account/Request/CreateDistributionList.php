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

use Zimbra\Soap\Request\Attr;

/**
 * CreateDistributionList class
 * Create a Distribution List
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CreateDistributionList extends Attr
{
    /**
     * Name for the new Distribution List
     * @var string
     */
    private $_name;

    /**
     * Flag type of distribution list to create
     * set to 1 (true) [default]     create a dynamic distribution list
     * set to 0 (false)     create a static distribution list
     * @var bool
     */
    private $_dynamic;

    /**
     * Constructor method for createDistributionList
     * @param  string $name    Name for the new Distribution List
     * @param  bool   $dynamic Flag type of distribution list to create
     * @param  array  $attrs   Attributes specified as key value pairs
     * @return self
     */
    public function __construct($name, $dynamic = null, array $attrs = array())
    {
        parent::__construct($attrs);
        $this->_name = trim($name);
        if(null !== $dynamic)
        {
            $this->_dynamic = (bool) $dynamic;
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
     * Gets or sets dynamic
     *
     * @param  bool $dynamic
     * @return bool|self
     */
    public function dynamic($dynamic = null)
    {
        if(null === $dynamic)
        {
            return $this->_dynamic;
        }
        $this->_dynamic = (bool) $dynamic;
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
        if(is_bool($this->_dynamic))
        {
            $this->array['dynamic'] = $this->_dynamic ? 1 : 0;
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
        if(is_bool($this->_dynamic))
        {
            $this->xml->addAttribute('dynamic', $this->_dynamic ? 1 : 0);
        }
        return parent::toXml();
    }
}
