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
use Zimbra\Mail\Struct\ParentId;
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * GetCommentsRequest class
 * Get comments
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetCommentsRequest extends Request
{
    /**
     * Select parent for comments
     * @Accessor(getter="getComment", setter="setComment")
     * @SerializedName("comment")
     * @Type("Zimbra\Mail\Struct\ParentId")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ParentId $comment;

    /**
     * Constructor method for GetCommentsRequest
     *
     * @param  ParentId $comment
     * @return self
     */
    public function __construct(ParentId $comment)
    {
        $this->setComment($comment);
    }

    /**
     * Gets comment
     *
     * @return ParentId
     */
    public function getComment(): ParentId
    {
        return $this->comment;
    }

    /**
     * Sets comment
     *
     * @param  ParentId $comment
     * @return self
     */
    public function setComment(ParentId $comment): self
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
        return new GetCommentsEnvelope(
            new GetCommentsBody($this)
        );
    }
}
