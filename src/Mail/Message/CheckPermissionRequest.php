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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement, XmlList};
use Zimbra\Mail\Struct\TargetSpec;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * CheckPermissionRequest class
 * Check if the authed user has the specified right(s) on a target.
 * Note: to be deprecated in Zimbra 9.  Use zimbraAccount CheckRights instead.
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CheckPermissionRequest extends SoapRequest
{
    /**
     * Target specification
     * 
     * @Accessor(getter="getTarget", setter="setTarget")
     * @SerializedName("target")
     * @Type("Zimbra\Mail\Struct\TargetSpec")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var TargetSpec
     */
    #[Accessor(getter: "getTarget", setter: "setTarget")]
    #[SerializedName('target')]
    #[Type(TargetSpec::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $target;

    /**
     * Rights to check
     * 
     * @Accessor(getter="getRights", setter="setRights")
     * @Type("array<string>")
     * @XmlList(inline=true, entry="right", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getRights', setter: 'setRights')]
    #[Type('array<string>')]
    #[XmlList(inline: true, entry: 'right', namespace: 'urn:zimbraMail')]
    private $rights = [];

    /**
     * Constructor
     *
     * @param  TargetSpec $target
     * @param  array $rights
     * @return self
     */
    public function __construct(?TargetSpec $target = NULL, array $rights = [])
    {
        $this->setRights($rights);
        if ($target instanceof TargetSpec) {
            $this->setTarget($target);
        }
    }

    /**
     * Get target
     *
     * @return TargetSpec
     */
    public function getTarget(): ?TargetSpec
    {
        return $this->target;
    }

    /**
     * Set target
     *
     * @param  TargetSpec $target
     * @return self
     */
    public function setTarget(TargetSpec $target): self
    {
        $this->target = $target;
        return $this;
    }

    /**
     * Add a right
     *
     * @param  string $right
     * @return self
     */
    public function addRight($right): self
    {
        $right = trim($right);
        if (!empty($right) && !in_array($right, $this->rights)) {
            $this->rights[] = $right;
        }
        return $this;
    }

    /**
     * Set rights
     *
     * @param  array $rights
     * @return self
     */
    public function setRights(array $rights): self
    {
        $this->rights = [];
        foreach ($rights as $right) {
            $this->addRight($right);
        }
        return $this;
    }

    /**
     * Get rights
     *
     * @return array
     */
    public function getRights(): array
    {
        return $this->rights;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new CheckPermissionEnvelope(
            new CheckPermissionBody($this)
        );
    }
}
