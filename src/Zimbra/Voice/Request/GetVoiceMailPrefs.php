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
use Zimbra\Voice\Struct\PhoneSpec;
use Zimbra\Voice\Struct\StorePrincipalSpec;

/**
 * GetVoiceMailPrefs request class
 * Get voice mail preferences.
 * If no <pref> elements are provided, all known prefs for the requested phone are returned in the response.
 * If <pref> elements are provided, only those prefs are returned in the response.
 *
 * @package    Zimbra
 * @subpackage Voice
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetVoiceMailPrefs extends Request
{
    /**
     * Constructor method for GetVoiceMailPrefs
     * @param  StorePrincipalSpec $storeprincipal
     * @param  PhoneSpec $phone
     * @return self
     */
    public function __construct(
        StorePrincipalSpec $storeprincipal = null,
        PhoneSpec $phone = null
    )
    {
        parent::__construct();
        if($storeprincipal instanceof StorePrincipalSpec)
        {
            $this->child('storeprincipal', $storeprincipal);
        }
        if($phone instanceof PhoneSpec)
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
     * @param  PhoneSpec $phone
     * @return PhoneSpec|self
     */
    public function phone(PhoneSpec $phone = null)
    {
        if(null === $phone)
        {
            return $this->child('phone');
        }
        return $this->child('phone', $phone);
    }
}
