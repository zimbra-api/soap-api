<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Voice\Request;

/**
 * ChangeUCPassword request class
 * Update Zimbra's stored value of the password for unified communications 
 *
 * @package    Zimbra
 * @subpackage Voice
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ChangeUCPassword extends Base
{
    /**
     * Constructor method for ChangeUCPassword
     * @param  string $password
     * @return self
     */
    public function __construct($password)
    {
        parent::__construct();
        $this->property('password', trim($password));
    }

    /**
     * Gets or sets password
     * Updated Password
     *
     * @param  string $password
     * @return string|self
     */
    public function password($password = null)
    {
        if(null === $password)
        {
            return $this->property('password');
        }
        return $this->property('password', trim($password));
    }
}
