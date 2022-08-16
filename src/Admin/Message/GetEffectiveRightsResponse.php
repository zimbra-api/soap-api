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
use Zimbra\Admin\Struct\EffectiveRightsTargetInfo as Target;
use Zimbra\Admin\Struct\GranteeInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetEffectiveRightsResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetEffectiveRightsResponse extends SoapResponse
{
    /**
     * Information about grantee
     * 
     * @var GranteeInfo
     */
    #[Accessor(getter: 'getGrantee', setter: 'setGrantee')]
    #[SerializedName(name: 'grantee')]
    #[Type(name: GranteeInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $grantee;

    /**
     * Information about target
     * 
     * @var Target
     */
    #[Accessor(getter: 'getTarget', setter: 'setTarget')]
    #[SerializedName(name: 'target')]
    #[Type(name: Target::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $target;

    /**
     * Constructor
     * 
     * @param GranteeInfo $grantee
     * @param Target $target
     * @return self
     */
    public function __construct(
        ?GranteeInfo $grantee = NULL, ?Target $target = NULL
    )
    {
        if ($grantee instanceof GranteeInfo) {
            $this->setGrantee($grantee);
        }
        if ($target instanceof Target) {
            $this->setTarget($target);
        }
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
     * Set target
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
     * Get target
     *
     * @return Target
     */
    public function getTarget(): ?Target
    {
        return $this->target;
    }
}
