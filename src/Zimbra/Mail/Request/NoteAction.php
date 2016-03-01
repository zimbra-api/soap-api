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

use Zimbra\Mail\Struct\NoteActionSelector;

/**
 * NoteAction request class
 * Perform an action on an note
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class NoteAction extends Base
{
    /**
     * Constructor method for NoteAction
     * @param  NoteActionSelector $action
     * @return self
     */
    public function __construct(NoteActionSelector $action)
    {
        parent::__construct();
        $this->setChild('action', $action);
    }

    /**
     * Gets specify the action to perform
     *
     * @return NoteActionSelector
     */
    public function getAction()
    {
        return $this->getChild('action');
    }

    /**
     * Sets specify the action to perform
     *
     * @param  NoteActionSelector $action
     * @return self
     */
    public function setAction(NoteActionSelector $action)
    {
        return $this->setChild('action', $action);
    }
}
