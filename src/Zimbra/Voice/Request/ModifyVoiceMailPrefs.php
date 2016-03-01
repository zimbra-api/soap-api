<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Voice\Request;

use Zimbra\Voice\Struct\PhoneInfo;
use Zimbra\Voice\Struct\StorePrincipalSpec;

/**
 * ModifyVoiceMailPrefs request class
 *  Modify the voice mail PIN. 
 *
 * @package    Zimbra
 * @subpackage Voice
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifyVoiceMailPrefs extends Base
{
    /**
     * Constructor method for ModifyVoiceMailPrefs
     * @param  StorePrincipalSpec $storeprincipal
     * @param  PhoneInfo $phone
     * @return self
     */
    public function __construct(
        StorePrincipalSpec $storeprincipal = null,
        PhoneInfo $phone = null
    )
    {
        parent::__construct();
        if($storeprincipal instanceof StorePrincipalSpec)
        {
            $this->setChild('storeprincipal', $storeprincipal);
        }
        if($phone instanceof PhoneInfo)
        {
            $this->setChild('phone', $phone);
        }
    }

    /**
     * Gets the storeprincipal.
     *
     * @return StorePrincipalSpec
     */
    public function getStorePrincipal()
    {
        return $this->getChild('storeprincipal');
    }

    /**
     * Sets the storeprincipal.
     *
     * @param  StorePrincipalSpec $storeprincipal
     * @return self
     */
    public function setStorePrincipal(StorePrincipalSpec $storeprincipal)
    {
        return $this->setChild('storeprincipal', $storeprincipal);
    }

    /**
     * Gets the phone.
     *
     * @return PhoneInfo
     */
    public function getPhone()
    {
        return $this->getChild('phone');
    }

    /**
     * Sets the phone.
     *
     * @param  PhoneInfo $phone
     * @return self
     */
    public function setPhone(PhoneInfo $phone)
    {
        return $this->setChild('phone', $phone);
    }
}
