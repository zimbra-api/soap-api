<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Mail\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\AddedComment;
use Zimbra\Utils\SimpleXML;

/**
 * AddComment request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class AddComment extends Request
{
    /**
     * Message
     * @var AddedComment
     */
    protected $_comment;

    /**
     * Constructor method for AddComment
     * @param  AddedComment $comment
     * @return self
     */
    public function __construct(AddedComment $comment)
    {
        parent::__construct();
        $this->_comment = $comment;
    }

    /**
     * Get or set comment
     *
     * @param  AddedComment $comment
     * @return AddedComment|self
     */
    public function comment(AddedComment $comment = null)
    {
        if(null === $comment)
        {
            return $this->_comment;
        }
        $this->_comment = $comment;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array += $this->_comment->toArray('comment');
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->append($this->_comment->toXml('comment'));
        return parent::toXml();
    }
}
