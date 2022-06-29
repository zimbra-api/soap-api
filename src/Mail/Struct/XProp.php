<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};
use Zimbra\Common\Struct\{XParamInterface, XPropInterface};

/**
 * XProp class
 * Non-standard parameter
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class XProp implements XPropInterface
{
    /**
     * XPROP Name
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * XPROP value
     * @Accessor(getter="getValue", setter="setValue")
     * @SerializedName("value")
     * @Type("string")
     * @XmlAttribute
     */
    private $value;

    /**
     * XPARAMs
     * @Accessor(getter="getXParams", setter="setXParams")
     * @SerializedName("xparam")
     * @Type("array<Zimbra\Mail\Struct\XParam>")
     * @XmlList(inline=true, entry="xparam", namespace="urn:zimbraMail")
     */
    private $xParams = [];

    /**
     * Constructor method for XProp
     *
     * @param  string $name
     * @param  string $value
     * @param  array $xParams
     * @return self
     */
    public function __construct(string $name = '', string $value = '', array $xParams = [])
    {
        $this->setName($name)
             ->setValue($value)
             ->setXParams($xParams);
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets value
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Sets value
     *
     * @param  string $value
     * @return self
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Add xParam
     *
     * @param  XParamInterface $xParam
     * @return self
     */
    public function addXParam(XParamInterface $xParam): self
    {
        $this->xParams[] = $xParam;
        return $this;
    }

    /**
     * Set xParams
     *
     * @param  array $xParams
     * @return self
     */
    public function setXParams(array $xParams): self
    {
        $this->xParams = array_filter($xParams, static fn ($xParam) => $xParam instanceof XParamInterface);
        return $this;
    }

    /**
     * Gets xParams
     *
     * @return array
     */
    public function getXParams(): array
    {
        return $this->xParams;
    }
}
