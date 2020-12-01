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
use Zimbra\Admin\Struct\EffectiveRightsTargetInfo as Target;
use Zimbra\Admin\Struct\GranteeInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * GetEffectiveRightsResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="GetEffectiveRightsResponse")
 */
class GetEffectiveRightsResponse implements ResponseInterface
{
    /**
     * Information about grantee
     * @Accessor(getter="getGrantee", setter="setGrantee")
     * @SerializedName("grantee")
     * @Type("Zimbra\Admin\Struct\GranteeInfo")
     * @XmlElement
     */
    private $grantee;

    /**
     * Information about target
     * @Accessor(getter="getTarget", setter="setTarget")
     * @SerializedName("target")
     * @Type("Zimbra\Admin\Struct\EffectiveRightsTargetInfo")
     * @XmlElement
     */
    private $target;

    /**
     * Constructor method for GetEffectiveRightsResponse
     * 
     * @param GranteeInfo $grantee
     * @param Target $target
     * @return self
     */
    public function __construct(GranteeInfo $grantee, Target $target)
    {
        $this->setGrantee($grantee)
            ->setTarget($target);
    }

    /**
     * Sets the grantee.
     *
     * @return GranteeInfo
     */
    public function getGrantee(): GranteeInfo
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
     * Sets target
     *
     * @param  Target $target
     * @return self
     */
    public function setTarget(Target $target): self
    {
        $this->target = $target;
        return $this;
    }

    /**
     * Gets target
     *
     * @return Target
     */
    public function getTarget(): Target
    {
        return $this->target;
    }
}
