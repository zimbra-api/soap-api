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
class VoiceMsgAction extends Request
{
    /**
     * Constructor method for VoiceMsgAction
     * @param  VoiceMsgActionSpec $action
     * @param  StorePrincipalSpec $storeprincipal
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
            $this->child('storeprincipal', $storeprincipal);
        }
        $this->child('action', $action);
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
     * Gets or sets action
     * Phone specification
     *
     * @param  VoiceMsgActionSpec $action
     * @return VoiceMsgActionSpec|self
     */
    public function action(VoiceMsgActionSpec $action = null)
    {
        if(null === $action)
        {
            return $this->child('action');
        }
        return $this->child('action', $action);
    }
}
