<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use Zimbra\Struct\Base;

/**
 * IdAndAction struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class IdAndAction extends Base
{
    /**
     * Constructor method for IdAndAction
     * @param string $id Zimbra ID of account
     * @param string $action bug72174 or wiki or contactGroup
     * @return self
     */
    public function __construct($id, $action)
    {
        parent::__construct();
        $this->property('id', trim($id));
        if(in_array($action, array('bug72174', 'wiki', 'contactGroup')))
        {
            $this->property('action', trim($action));
        }
        else
        {
            throw new \InvalidArgumentException('Action is bug72174 or wiki or contactGroup');
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
            return $this->property('id');
        }
        return $this->property('id', trim($id));
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
            return $this->property('action');
        }
        if(in_array($action, array('bug72174', 'wiki', 'contactGroup')))
        {
            $this->property('action', trim($action));
        }
        else
        {
            throw new \InvalidArgumentException('Action is bug72174 or wiki or contactGroup');
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
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'ia')
    {
        return parent::toXml($name);
    }
}
