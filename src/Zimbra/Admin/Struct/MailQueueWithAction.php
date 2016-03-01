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
 * MailQueueWithAction struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class MailQueueWithAction extends Base
{
    /**
     * Constructor method for MailQueueWithAction
     * @param  MailQueueAction $action Action
     * @param  string $name Queue name
     * @return self
     */
    public function __construct(MailQueueAction $action, $name)
    {
        parent::__construct();
        $this->setChild('action', $action);
        $this->setProperty('name', trim($name));
    }

    /**
     * Gets the action.
     *
     * @return MailQueueAction
     */
    public function getAction()
    {
        return $this->getChild('action');
    }

    /**
     * Sets the action.
     *
     * @param  MailQueueAction $action
     * @return self
     */
    public function setAction(MailQueueAction $action)
    {
        return $this->setChild('action', $action);
    }

    /**
     * Gets the query name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets the query name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('name', trim($name));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'queue')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'queue')
    {
        return parent::toXml($name);
    }
}
