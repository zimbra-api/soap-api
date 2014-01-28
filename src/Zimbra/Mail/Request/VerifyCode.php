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

use Zimbra\Soap\Request;

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
class VerifyCode extends Request
{
    /**
     * Constructor method for VerifyCode
     * @param  string $a
     * @param  string $code
     * @return self
     */
    public function __construct($a = null, $code = null)
    {
        parent::__construct();
        if(null !== $a)
        {
            $this->property('a', trim($a));
        }
        if(null !== $code)
        {
            $this->property('code', trim($code));
        }
    }

    /**
     * Get or set a
     *
     * @param  string $a
     * @return string|self
     */
    public function a($a = null)
    {
        if(null === $a)
        {
            return $this->property('a');
        }
        return $this->property('a', trim($a));
    }

    /**
     * Get or set code
     *
     * @param  string $code
     * @return string|self
     */
    public function code($code = null)
    {
        if(null === $code)
        {
            return $this->property('code');
        }
        return $this->property('code', trim($code));
    }
}
