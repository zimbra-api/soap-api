<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Request;

use Zimbra\Mail\Struct\ContactActionSelector;

/**
 * ContactAction request class
 * Contact Action
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ContactAction extends Base
{
    /**
     * Constructor method for ContactAction
     * @param  ContactActionSelector $action
     * @return self
     */
    public function __construct(ContactActionSelector $action)
    {
        parent::__construct();
        $this->setChild('action', $action);
    }

    /**
     * Gets contact action selector
     *
     * @return ContactActionSelector
     */
    public function getAction()
    {
        return $this->getChild('action');
    }

    /**
     * Sets contact action selector
     *
     * @param  ContactActionSelector $action
     * @return self
     */
    public function setAction(ContactActionSelector $action)
    {
        return $this->setChild('action', $action);
    }
}
