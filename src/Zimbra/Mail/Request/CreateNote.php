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

use Zimbra\Mail\Struct\NewNoteSpec;

/**
 * CreateNote request class
 * Create a note
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CreateNote extends Base
{
    /**
     * Constructor method for CreateNote
     * @param  NewNoteSpec $note
     * @return self
     */
    public function __construct(NewNoteSpec $note)
    {
        parent::__construct();
        $this->setChild('note', $note);
    }

    /**
     * Gets note specification
     *
     * @return NewNoteSpec
     */
    public function getNote()
    {
        return $this->getChild('note');
    }

    /**
     * Sets note specification
     *
     * @param  NewNoteSpec $note
     * @return self
     */
    public function setNote(NewNoteSpec $note)
    {
        return $this->setChild('note', $note);
    }
}
