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

/**
 * UndeployZimlet class
 * Undeploy Zimlet.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class UndeployZimlet extends Request
{
    /**
     * Zimlet name
     * @var string
     */
    private $_name;

    /**
     * Action
     * @var string
     */
    private $_action;

    /**
     * Constructor method for UndeployZimlet
     * @param string $name
     * @param string $action
     * @return self
     */
    public function __construct($name, $action = null)
    {
        parent::__construct();
        $this->_name = trim($name);
        $this->_action = trim($action);
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
        $this->_action = trim($action);
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
        $this->xml->addAttribute('name', $this->_name);
        if(!empty($this->_action))
        {
            $this->xml->addAttribute('action', $this->_action);
        }
        return parent::toXml();
    }
}
