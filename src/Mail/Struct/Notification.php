<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement
};
use Zimbra\Common\Struct\NotificationInterface;

/**
 * Notification class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class Notification implements NotificationInterface
{
    /**
     * Truncated flag
     *
     * @Accessor(getter="getTruncatedContent", setter="setTruncatedContent")
     * @SerializedName("truncated")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "getTruncatedContent", setter: "setTruncatedContent")]
    #[SerializedName("truncated")]
    #[Type("bool")]
    #[XmlAttribute]
    private $truncatedContent;

    /**
     * Content
     *
     * @Accessor(getter="getContent", setter="setContent")
     * @SerializedName("content")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraMail")
     *
     * @var string
     */
    #[Accessor(getter: "getContent", setter: "setContent")]
    #[SerializedName("content")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraMail")]
    private $content;

    /**
     * Constructor
     *
     * @param  bool $truncatedContent
     * @param  string $content
     * @return self
     */
    public function __construct(
        ?bool $truncatedContent = null,
        ?string $content = null
    ) {
        if (null !== $truncatedContent) {
            $this->setTruncatedContent($truncatedContent);
        }
        if (null !== $content) {
            $this->setContent($content);
        }
    }

    /**
     * Get truncatedContent
     *
     * @return bool
     */
    public function getTruncatedContent(): ?bool
    {
        return $this->truncatedContent;
    }

    /**
     * Set truncatedContent
     *
     * @param  bool $truncatedContent
     * @return self
     */
    public function setTruncatedContent(bool $truncatedContent): self
    {
        $this->truncatedContent = $truncatedContent;
        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * Set content
     *
     * @param  string $content
     * @return self
     */
    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }
}
