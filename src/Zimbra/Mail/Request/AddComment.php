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

use Zimbra\Mail\Struct\AddedComment;

/**
 * AddComment request class
 * Add a comment to the specified item.
 * Currently comments can only be added to documents
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class AddComment extends Base
{
    /**
     * Constructor method for AddComment
     * @param  AddedComment $comment
     * @return self
     */
    public function __construct(AddedComment $comment)
    {
        parent::__construct();
        $this->setChild('comment', $comment);
    }

    /**
     * Gets comment
     *
     * @return AddedComment
     */
    public function getComment()
    {
        return $this->getChild('comment');
    }

    /**
     * Sets comment
     *
     * @param  AddedComment $comment
     * @return self
     */
    public function setComment(AddedComment $comment)
    {
        return $this->setChild('comment', $comment);
    }
}
