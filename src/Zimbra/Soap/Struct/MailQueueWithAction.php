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
 * MailQueueWithAction class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.;
 */
class MailQueueWithAction
{
    /**
     * Queue name
     * @var string
     */
    private $_name;

    /**
     * Action
     * @var MailQueueAction
     */
    private $_action;

    /**
     * Constructor method for MailQueueWithAction
     * @param  string $name
     * @param  MailQueueAction $action
     * @return self
     */
    public function __construct($name, MailQueueAction $action)
    {
        $this->_name = trim($name);
        $this->_action = $action;
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
     * @param  MailQueueAction $action
     * @return MailQueueAction|self
     */
    public function action(MailQueueAction $action = null)
    {
        if(null === $action)
        {
            return $this->_action;
        }
        $this->_action = $action;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'queue')
    {
        $name = !empty($name) ? $name : 'queue';
        $arr = array(
            'name' => $this->_name,
        );
        $arr += $this->_action->toArray('action');
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'queue')
    {
        $name = !empty($name) ? $name : 'queue';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('name', $this->_name)
            ->append($this->_action->toXml('action'));
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
