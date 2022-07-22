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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};
use Zimbra\Admin\Struct\AttachmentIdAttrib;
use Zimbra\Common\Enum\ZimletDeployAction as DeployAction;
use Zimbra\Common\Soap\{EnvelopeInterface, Request};

/**
 * DeployZimletRequest class
 * Deploy Zimlet(s)
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class DeployZimletRequest extends Request
{
    /**
     * Action - valid values : deployAll|deployLocal|status
     * @Accessor(getter="getAction", setter="setAction")
     * @SerializedName("action")
     * @Type("Zimbra\Common\Enum\ZimletDeployAction")
     * @XmlAttribute
     */
    private DeployAction $action;

    /**
     * Flag whether to flush the cache
     * @Accessor(getter="getFlushCache", setter="setFlushCache")
     * @SerializedName("flush")
     * @Type("bool")
     * @XmlAttribute
     */
    private $flushCache;

    /**
     * Synchronous flag
     * @Accessor(getter="getSynchronous", setter="setSynchronous")
     * @SerializedName("synchronous")
     * @Type("bool")
     * @XmlAttribute
     */
    private $synchronous;

    /**
     * Content
     * @Accessor(getter="getContent", setter="setContent")
     * @SerializedName("content")
     * @Type("Zimbra\Admin\Struct\AttachmentIdAttrib")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private AttachmentIdAttrib $content;

    /**
     * Constructor method for DeployZimletRequest
     * 
     * @param  AttachmentIdAttrib $content
     * @param  DeployAction $action
     * @param  bool $flushCache
     * @param  bool $synchronous
     * @return self
     */
    public function __construct(
        AttachmentIdAttrib $content, ?DeployAction $action = NULL, ?bool $flushCache = NULL, ?bool $synchronous = NULL
    )
    {
        $this->setAction($action ?? DeployAction::DEPLOY_ALL())
             ->setContent($content);
        if (NULL !== $flushCache) {
            $this->setFlushCache($flushCache);
        }
        if (NULL !== $synchronous) {
            $this->setSynchronous($synchronous);
        }
    }

    /**
     * Gets action
     *
     * @return DeployAction
     */
    public function getAction(): DeployAction
    {
        return $this->action;
    }

    /**
     * Sets action
     *
     * @param  DeployAction $action
     * @return self
     */
    public function setAction(DeployAction $action): self
    {
        $this->action = $action;
        return $this;
    }

    /**
     * Gets flushCache
     *
     * @return bool
     */
    public function getFlushCache(): ?bool
    {
        return $this->flushCache;
    }

    /**
     * Sets flushCache
     *
     * @param  bool $flushCache
     * @return self
     */
    public function setFlushCache(bool $flushCache): self
    {
        $this->flushCache = $flushCache;
        return $this;
    }

    /**
     * Gets synchronous
     *
     * @return bool
     */
    public function getSynchronous(): ?bool
    {
        return $this->synchronous;
    }

    /**
     * Sets synchronous
     *
     * @param  bool $synchronous
     * @return self
     */
    public function setSynchronous(bool $synchronous): self
    {
        $this->synchronous = $synchronous;
        return $this;
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
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new DeployZimletEnvelope(
            new DeployZimletBody($this)
        );
    }
}
