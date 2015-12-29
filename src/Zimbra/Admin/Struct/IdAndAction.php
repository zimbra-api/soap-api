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
        $this->setProperty('id', trim($id));
        $this->setAction($action);
    }

    /**
     * Gets Zimbra ID of account
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets Zimbra ID of account
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
    }

    /**
     * Gets action
     *
     * @return string
     */
    public function getAction()
    {
        return $this->getProperty('action');
    }

    /**
     * Sets action
     *
     * @param  string $action
     * @return self
     */
    public function setAction($action)
    {
        if(in_array($action, ['bug72174', 'wiki', 'contactGroup']))
        {
            $this->setProperty('action', trim($action));
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
