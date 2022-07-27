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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Enum\RightClass;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * GetAllRightsRequest class
 * Get all system defined rights
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetAllRightsRequest extends SoapRequest
{
    /**
     * Target type on which a right is grantable
     * e.g. createAccount right is only grantable on domain entries and the globalgrant entry.
     * Don't confuse this with "whether a right is executable on a target type".
     * e.g. the renameAccount right is "executable" on account entries, but it is "grantable" on account,
     * distribuiton list, domain, and globalgrant entries.
     * @Accessor(getter="getTargetType", setter="setTargetType")
     * @SerializedName("targetType")
     * @Type("string")
     * @XmlAttribute
     */
    private $targetType;

    /**
     * Flags whether to include all attribute names in the <attrs> elements in GetRightResponse if the right is meant for all attributes
     * @Accessor(getter="isExpandAllAttrs", setter="setExpandAllAttrs")
     * @SerializedName("expandAllAttrs")
     * @Type("bool")
     * @XmlAttribute
     */
    private $expandAllAttrs;

    /**
     * Right class to return
     * ADMIN: return admin rights only
     * USER:  return user rights only 
     * ALL:   return both admin rights and user rights
     * @Accessor(getter="getRightClass", setter="setRightClass")
     * @SerializedName("rightClass")
     * @Type("Zimbra\Common\Enum\RightClass")
     * @XmlAttribute
     */
    private ?RightClass $rightClass = NULL;

    /**
     * Constructor method for GetAllRightsRequest
     * 
     * @param  string $targetType
     * @param  bool $expandAllAttrs
     * @param  RightClass $rightClass
     * @return self
     */
    public function __construct(
        ?string $targetType = NULL, ?bool $expandAllAttrs = NULL, ?RightClass $rightClass = NULL
    )
    {
        if (NULL !== $targetType) {
            $this->setTargetType($targetType);
        }
        if (NULL !== $expandAllAttrs) {
            $this->setExpandAllAttrs($expandAllAttrs);
        }
        if ($rightClass instanceof RightClass) {
            $this->setRightClass($rightClass);
        }
    }

    /**
     * Gets targetType
     *
     * @return string
     */
    public function getTargetType(): ?string
    {
        return $this->targetType;
    }

    /**
     * Sets targetType
     *
     * @param  int $targetType
     * @return self
     */
    public function setTargetType(string $targetType): self
    {
        $this->targetType = $targetType;
        return $this;
    }

    /**
     * Gets expandAllAttrs
     *
     * @return bool
     */
    public function isExpandAllAttrs(): ?bool
    {
        return $this->expandAllAttrs;
    }

    /**
     * Sets expandAllAttrs
     *
     * @param  bool $expandAllAttrs
     * @return self
     */
    public function setExpandAllAttrs(bool $expandAllAttrs): self
    {
        $this->expandAllAttrs = $expandAllAttrs;
        return $this;
    }

    /**
     * Gets rightClass
     *
     * @return RightClass
     */
    public function getRightClass(): ?RightClass
    {
        return $this->rightClass;
    }

    /**
     * Sets rightClass
     *
     * @param  RightClass $rightClass
     * @return self
     */
    public function setRightClass(RightClass $rightClass): self
    {
        $this->rightClass = $rightClass;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return SoapEnvelopeInterface
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetAllRightsEnvelope(
            new GetAllRightsBody($this)
        );
    }
}
