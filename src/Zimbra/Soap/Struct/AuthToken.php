<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Utils\SimpleXML;

/**
 * AuthToken class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class AuthToken
{
    /**
     * Value for authorization token
     * An authToken can be passed instead of account/password/preauth to validate an existing auth token.
     * @var string
     */
    private $_value;

    /**
     * If verifyAccount="1", <account> is required and the account in the auth token is compared to the named account.
     * If verifyAccount="0" (default), only the auth token is verified and any <account> element specified is ignored.
     * @var bool
     */
    private $_verifyAccount;

    /**
     * Constructor method for AuthToken
     * @param  string $value
     * @param  bool   $verifyAccount
     * @return self
     */
    public function __construct($value, $verifyAccount = null)
    {
        $this->_value = trim($value);
        if(null !== $verifyAccount)
        {
            $this->_verifyAccount = (bool) $verifyAccount;
        }
    }

    /**
     * Gets or sets verifyAccount
     *
     * @param  bool $verifyAccount
     * @return bool|self
     */
    public function verifyAccount($verifyAccount = null)
    {
        if(null === $verifyAccount)
        {
            return (bool) $this->_verifyAccount;
        }
        $this->_verifyAccount = (bool) $verifyAccount;
        return $this;
    }

    /**
     * Gets or sets name
     *
     * @param  string $name
     * @return string|self
     */
    public function value($value = null)
    {
        if(null === $value)
        {
            return $this->_value;
        }
        $this->_value = trim($value);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $arr =  array(
            '_' => $this->_value,
        );
        if(is_bool($this->_verifyAccount))
        {
            $arr['verifyAccount'] = $this->_verifyAccount ? 1 : 0;
        }
        return array('authToken' => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $xml = new SimpleXML('<authToken>'. $this->_value.'</authToken>');
        if(is_bool($this->_verifyAccount))
        {
            $xml->addAttribute('verifyAccount', $this->_verifyAccount ? 1 : 0);
        }
        return $xml;
    }

    /**
     * Method returning the xml string representation of this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
