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
     * Contact specification
     * @var ContactSpec
     */
    private $_cn;

    /**
     * If set (defaults to unset) The returned <cn> is just a placeholder containing the new contact ID (i.e. <cn id="{id}"/>)
     * @var bool
     */
    private $_verbose;

    /**
     * Constructor method for CreateContact
     * @param  ContactSpec $cn
     * @param  bool $verbose
     * @return self
     */
    public function __construct(ContactSpec $cn, $verbose = null)
    {
        parent::__construct();
        $this->child('cn', $cn);
        if(null !== $verbose)
        {
            $this->property('verbose', (bool) $verbose);
        }
    }

    /**
     * Get or set cn
     *
     * @param  ContactSpec $cn
     * @return ContactSpec|self
     */
    public function cn(ContactSpec $cn = null)
    {
        if(null === $cn)
        {
            return $this->child('cn');
        }
        return $this->child('cn', $cn);
    }

    /**
     * Get or set verbose
     *
     * @param  bool $verbose
     * @return bool|self
     */
    public function verbose($verbose = null)
    {
        if(null === $verbose)
        {
            return $this->property('verbose');
        }
        return $this->property('verbose', (bool) $verbose);
    }
}
