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
use Zimbra\Soap\Request;

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
class ContactAction extends Request
{
    /**
     * Constructor method for ContactAction
     * @param  ContactActionSelector $action
     * @return self
     */
    public function __construct(ContactActionSelector $action)
    {
        parent::__construct();
        $this->child('action', $action);
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
            return $this->child('action');
        }
        return $this->child('action', $action);
    }
}
