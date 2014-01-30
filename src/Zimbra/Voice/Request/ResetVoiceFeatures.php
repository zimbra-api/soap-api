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

use Zimbra\Soap\Request;
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
class ResetVoiceFeatures extends Request
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
            $this->child('storeprincipal', $storeprincipal);
        }
        if($phone instanceof ResetPhoneVoiceFeaturesSpec)
        {
            $this->child('phone', $phone);
        }
    }

    /**
     * Gets or sets storeprincipal
     * Store Principal specification
     *
     * @param  StorePrincipalSpec $storeprincipal
     * @return StorePrincipalSpec|self
     */
    public function storeprincipal(StorePrincipalSpec $storeprincipal = null)
    {
        if(null === $storeprincipal)
        {
            return $this->child('storeprincipal');
        }
        return $this->child('storeprincipal', $storeprincipal);
    }

    /**
     * Gets or sets phone
     * Phone specification
     *
     * @param  ResetPhoneVoiceFeaturesSpec $phone
     * @return ResetPhoneVoiceFeaturesSpec|self
     */
    public function phone(ResetPhoneVoiceFeaturesSpec $phone = null)
    {
        if(null === $phone)
        {
            return $this->child('phone');
        }
        return $this->child('phone', $phone);
    }
}
