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

use Zimbra\Voice\Struct\PhoneVoiceFeaturesSpec;
use Zimbra\Voice\Struct\StorePrincipalSpec;

/**
 * GetVoiceFeatures request class
 * Get Call features of a phone
 * Only features requested in <{call-feature}/> are returned in the response. 
 * At least one feature has to be specified.
 * This is because the velodrome gateway returns only partial data if features are not specifically requested.
 * Therefore for now we do not support the "want all" (i.e. no <{call-feature}>) request. 
 *
 * @package    Zimbra
 * @subpackage Voice
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetVoiceFeatures extends Base
{
    /**
     * Constructor method for GetVoiceFeatures
     * @param  StorePrincipalSpec $storeprincipal
     * @param  PhoneVoiceFeaturesSpec $phone
     * @return self
     */
    public function __construct(
        StorePrincipalSpec $storeprincipal = null,
        PhoneVoiceFeaturesSpec $phone = null
    )
    {
        parent::__construct();
        if($storeprincipal instanceof StorePrincipalSpec)
        {
            $this->child('storeprincipal', $storeprincipal);
        }
        if($phone instanceof PhoneVoiceFeaturesSpec)
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
     *
     * @param  PhoneVoiceFeaturesSpec $phone
     * @return PhoneVoiceFeaturesSpec|self
     */
    public function phone(PhoneVoiceFeaturesSpec $phone = null)
    {
        if(null === $phone)
        {
            return $this->child('phone');
        }
        return $this->child('phone', $phone);
    }
}
