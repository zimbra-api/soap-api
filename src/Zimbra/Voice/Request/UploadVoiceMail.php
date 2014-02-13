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
     * @param  StorePrincipalSpec $storeprincipal
     * @param  VoiceMsgUploadSpec $vm
     * @return self
     */
    public function __construct(
        StorePrincipalSpec $storeprincipal = null,
        VoiceMsgUploadSpec $vm = null
    )
    {
        parent::__construct();
        if($storeprincipal instanceof StorePrincipalSpec)
        {
            $this->child('storeprincipal', $storeprincipal);
        }
        if($vm instanceof VoiceMsgUploadSpec)
        {
            $this->child('vm', $vm);
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
     * Gets or sets vm
     * Phone specification
     *
     * @param  VoiceMsgUploadSpec $vm
     * @return VoiceMsgUploadSpec|self
     */
    public function vm(VoiceMsgUploadSpec $vm = null)
    {
        if(null === $vm)
        {
            return $this->child('vm');
        }
        return $this->child('vm', $vm);
    }
}
