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

/**
 * GetYahooCookie request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetYahooCookie extends Request
{
    /**
     * User
     * @var string
     */
    private $_user;

    /**
     * Constructor method for GetYahooCookie
     * @param  string $user
     * @return self
     */
    public function __construct($user)
    {
        parent::__construct();
        $this->_user = trim($user);
    }

    /**
     * Gets or sets user
     *
     * @param  string $user
     * @return string|self
     */
    public function user($user = null)
    {
        if(null === $user)
        {
            return $this->_user;
        }
        $this->_user = trim($user);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array['user'] = $this->_user;
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->addAttribute('user', $this->_user);
        return parent::toXml();
    }
}
