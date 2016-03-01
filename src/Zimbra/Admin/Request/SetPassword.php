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
class SetPassword extends Base
{
    /**
     * Constructor method for SetPassword
     * @param string $id Zimbra ID
     * @param string $newPassword New password
     * @return self
     */
    public function __construct($id, $newPassword)
    {
        parent::__construct();
        $this->setProperty('id', trim($id));
        $this->setProperty('newPassword', trim($newPassword));
    }

    /**
     * Gets Zimbra ID
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets Zimbra ID
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
    }

    /**
     * Gets new password
     *
     * @return string
     */
    public function getNewPassword()
    {
        return $this->getProperty('newPassword');
    }

    /**
     * Sets new password
     *
     * @param  string $newPassword
     * @return self
     */
    public function setNewPassword($newPassword)
    {
        return $this->setProperty('newPassword', trim($newPassword));
    }
}
