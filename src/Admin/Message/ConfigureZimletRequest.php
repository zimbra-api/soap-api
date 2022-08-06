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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Admin\Struct\AttachmentIdAttrib;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * ConfigureZimletRequest request class
 * Configure Zimlet
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ConfigureZimletRequest extends SoapRequest
{
    /**
     * Content
     * 
     * @Accessor(getter="getContent", setter="setContent")
     * @SerializedName("content")
     * @Type("Zimbra\Admin\Struct\AttachmentIdAttrib")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private AttachmentIdAttrib $content;

    /**
     * Constructor
     * 
     * @param  AttachmentIdAttrib $content
     * @return self
     */
    public function __construct(AttachmentIdAttrib $content)
    {
        $this->setContent($content);
    }

    /**
     * Get the content.
     *
     * @return AttachmentIdAttrib
     */
    public function getContent(): AttachmentIdAttrib
    {
        return $this->content;
    }

    /**
     * Set the content.
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new ConfigureZimletEnvelope(
            new ConfigureZimletBody($this)
        );
    }
}
