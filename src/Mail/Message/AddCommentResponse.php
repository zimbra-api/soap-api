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
use Zimbra\Common\Struct\{Id, SoapResponse};

/**
 * AddCommentResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AddCommentResponse extends SoapResponse
{
    /**
     * Item ID for the comment
     * 
     * @Accessor(getter="getComment", setter="setComment")
     * @SerializedName("comment")
     * @Type("Zimbra\Common\Struct\Id")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var Id
     */
    #[Accessor(getter: "getComment", setter: "setComment")]
    #[SerializedName('comment')]
    #[Type(Id::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private ?Id $comment;

    /**
     * Constructor
     *
     * @param  Id $comment
     * @return self
     */
    public function __construct(?Id $comment = NULL)
    {
        $this->comment = $comment;
    }

    /**
     * Get comment
     *
     * @return Id
     */
    public function getComment(): ?Id
    {
        return $this->comment;
    }

    /**
     * Set comment
     *
     * @param  Id $comment
     * @return self
     */
    public function setComment(Id $comment): self
    {
        $this->comment = $comment;
        return $this;
    }
}
