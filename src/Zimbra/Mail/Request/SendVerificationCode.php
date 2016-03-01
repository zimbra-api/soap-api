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
 * SendVerificationCode request class
 * SendVerificationCodeRequest results in a random verification code being generated and sent to a device.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class SendVerificationCode extends Base
{
    /**
     * Constructor method for SendVerificationCode
     * @param  string $address
     * @return self
     */
    public function __construct($address = null)
    {
        parent::__construct();
        if(null !== $address)
        {
            $this->setProperty('a', trim($address));
        }
    }

    /**
     * Gets device email address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->getProperty('a');
    }

    /**
     * Sets device email address
     *
     * @param  string $address
     * @return self
     */
    public function setAddress($address)
    {
        return $this->setProperty('a', trim($address));
    }
}
