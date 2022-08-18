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
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * AddCommentRequest class
 * Add a comment to the specified item.  Currently comments can only be added to documents
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AddCommentRequest extends SoapRequest
{
    /**
     * Added comment
     * 
     * @Accessor(getter="getComment", setter="setComment")
     * @SerializedName("comment")
     * @Type("Zimbra\Mail\Struct\AddedComment")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var AddedComment
     */
    #[Accessor(getter: "getComment", setter: "setComment")]
    #[SerializedName('comment')]
    #[Type(AddedComment::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $comment;

    /**
     * Constructor
     *
     * @param  AddedComment $comment
     * @return self
     */
    public function __construct(AddedComment $comment)
    {
        $this->setComment($comment);
    }

    /**
     * Get comment
     *
     * @return AddedComment
     */
    public function getComment(): AddedComment
    {
        return $this->comment;
    }

    /**
     * Set comment
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new AddCommentEnvelope(
            new AddCommentBody($this)
        );
    }
}
