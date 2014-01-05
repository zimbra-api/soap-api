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
 * FilterAction class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class FilterAction
{
    /**
     * Index - specifies a guaranteed order for the action elements
     * @var int
     */
    private $_index;

    /**
     * Constructor method for FilterAction
     * @param int $index
     * @return self
     */
    public function __construct($index)
    {
        $this->_index = (int) $index;
    }

    /**
     * Gets or sets index
     *
     * @param  string $index
     * @return string|self
     */
    public function index($index = null)
    {
        if(null === $index)
        {
            return $this->_index;
        }
        $this->_index = (int) $index;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'actionFilter')
    {
        $name = !empty($name) ? $name : 'actionFilter';
        $arr = array('index' => $this->_index);
        return array($name => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'actionFilter')
    {
        $name = !empty($name) ? $name : 'actionFilter';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('index', $this->_index);
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
