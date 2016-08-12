<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Request;

use Zimbra\Account\Struct\AuthToken;

/**
 * EnableTwoFactorAuth request class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class EnableTwoFactorAuth extends Base
{
    /**
     * Constructor method for EnableTwoFactorAuth
     * @param  string    $name  The name of the account for which to enable two-factor auth
     * @param  string    $password  Password to use in conjunction with an account
     * @param  AuthToken $authToken  Auth token issued during the first 2FA enablement step.
     * @param  bool      $csrfSupported  Whether the client supports the CSRF token.
     * @return self
     */
    public function __construct(
        $name,
        $password = null,
        AuthToken $authToken = null,
        $twoFactorCode = null,
        $csrfSupported = null
    )
    {
        parent::__construct();
        $this->setChild('name', trim($name));
        if(null !== $password)
        {
            $this->setChild('password', trim($password));
        }
        if($authToken instanceof AuthToken)
        {
            $this->setChild('authToken', $authToken);
        }
        if(null !== $twoFactorCode)
        {
            $this->setChild('twoFactorCode', trim($twoFactorCode));
        }
        if(null !== $csrfSupported)
        {
            $this->setProperty('csrfTokenSecured', (bool) $csrfSupported);
        }
    }

    /**
     * Gets the name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getChild('name');
    }

    /**
     * Sets the name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setChild('name', trim($name));
    }

    /**
     * Gets password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->getChild('password');
    }

    /**
     * Sets password
     *
     * @param  string $password
     * @return self
     */
    public function setPassword($password)
    {
        return $this->setChild('password', trim($password));
    }

    /**
     * Gets the auth token
     *
     * @return AuthToken
     */
    public function getAuthToken()
    {
        return $this->getChild('authToken');
    }

    /**
     * Sets the auth token
     *
     * @param  AuthToken $authToken
     * @return self
     */
    public function setAuthToken(AuthToken $authToken)
    {
        return $this->setChild('authToken', $authToken);
    }

    /**
     * Gets twoFactorCode
     *
     * @return string
     */
    public function getTwoFactorCode()
    {
        return $this->getChild('twoFactorCode');
    }

    /**
     * Sets twoFactorCode
     *
     * @param  string $twoFactorCode
     * @return self
     */
    public function setTwoFactorCode($twoFactorCode)
    {
        return $this->setChild('twoFactorCode', trim($twoFactorCode));
    }

    /**
     * Gets controls whether the client supports CSRF token
     *
     * @return bool
     */
    public function getCsrfSupported()
    {
        return $this->getProperty('csrfTokenSecured');
    }

    /**
     * Sets controls whether the client supports CSRF token
     *
     * @param  bool $csrfSupported
     * @return self
     */
    public function setCsrfSupported($csrfSupported)
    {
        return $this->setProperty('csrfTokenSecured', (bool) $csrfSupported);
    }
}
