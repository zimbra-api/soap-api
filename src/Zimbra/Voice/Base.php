<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Voice;

use Zimbra\Account\Base as AccountBase;
use Zimbra\Enum\VoiceSortBy;

use Zimbra\Voice\Struct\ModifyFromNumSpec;
use Zimbra\Voice\Struct\ModifyVoiceFeaturesSpec;
use Zimbra\Voice\Struct\ModifyVoiceMailPinSpec;
use Zimbra\Voice\Struct\PhoneInfo;
use Zimbra\Voice\Struct\PhoneSpec;
use Zimbra\Voice\Struct\PhoneVoiceFeaturesSpec;
use Zimbra\Voice\Struct\ResetPhoneVoiceFeaturesSpec;
use Zimbra\Voice\Struct\StorePrincipalSpec;
use Zimbra\Voice\Struct\VoiceMsgActionSpec;
use Zimbra\Voice\Struct\VoiceMsgUploadSpec;

/**
 * Base is a abstract class which allows to connect Zimbra API mail public functions via SOAP
 *
 * @package   Zimbra
 * @category  Voice
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
abstract class Base extends AccountBase implements VoiceInterface
{
    /**
     * Base constructor
     *
     * @param string $location The Zimbra api soap location.
     */
    public function __construct($location)
    {
        parent::__construct($location);
    }

    /**
     * Update Zimbra's stored value of the password for unified communications.
     *
     * @param  string $password Updated Password.
     * @return mix
     */
    public function changeUCPassword($password)
    {
        $request = new \Zimbra\Voice\Request\ChangeUCPassword(
            $password
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get Unified Communications information.
     *
     * @return mix
     */
    public function getUCInfo()
    {
        $request = new \Zimbra\Voice\Request\GetUCInfo();
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get Call features of a phone.
     * Only features requested in <{call-feature}/> are returned in the response.
     * At least one feature has to be specified.
     * This is because the velodrome gateway returns only partial data if features are not specifically requested.
     * Therefore for now we do not support the "want all" (i.e. no <{call-feature}>) request.
     *
     * @param  StorePrincipalSpec $storeprincipal Store Principal specification
     * @param  PhoneVoiceFeaturesSpec $phone
     * @return mix
     */
    public function getVoiceFeatures(
        StorePrincipalSpec $storeprincipal = null,
        PhoneVoiceFeaturesSpec $phone = null
    )
    {
        $request = new \Zimbra\Voice\Request\GetVoiceFeatures(
            $storeprincipal, $phone
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get Voice Folders.
     *
     * @param  StorePrincipalSpec $storeprincipal Store Principal specification
     * @param  array $phone Phone specification
     * @return mix
     */
    public function getVoiceFolder(
        StorePrincipalSpec $storeprincipal = null,
        array $phone = []
    )
    {
        $request = new \Zimbra\Voice\Request\GetVoiceFolder(
            $storeprincipal, $phone
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get voice information.
     *
     * @param  array $phones
     * @return mix
     */
    public function getVoiceInfo(array $phones = [])
    {
        $request = new \Zimbra\Voice\Request\GetVoiceInfo(
            $phones
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get voice mail preferences.
     * If no <pref> elements are provided, all known prefs for the requested phone are returned in the response.
     * If <pref> elements are provided, only those prefs are returned in the response.
     *
     * @param  StorePrincipalSpec $storeprincipal Store Principal specification
     * @param  PhoneSpec $phone Phone specification
     * @return mix
     */
    public function getVoiceMailPrefs(
        StorePrincipalSpec $storeprincipal = null,
        PhoneSpec $phone = null
    )
    {
        $request = new \Zimbra\Voice\Request\GetVoiceMailPrefs(
            $storeprincipal, $phone
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Modify the phone num and label.
     * NOTE: UI should insert empty values for oldPhone, phone label in-case the user wants to leave them empty.
     *
     * @param  StorePrincipalSpec $storeprincipal Store Principal specification
     * @param  ModifyFromNumSpec $phone Changes for phone
     * @return mix
     */
    public function modifyFromNum(
        StorePrincipalSpec $storeprincipal = null,
        ModifyFromNumSpec $phone = null
    )
    {
        $request = new \Zimbra\Voice\Request\ModifyFromNum(
            $storeprincipal, $phone
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Modify call features of a phone.
     * Refer to GetVoiceFeaturesResponse for attributes and child elements of each call feature.
     *
     * @param  StorePrincipalSpec $storeprincipal Store Principal specification
     * @param  ModifyVoiceFeaturesSpec $phone Specification of voice features to be modified
     * @return mix
     */
    public function modifyVoiceFeatures(
        StorePrincipalSpec $storeprincipal = null,
        ModifyVoiceFeaturesSpec $phone = null
    )
    {
        $request = new \Zimbra\Voice\Request\ModifyVoiceFeatures(
            $storeprincipal, $phone
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Modify the voice mail PIN.
     *
     * @param  StorePrincipalSpec $storeprincipal Store Principal specification
     * @param  ModifyVoiceMailPinSpec $phone Specification for new PIN
     * @return mix
     */
    public function modifyVoiceMailPin(
        StorePrincipalSpec $storeprincipal = null,
        ModifyVoiceMailPinSpec $phone = null
    )
    {
        $request = new \Zimbra\Voice\Request\ModifyVoiceMailPin(
            $storeprincipal, $phone
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Modify voice mail preferences.
     *
     * @param  StorePrincipalSpec $storeprincipal Store Principal specification
     * @param  PhoneInfo $phone New Preferences information
     * @return mix
     */
    public function modifyVoiceMailPrefs(
        StorePrincipalSpec $storeprincipal = null,
        PhoneInfo $phone = null
    )
    {
        $request = new \Zimbra\Voice\Request\ModifyVoiceMailPrefs(
            $storeprincipal, $phone
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Reset call features of a phone.
     * If no <{call-feature}> are provided, all subscribed call features for the phone are reset to the default values.
     * If <{call-feature}> elements are provided, only those call features are reset. 
     *
     * @param  StorePrincipalSpec $storeprincipal Store Principal specification
     * @param  ResetPhoneVoiceFeaturesSpec $phone Features to reset for a phone
     * @return mix
     */
    public function resetVoiceFeatures(
        StorePrincipalSpec $storeprincipal = null,
        ResetPhoneVoiceFeaturesSpec $phone = null
    )
    {
        $request = new \Zimbra\Voice\Request\ResetVoiceFeatures(
            $storeprincipal, $phone
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Search voice messages and call logs.
     *
     * @param  string $query
     * @param  StorePrincipalSpec $storeprincipal
     * @param  int $limit
     * @param  int $offset
     * @param  string $types
     * @param  VoiceSortBy $sortBy
     * @return mix
     */
    public function searchVoice(
        $query,
        StorePrincipalSpec $storeprincipal = null,
        $limit = null,
        $offset = null,
        $types = null,
        VoiceSortBy $sortBy = null
    )
    {
        $request = new \Zimbra\Voice\Request\SearchVoice(
            $query, $storeprincipal, $limit, $offset, $types, $sortBy
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Retrieve the voice mail body from the gateway and upload(save) it as an attachment on the server.
     *
     * @param  StorePrincipalSpec $storeprincipal Store Principal specification
     * @param  VoiceMsgUploadSpec $vm Specification of voice message to upload
     * @return mix
     */
    public function uploadVoiceMail(
        StorePrincipalSpec $storeprincipal = null,
        VoiceMsgUploadSpec $vm = null
    )
    {
        $request = new \Zimbra\Voice\Request\UploadVoiceMail(
            $storeprincipal, $vm
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Perform an action on a voice message
     *   - Modify state of voice messages 
     *   - soft delete/undelete voice messages 
     *   - empty (hard-delete) voice message trash folders 
     *
     * @param  VoiceMsgActionSpec $action Action specification
     * @param  StorePrincipalSpec $storeprincipal Store Principal specification
     * @return mix
     */
    public function voiceMsgAction(
        VoiceMsgActionSpec $action,
        StorePrincipalSpec $storeprincipal = null
    )
    {
        $request = new \Zimbra\Voice\Request\VoiceMsgAction(
            $action, $storeprincipal
        );
        return $this->getClient()->doRequest($request);
    }
}