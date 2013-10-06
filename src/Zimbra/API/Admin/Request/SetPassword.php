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

/**
 * SetPassword class
 * Set Password.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class SetPassword extends Request
{
    /**
     * Zimbra ID
     * @var string
     */
    private $_id;

    /**
     * New account name
     * @var string
     */
    private $_newPassword;

    /**
     * Constructor method for SetPassword
     * @param string $id
     * @param string $newPassword
     * @return self
     */
    public function __construct($id, $newPassword)
    {
        parent::__construct();
        $this->_id = trim($id);
        $this->_newPassword = trim($newPassword);
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
            return $this->_id;
        }
        $this->_id = trim($id);
        return $this;
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
            return $this->_newPassword;
        }
        $this->_newPassword = trim($newPassword);
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
            'id' => $this->_id,
            'newPassword' => $this->_newPassword,
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
        $this->xml->addAttribute('id', $this->_id)
                  ->addAttribute('newPassword', $this->_newPassword);
        return parent::toXml();
    }
}
