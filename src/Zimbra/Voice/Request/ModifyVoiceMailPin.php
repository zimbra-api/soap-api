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

use Zimbra\Voice\Struct\ModifyVoiceMailPinSpec;
use Zimbra\Voice\Struct\StorePrincipalSpec;

/**
 * ModifyVoiceMailPin request class
 *  Modify the voice mail PIN. 
 *
 * @package    Zimbra
 * @subpackage Voice
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifyVoiceMailPin extends Base
{
    /**
     * Constructor method for ModifyVoiceMailPin
     * @param  StorePrincipalSpec $storeprincipal
     * @param  ModifyVoiceMailPinSpec $phone
     * @return self
     */
    public function __construct(
        StorePrincipalSpec $storeprincipal = null,
        ModifyVoiceMailPinSpec $phone = null
    )
    {
        parent::__construct();
        if($storeprincipal instanceof StorePrincipalSpec)
        {
            $this->setChild('storeprincipal', $storeprincipal);
        }
        if($phone instanceof ModifyVoiceMailPinSpec)
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
     * @return ModifyVoiceMailPinSpec
     */
    public function getPhone()
    {
        return $this->getChild('phone');
    }

    /**
     * Sets the phone.
     *
     * @param  ModifyVoiceMailPinSpec $phone
     * @return self
     */
    public function setPhone(ModifyVoiceMailPinSpec $phone)
    {
        return $this->setChild('phone', $phone);
    }
}
