<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Mail\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\ContactActionSelector;

/**
 * ContactAction request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ContactAction extends Request
{
    /**
     * Contact action selector
     * @var ContactActionSelector
     */
    private $_action;

    /**
     * Constructor method for ContactAction
     * @param  ContactActionSelector $action
     * @return self
     */
    public function __construct(ContactActionSelector $action)
    {
        parent::__construct();
        $this->_action = $action;
    }

    /**
     * Get or set action
     *
     * @param  ContactActionSelector $action
     * @return ContactActionSelector|self
     */
    public function action(ContactActionSelector $action = null)
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
     * @return array
     */
    public function toArray()
    {
        $this->array += $this->_action->toArray('action');
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->append($this->_action->toXml('action'));
        return parent::toXml();
    }
}
