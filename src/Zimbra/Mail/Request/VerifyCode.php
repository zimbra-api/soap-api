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

/**
 * VerifyCode request class
 * Validate the verification code sent to a device.
 * After successful validation the server sets the device email address as the value of zimbraCalendarReminderDeviceEmail account attribute.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class VerifyCode extends Base
{
    /**
     * Constructor method for VerifyCode
     * @param  string $address
     * @param  string $code
     * @return self
     */
    public function __construct($address = null, $code = null)
    {
        parent::__construct();
        if(null !== $address)
        {
            $this->setProperty('a', trim($address));
        }
        if(null !== $code)
        {
            $this->setProperty('code', trim($code));
        }
    }

    /**
     * Gets address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->getProperty('a');
    }

    /**
     * Sets address
     *
     * @param  string $address
     * @return self
     */
    public function setAddress($address)
    {
        return $this->setProperty('a', trim($address));
    }

    /**
     * Gets verification code
     *
     * @return string
     */
    public function getVerificationCode()
    {
        return $this->getProperty('code');
    }

    /**
     * Sets verification code
     *
     * @param  string $verificationCode
     * @return self
     */
    public function setVerificationCode($verificationCode)
    {
        return $this->setProperty('code', trim($verificationCode));
    }
}
