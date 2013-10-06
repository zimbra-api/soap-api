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

/**
 * CreateDistributionList class
 * Create a distribution list.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CreateDistributionList extends Attr
{
    /**
     * Name for distribution list
     * @var string
     */
    private $_name;

    /**
     * If 1 (true) then create a dynamic distribution list
     * @var bool
     */
    private $_dynamic;

    /**
     * Constructor method for CreateDistributionList
     * @param string $name
     * @param bool   $dynamic
     * @param array  $attrs
     * @return self
     */
    public function __construct($name, $dynamic = null, array $attrs = array())
    {
        parent::__construct($attrs);
        $this->_name = trim($name);
        $this->_dynamic = (bool) $dynamic;
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
