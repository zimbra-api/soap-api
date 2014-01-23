<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Request;

use Zimbra\Soap\Request;

/**
 * SetPassword request class
 * Set Password.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class SetPassword extends Request
{
    /**
     * Constructor method for SetPassword
     * @param string $id Zimbra ID
     * @param string $newPassword New Password
     * @return self
     */
    public function __construct($id, $newPassword)
    {
        parent::__construct();
        $this->property('id', trim($id));
        $this->property('newPassword', trim($newPassword));
    }

    /**
     * Gets or sets id
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->property('id');
        }
        return $this->property('id', trim($id));
    }

    /**
     * Gets or sets newPassword
     *
     * @param  string $newPassword
     * @return string|self
     */
    public function newPassword($newPassword = null)
    {
        if(null === $newPassword)
        {
            return $this->property('newPassword');
        }
        return $this->property('newPassword', trim($newPassword));
    }
}
