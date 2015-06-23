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

use Zimbra\Voice\Struct\ResetPhoneVoiceFeaturesSpec;
use Zimbra\Voice\Struct\StorePrincipalSpec;

/**
 * ResetVoiceFeatures request class
 * Reset call features of a phone.
 * If no <{call-feature}> are provided, all subscribed call features for the phone are reset to the default values.
 * If <{call-feature}> elements are provided, only those call features are reset. 
 *
 * @package    Zimbra
 * @subpackage Voice
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ResetVoiceFeatures extends Base
{
    /**
     * Constructor method for ResetVoiceFeatures
     * @param  StorePrincipalSpec $storeprincipal
     * @param  ResetPhoneVoiceFeaturesSpec $phone
     * @return self
     */
    public function __construct(
        StorePrincipalSpec $storeprincipal = null,
        ResetPhoneVoiceFeaturesSpec $phone = null
    )
    {
        parent::__construct();
        if($storeprincipal instanceof StorePrincipalSpec)
        {
            $this->setChild('storeprincipal', $storeprincipal);
        }
        if($phone instanceof ResetPhoneVoiceFeaturesSpec)
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
     * @return ResetPhoneVoiceFeaturesSpec
     */
    public function getPhone()
    {
        return $this->getChild('phone');
    }

    /**
     * Sets the phone.
     *
     * @param  ResetPhoneVoiceFeaturesSpec $phone
     * @return self
     */
    public function setPhone(ResetPhoneVoiceFeaturesSpec $phone)
    {
        return $this->setChild('phone', $phone);
    }
}
