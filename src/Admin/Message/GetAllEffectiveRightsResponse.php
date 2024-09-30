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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlElement,
    XmlList
};
use Zimbra\Admin\Struct\{EffectiveRightsTarget, GranteeInfo};
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetAllEffectiveRightsResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAllEffectiveRightsResponse extends SoapResponse
{
    /**
     * Grantee information
     *
     * @Accessor(getter="getGrantee", setter="setGrantee")
     * @SerializedName("grantee")
     * @Type("Zimbra\Admin\Struct\GranteeInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var GranteeInfo
     */
    #[Accessor(getter: "getGrantee", setter: "setGrantee")]
    #[SerializedName("grantee")]
    #[Type(GranteeInfo::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?GranteeInfo $grantee;

    /**
     * Effective rights targets
     *
     * @Accessor(getter="getTargets", setter="setTargets")
     * @Type("array<Zimbra\Admin\Struct\EffectiveRightsTarget>")
     * @XmlList(inline=true, entry="target", namespace="urn:zimbraAdmin")
     *
     * @var array
     */
    #[Accessor(getter: "getTargets", setter: "setTargets")]
    #[Type("array<Zimbra\Admin\Struct\EffectiveRightsTarget>")]
    #[XmlList(inline: true, entry: "target", namespace: "urn:zimbraAdmin")]
    private $targets = [];

    /**
     * Constructor
     *
     * @param GranteeInfo $grantee
     * @param array $targets
     * @return self
     */
    public function __construct(
        ?GranteeInfo $grantee = null,
        array $targets = []
    ) {
        $this->setTargets($targets);
        $this->grantee = $grantee;
    }

    /**
     * Set the grantee.
     *
     * @return GranteeInfo
     */
    public function getGrantee(): ?GranteeInfo
    {
        return $this->grantee;
    }

    /**
     * Set the grantee.
     *
     * @param  GranteeInfo $grantee
     * @return self
     */
    public function setGrantee(GranteeInfo $grantee): self
    {
        $this->grantee = $grantee;
        return $this;
    }

    /**
     * Set targets
     *
     * @param  array $targets
     * @return self
     */
    public function setTargets(array $targets): self
    {
        $this->targets = array_filter(
            $targets,
            static fn($target) => $target instanceof EffectiveRightsTarget
        );
        return $this;
    }

    /**
     * Get targets
     *
     * @return array
     */
    public function getTargets(): array
    {
        return $this->targets;
    }
}
