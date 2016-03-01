<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Request;

use Zimbra\Mail\Struct\MsgActionSelector;

/**
 * MsgAction request class
 * Perform an action on a message 
 * For op="update", caller can specify any or all of: l="{folder}", name="{name}", color="{color}", tn="{tag-names}", f="{flags}". 
 * For op="!spam", can optionally specify a destination folder
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class MsgAction extends Base
{
    /**
     * Constructor method for MsgAction
     * @param  MsgActionSelector $action
     * @return self
     */
    public function __construct(MsgActionSelector $action)
    {
        parent::__construct();
        $this->setChild('action', $action);
    }

    /**
     * Gets specify the action to perform
     *
     * @return MsgActionSelector
     */
    public function getAction()
    {
        return $this->getChild('action');
    }

    /**
     * Sets specify the action to perform
     *
     * @param  MsgActionSelector $action
     * @return self
     */
    public function setAction(MsgActionSelector $action)
    {
        return $this->setChild('action', $action);
    }
}
