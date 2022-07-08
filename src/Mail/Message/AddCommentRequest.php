<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Mail\Struct\AddedComment;
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * AddCommentRequest class
 * Add a comment to the specified item.  Currently comments can only be added to documents
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class AddCommentRequest extends Request
{
    /**
     * Added comment
     * 
     * @Accessor(getter="getComment", setter="setComment")
     * @SerializedName("comment")
     * @Type("Zimbra\Mail\Struct\AddedComment")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private AddedComment $comment;

    /**
     * Constructor method for AddCommentRequest
     *
     * @param  AddedComment $comment
     * @return self
     */
    public function __construct(AddedComment $comment)
    {
        $this->setComment($comment);
    }

    /**
     * Gets comment
     *
     * @return AddedComment
     */
    public function getComment(): AddedComment
    {
        return $this->comment;
    }

    /**
     * Sets comment
     *
     * @param  AddedComment $comment
     * @return self
     */
    public function setComment(AddedComment $comment): self
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new AddCommentEnvelope(
            new AddCommentBody($this)
        );
    }
}
