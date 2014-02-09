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

use Zimbra\Struct\Id;

/**
 * GetNote request class
 * Get Note
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetNote extends Base
{
    /**
     * Constructor method for GetNote
     * @param  Id $note
     * @return self
     */
    public function __construct(Id $note)
    {
        parent::__construct();
        $this->child('note', $note);
    }

    /**
     * Get or set note
     *
     * @param  Id $note
     * @return Id|self
     */
    public function note(Id $note = null)
    {
        if(null === $note)
        {
            return $this->child('note');
        }
        return $this->child('note', $note);
    }
}
