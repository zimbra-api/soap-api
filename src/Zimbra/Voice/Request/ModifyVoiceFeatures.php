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
use Zimbra\Voice\Struct\ModifyVoiceFeaturesSpec;
use Zimbra\Voice\Struct\StorePrincipalSpec;

/**
 * ModifyVoiceFeatures request class
 * Modify call features of a phone. 
 * Refer to GetVoiceFeaturesResponse for attributes and child elements of each call feature 
 *
 * @package    Zimbra
 * @subpackage Voice
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifyVoiceFeatures extends Request
{
    /**
     * Constructor method for ModifyVoiceFeatures
     * @param  StorePrincipalSpec $storeprincipal
     * @param  ModifyVoiceFeaturesSpec $phone
     * @return self
     */
    public function __construct(
        StorePrincipalSpec $storeprincipal = null,
        ModifyVoiceFeaturesSpec $phone = null
    )
    {
        parent::__construct();
        if($storeprincipal instanceof StorePrincipalSpec)
        {
            $this->child('storeprincipal', $storeprincipal);
        }
        if($phone instanceof ModifyVoiceFeaturesSpec)
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
     * @param  ModifyVoiceFeaturesSpec $phone
     * @return ModifyVoiceFeaturesSpec|self
     */
    public function phone(ModifyVoiceFeaturesSpec $phone = null)
    {
        if(null === $phone)
        {
            return $this->child('phone');
        }
        return $this->child('phone', $phone);
    }
}
