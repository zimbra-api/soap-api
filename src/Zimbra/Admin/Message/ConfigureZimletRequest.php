<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlRoot};
use Zimbra\Admin\Struct\AttachmentIdAttrib;
use Zimbra\Soap\{EnvelopeInterface, RequestInterface};

/**
 * ConfigureZimletRequest request class
 * Configure Zimlet
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="ConfigureZimletRequest")
 */
class ConfigureZimletRequest implements RequestInterface
{
    /**
     * Content
     * @Accessor(getter="getContent", setter="setContent")
     * @SerializedName("content")
     * @Type("Zimbra\Admin\Struct\AttachmentIdAttrib")
     * @XmlElement
     */
    private $content;

    /**
     * Constructor method for ConfigureZimletRequest
     * @param  AttachmentIdAttrib $content
     * @return self
     */
    public function __construct(AttachmentIdAttrib $content)
    {
        $this->setContent($content);
    }

    /**
     * Gets the content.
     *
     * @return AttachmentIdAttrib
     */
    public function getContent(): AttachmentIdAttrib
    {
        return $this->content;
    }

    /**
     * Sets the content.
     *
     * @param  AttachmentIdAttrib $content
     * @return self
     */
    public function setContent(AttachmentIdAttrib $content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Get soap envelope.
     *
     * @return EnvelopeInterface
     */
    public function getEnvelope(): EnvelopeInterface
    {
        return new ConfigureZimletEnvelope(
            new ConfigureZimletBody($this)
        );
    }
}
