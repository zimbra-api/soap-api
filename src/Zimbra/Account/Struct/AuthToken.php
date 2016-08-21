<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use Zimbra\Struct\Base;

/**
 * AuthToken struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class AuthToken extends Base
{
    /**
     * Constructor method for AuthToken
     * @param  string $value
     *   Value for authorization token
     * @param  bool   $verifyAccount
     *   If verifyAccount="1", account is required and the account in the auth token is compared to the named account.
     *   If verifyAccount="0" (default), only the auth token is verified and any account element specified is ignored.
     * @param  int    $lifetime Life time of the auth token
     * @return self
     */
    public function __construct($value, $verifyAccount = null, $lifetime = null)
    {
        parent::__construct(trim($value));
        if(null !== $verifyAccount)
        {
            $this->setProperty('verifyAccount', (bool) $verifyAccount);
        }
        if(null !== $lifetime)
        {
            $this->setProperty('lifetime', (int) $lifetime);
        }
    }

    /**
     * Gets auth token is verified flag
     *
     * @return bool
     */
    public function getVerifyAccount()
    {
        return $this->getProperty('verifyAccount');
    }

    /**
     * Sets auth token is verified flag
     *
     * @param  bool $verifyAccount
     * @return self
     */
    public function setVerifyAccount($verifyAccount)
    {
        return $this->setProperty('verifyAccount', (bool) $verifyAccount);
    }

    /**
     * Gets life time of the auth token
     *
     * @return int
     */
    public function getLifetime()
    {
        return $this->getProperty('lifetime');
    }

    /**
     * Sets life time of the auth token
     *
     * @param  int $lifetime
     * @return self
     */
    public function setLifetime($lifetime)
    {
        return $this->setProperty('lifetime', (int) $lifetime);
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'authToken')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'authToken')
    {
        return parent::toXml($name);
    }
}
