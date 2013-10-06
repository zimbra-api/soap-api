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
use Zimbra\Soap\Struct\LimitedQuery as Query;

/**
 * CheckGalConfig class
 * Check Global Addressbook Configuration.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CheckGalConfig extends Attr
{
    /**
     * The query
     * @var Query
     */
    private $_query;

    /**
     * The action. Can be autocomplete|search|sync. Default is search
     * @var string
     */
    private $_action;

    /**
     * The attributes
     * @var string
     */
    private $_attrs = array();

    /**
     * Constructor method for CheckGalConfig
     *
     * @param Query $query
     * @param string $action
     * @param array  $attrs
     * @return self
     */
    public function __construct(Query $query = null, $action = null, array $attrs = array())
    {
        parent::__construct($attrs);
        if($query instanceof Query)
        {
            $this->_query = $query;
        }
        if(in_array(trim($action), array('autocomplete', 'search', 'sync')))
        {
            $this->_action = trim($action);
        }
    }

    /**
     * Gets or sets query
     *
     * @param  Query $query
     * @return Query|self
     */
    public function query(Query $query = null)
    {
        if(null === $query)
        {
            return $this->_query;
        }
        $this->_query = $query;
        return $this;
    }

    /**
     * Gets or sets action
     *
     * @param  string $action
     * @return string|self
     */
    public function action($action = null)
    {
        if(null === $action)
        {
            return $this->_action;
        }
        if(in_array(trim($action), array('autocomplete', 'search', 'sync')))
        {
            $this->_action = trim($action);
        }
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if($this->_query instanceof Query)
        {
            $this->array += $this->_query->toArray();
        }
        if(!empty($this->_action))
        {
            $this->array['action'] = $this->_action;
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
        if($this->_query instanceof Query)
        {
            $this->xml->append($this->_query->toXml());
        }
        if(!empty($this->_action))
        {
            $this->xml->addChild('action', $this->_action);
        }
        return parent::toXml();
    }
}
