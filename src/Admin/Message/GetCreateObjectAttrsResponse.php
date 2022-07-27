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
use Zimbra\Admin\Struct\EffectiveAttrsInfo;
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * GetCreateObjectAttrsResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetCreateObjectAttrsResponse implements SoapResponseInterface
{
    /**
     * Set attributes
     * @Accessor(getter="getSetAttrs", setter="setSetAttrs")
     * @SerializedName("setAttrs")
     * @Type("Zimbra\Admin\Struct\EffectiveAttrsInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?EffectiveAttrsInfo $setAttrs = NULL;

    /**
     * Constructor method for GetCreateObjectAttrsResponse
     *
     * @param EffectiveAttrsInfo $setAttrs
     * @return self
     */
    public function __construct(?EffectiveAttrsInfo $setAttrs = NULL)
    {
        if ($setAttrs instanceof EffectiveAttrsInfo) {
            $this->setSetAttrs($setAttrs);
        }
    }

    /**
     * Gets the setAttrs.
     *
     * @return EffectiveAttrsInfo
     */
    public function getSetAttrs(): ?EffectiveAttrsInfo
    {
        return $this->setAttrs;
    }

    /**
     * Sets the setAttrs.
     *
     * @param  EffectiveAttrsInfo $setAttrs
     * @return self
     */
    public function setSetAttrs(EffectiveAttrsInfo $setAttrs): self
    {
        $this->setAttrs = $setAttrs;
        return $this;
    }
}
