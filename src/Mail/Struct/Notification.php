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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlRoot};

use Zimbra\Struct\NotificationInterface;

/**
 * Notification class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="notification")
 */
class Notification implements NotificationInterface
{
    /**
     * Truncated flag
     * @Accessor(getter="getTruncatedContent", setter="setTruncatedContent")
     * @SerializedName("truncated")
     * @Type("bool")
     * @XmlAttribute
     */
    private $truncatedContent;

    /**
     * Content
     * @Accessor(getter="getContent", setter="setContent")
     * @SerializedName("content")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $content;

    /**
     * Constructor method for Notification
     *
     * @param  bool $truncatedContent
     * @param  string $content
     * @return self
     */
    public function __construct(?bool $truncatedContent = NULL, ?string $content = NULL)
    {
        if (NULL !== $truncatedContent) {
            $this->setTruncatedContent($truncatedContent);
        }
        if (NULL !== $content) {
            $this->setContent($content);
        }
    }

    /**
     * Gets truncatedContent
     *
     * @return bool
     */
    public function getTruncatedContent(): ?bool
    {
        return $this->truncatedContent;
    }

    /**
     * Sets truncatedContent
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
     * Gets value
     *
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->value;
    }

    /**
     * Sets value
     *
     * @param  string $value
     * @return self
     */
    public function setContent(string $value): self
    {
        $this->value = $value;
        return $this;
    }
}
