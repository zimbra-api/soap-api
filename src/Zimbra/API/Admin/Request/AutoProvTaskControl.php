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
use Zimbra\Soap\Enum\Action;

/**
 * AutoProvTaskControl class
 * Under normal situations, the EAGER auto provisioning task(thread) should be started/stopped automatically by the server when appropriate.
 * The task should be running when zimbraAutoProvPollingInterval is not 0 and zimbraAutoProvScheduledDomains is not empty.
 * The task should be stopped otherwise.
 * This API is to manually force start/stop or query status of the EAGER auto provisioning task.
 * It is only for diagnosis purpose and should not be used under normal situations.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class AutoProvTaskControl extends Request
{
    /**
     * Action to perform - one of start|status|stop
     * @var string
     */
    private $_action;
	
    /**
     * Valid actions
     * @var array
     */
	private static $_validActions = array('start', 'status', 'stop');

    /**
     * Constructor method for AutoProvTaskControl
     * @param string $action
     * @return self
     */
    public function __construct($action)
    {
        parent::__construct();
        if(in_array(trim($action), self::$_validActions))
        {
            $this->_action = trim($action);
        }
        else
        {
            throw new \InvalidArgumentException('Invalid action');
        }
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
        if(in_array(trim($action), self::$_validActions))
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
     * @return array
     */
    public function toArray()
    {
        $this->array = array(
            'action' => $this->_action,
        );
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->addAttribute('action', $this->_action);
        return parent::toXml();
    }
}
