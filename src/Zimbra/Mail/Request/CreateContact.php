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

use Zimbra\Mail\Struct\ContactSpec;

/**
 * CreateContact request class
 * Create a contact
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CreateContact extends Base
{
    /**
     * Constructor method for CreateContact
     * @param  ContactSpec $cn
     * @param  bool $verbose
     * @return self
     */
    public function __construct(ContactSpec $cn, $verbose = null)
    {
        parent::__construct();
        $this->setChild('cn', $cn);
        if(null !== $verbose)
        {
            $this->setProperty('verbose', (bool) $verbose);
        }
    }

    /**
     * Gets contact specification
     *
     * @return ContactSpec
     */
    public function getContact()
    {
        return $this->getChild('cn');
    }

    /**
     * Sets contact specification
     *
     * @param  ContactSpec $cn
     * @return self
     */
    public function setContact(ContactSpec $cn)
    {
        return $this->setChild('cn', $cn);
    }

    /**
     * Gets verbose
     *
     * @return bool
     */
    public function getVerbose()
    {
        return $this->getProperty('verbose');
    }

    /**
     * Sets verbose
     *
     * @param  bool $verbose
     * @return self
     */
    public function setVerbose($verbose)
    {
        return $this->setProperty('verbose', (bool) $verbose);
    }
}
