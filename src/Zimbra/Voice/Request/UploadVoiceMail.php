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

use Zimbra\Voice\Struct\StorePrincipalSpec;
use Zimbra\Voice\Struct\VoiceMsgUploadSpec;

/**
 * UploadVoiceMail request class
 * Reset call features of a vm.
 * If no <{call-feature}> are provided, all subscribed call features for the vm are reset to the default values.
 * If <{call-feature}> elements are provided, only those call features are reset. 
 *
 * @package    Zimbra
 * @subpackage Voice
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class UploadVoiceMail extends Base
{
    /**
     * Constructor method for UploadVoiceMail
     * @param  StorePrincipalSpec $storeprincipal Store principal specification
     * @param  VoiceMsgUploadSpec $vm Specification of voice message to upload
     * @return self
     */
    public function __construct(
        StorePrincipalSpec $storeprincipal = null,
        VoiceMsgUploadSpec $voiceMsg = null
    )
    {
        parent::__construct();
        if($storeprincipal instanceof StorePrincipalSpec)
        {
            $this->setChild('storeprincipal', $storeprincipal);
        }
        if($voiceMsg instanceof VoiceMsgUploadSpec)
        {
            $this->setChild('vm', $voiceMsg);
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
     * Gets the voice message.
     *
     * @return VoiceMsgUploadSpec
     */
    public function getVoiceMsg()
    {
        return $this->getChild('vm');
    }

    /**
     * Sets the voice message.
     *
     * @param  VoiceMsgUploadSpec $voiceMsg
     * @return self
     */
    public function setVoiceMsg(VoiceMsgUploadSpec $voiceMsg)
    {
        return $this->setChild('vm', $voiceMsg);
    }
}
