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
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetCreateObjectAttrsResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetCreateObjectAttrsResponse extends SoapResponse
{
    /**
     * Set attributes
     * 
     * @var EffectiveAttrsInfo
     */
    #[Accessor(getter: 'getSetAttrs', setter: 'setSetAttrs')]
    #[SerializedName('setAttrs')]
    #[Type(EffectiveAttrsInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $setAttrs;

    /**
     * Constructor
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
     * Get the setAttrs.
     *
     * @return EffectiveAttrsInfo
     */
    public function getSetAttrs(): ?EffectiveAttrsInfo
    {
        return $this->setAttrs;
    }

    /**
     * Set the setAttrs.
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
