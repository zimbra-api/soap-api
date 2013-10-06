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

use Zimbra\Soap\Request\Attr;

/**
 * CreateAccount class
 * Create account.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CreateAccount extends Attr
{
    /**
     * New account's name 
     * Must include domain (uid@name), and domain specified in name must exist
     * @var string
     */
    private $_name;

    /**
     * New account's password
     * @var string
     */
    private $_password;

    /**
     * Constructor method for CreateAccount
     * @param string $name
     * @param string $password
     * @param array  $attrs
     * @return self
     */
    public function __construct($name, $password, array $attrs = array())
    {
        parent::__construct($attrs);
        $this->_name = trim($name);
        $this->_password = trim($password);
    }

    /**
     * Gets or sets name
     *
     * @param  string $name
     * @return string|self
     */
    public function name($name = null)
    {
        if(null === $name)
        {
            return $this->_name;
        }
        $this->_name = trim($name);
        return $this;
    }

    /**
     * Gets or sets password
     *
     * @param  string $password
     * @return string|self
     */
    public function password($password = null)
    {
        if(null === $password)
        {
            return $this->_password;
        }
        $this->_password = trim($password);
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
            'name' => $this->_name,
            'password' => $this->_password,
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
        $this->xml->addAttribute('name', $this->_name)
                  ->addAttribute('password', $this->_password);
        return parent::toXml();
    }
}
