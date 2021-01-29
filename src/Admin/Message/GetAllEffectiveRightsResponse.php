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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlList, XmlRoot};
use Zimbra\Admin\Struct\EffectiveRightsTarget;
use Zimbra\Admin\Struct\GranteeInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * GetAllEffectiveRightsResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="GetAllEffectiveRightsResponse")
 */
class GetAllEffectiveRightsResponse implements ResponseInterface
{
    /**
     * Grantee information
     * @Accessor(getter="getGrantee", setter="setGrantee")
     * @SerializedName("grantee")
     * @Type("Zimbra\Admin\Struct\GranteeInfo")
     * @XmlElement
     */
    private $grantee;

    /**
     * Effective rights targets
     * 
     * @Accessor(getter="getTargets", setter="setTargets")
     * @SerializedName("target")
     * @Type("array<Zimbra\Admin\Struct\EffectiveRightsTarget>")
     * @XmlList(inline = true, entry = "target")
     */
    private $targets;

    /**
     * Constructor method for GetAllEffectiveRightsResponse
     *
     * @param GranteeInfo $grantee
     * @param array $targets
     * @return self
     */
    public function __construct(?GranteeInfo $grantee = NULL, array $targets = [])
    {
        if ($grantee instanceof GranteeInfo) {
            $this->setGrantee($grantee);
        }
        $this->setTargets($targets);
    }

    /**
     * Sets the grantee.
     *
     * @return GranteeInfo
     */
    public function getGrantee(): ?GranteeInfo
    {
        return $this->grantee;
    }

    /**
     * Sets the grantee.
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
     * Add a target
     *
     * @param  EffectiveRightsTarget $target
     * @return self
     */
    public function addTarget(EffectiveRightsTarget $target): self
    {
        $this->targets[] = $target;
        return $this;
    }

    /**
     * Sets targets
     *
     * @param  array $targets
     * @return self
     */
    public function setTargets(array $targets): self
    {
        $this->targets = [];
        foreach ($targets as $target) {
            if ($target instanceof EffectiveRightsTarget) {
                $this->targets[] = $target;
            }
        }
        return $this;
    }

    /**
     * Gets targets
     *
     * @return array
     */
    public function getTargets(): array
    {
        return $this->targets;
    }
}
