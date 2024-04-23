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
use Zimbra\Common\Enum\ZimletDeployAction;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * DeployZimletRequest class
 * Deploy Zimlet(s)
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DeployZimletRequest extends SoapRequest
{
    /**
     * Action - valid values : deployAll|deployLocal|status
     * 
     * @var ZimletDeployAction
     */
    #[Accessor(getter: 'getAction', setter: 'setAction')]
    #[SerializedName('action')]
    #[XmlAttribute]
    private ZimletDeployAction $action;

    /**
     * Flag whether to flush the cache
     * 
     * @var bool
     */
    #[Accessor(getter: 'getFlushCache', setter: 'setFlushCache')]
    #[SerializedName('flush')]
    #[Type('bool')]
    #[XmlAttribute]
    private $flushCache;

    /**
     * Synchronous flag
     * 
     * @var bool
     */
    #[Accessor(getter: 'getSynchronous', setter: 'setSynchronous')]
    #[SerializedName('synchronous')]
    #[Type('bool')]
    #[XmlAttribute]
    private $synchronous;

    /**
     * Content
     * 
     * @var AttachmentIdAttrib
     */
    #[Accessor(getter: 'getContent', setter: 'setContent')]
    #[SerializedName('content')]
    #[Type(AttachmentIdAttrib::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private AttachmentIdAttrib $content;

    /**
     * Constructor
     * 
     * @param  AttachmentIdAttrib $content
     * @param  ZimletDeployAction $action
     * @param  bool $flushCache
     * @param  bool $synchronous
     * @return self
     */
    public function __construct(
        AttachmentIdAttrib $content,
        ?ZimletDeployAction $action = null,
        ?bool $flushCache = null,
        ?bool $synchronous = null
    )
    {
        $this->setAction($action ?? ZimletDeployAction::DEPLOY_ALL)
             ->setContent($content);
        if (null !== $flushCache) {
            $this->setFlushCache($flushCache);
        }
        if (null !== $synchronous) {
            $this->setSynchronous($synchronous);
        }
    }

    /**
     * Get action
     *
     * @return ZimletDeployAction
     */
    public function getAction(): ZimletDeployAction
    {
        return $this->action;
    }

    /**
     * Set action
     *
     * @param  ZimletDeployAction $action
     * @return self
     */
    public function setAction(ZimletDeployAction $action): self
    {
        $this->action = $action;
        return $this;
    }

    /**
     * Get flushCache
     *
     * @return bool
     */
    public function getFlushCache(): ?bool
    {
        return $this->flushCache;
    }

    /**
     * Set flushCache
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
     * Get synchronous
     *
     * @return bool
     */
    public function getSynchronous(): ?bool
    {
        return $this->synchronous;
    }

    /**
     * Set synchronous
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
        return new DeployZimletEnvelope(
            new DeployZimletBody($this)
        );
    }
}
