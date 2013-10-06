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
 * IdAndAction class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class IdAndAction
{
    /**
     * Zimbra ID of account
     * @var string
     */
    private $_id;

    /**
     * bug72174 or wiki or contactGroup
     * @var string
     */
    private $_action;

    /**
     * Constructor method for IdAndAction
     * @param string $id
     * @param string $action
     * @return self
     */
    public function __construct($id, $action)
    {
        $this->_id = trim($id);
        if(in_array($action, array('bug72174', 'wiki', 'contactGroup')))
        {
            $this->_action = trim($action);
        }
        else
        {
            throw new \InvalidArgumentException('Invalid action');
        }
    }

    /**
     * Get or set id
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->_id;
        }
        $this->_id = trim($id);
        return $this;
    }

    /**
     * Get or set action
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
        if(in_array($action, array('bug72174', 'wiki', 'contactGroup')))
        {
            $this->_action = trim($action);
        }
        else
        {
            throw new \InvalidArgumentException('Invalid action');
        }
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'ia')
    {
        $name = !empty($name) ? $name : 'ia';
        $arr =  array(
            'id' => $this->_id,
            'action' => $this->_action,
        );
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'ia')
    {
        $name = !empty($name) ? $name : 'ia';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('id', $this->_id)
            ->addAttribute('action', $this->_action);
        return $xml;
    }

    /**
     * Method returning the xml string representation of this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
