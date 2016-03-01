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

use Zimbra\Voice\Struct\VoiceMsgActionSpec;
use Zimbra\Voice\Struct\StorePrincipalSpec;

/**
 * VoiceMsgAction request class
 * Perform an action on a voice message
 *   - Modify state of voice messages 
 *   - soft delete/undelete voice messages 
 *   - empty (hard-delete) voice message trash folders 
 *
 * @package    Zimbra
 * @subpackage Voice
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class VoiceMsgAction extends Base
{
    /**
     * Constructor method for VoiceMsgAction
     * @param  VoiceMsgActionSpec $action Action specification
     * @param  StorePrincipalSpec $storeprincipal Store principal specification
     * @return self
     */
    public function __construct(
        VoiceMsgActionSpec $action,
        StorePrincipalSpec $storeprincipal = null
    )
    {
        parent::__construct();
        if($storeprincipal instanceof StorePrincipalSpec)
        {
            $this->setChild('storeprincipal', $storeprincipal);
        }
        $this->setChild('action', $action);
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
     * Gets the action.
     *
     * @return VoiceMsgActionSpec
     */
    public function getAction()
    {
        return $this->getChild('action');
    }

    /**
     * Sets the action.
     *
     * @param  VoiceMsgActionSpec $action
     * @return self
     */
    public function setAction(VoiceMsgActionSpec $action)
    {
        return $this->setChild('action', $action);
    }
}
