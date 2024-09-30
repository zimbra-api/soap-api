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
use Zimbra\Common\Enum\ZimletExcludeType;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * GetAllZimletsRequest class
 * Get all Zimlets
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAllZimletsRequest extends SoapRequest
{
    /**
     * {exclude} can be "none|extension|mail"
     * extension:    return only mail Zimlets
     * mail:     return only admin extensions
     * none [default]:   return both mail and admin zimlets
     *
     * @Accessor(getter="getExclude", setter="setExclude")
     * @SerializedName("exclude")
     * @Type("Enum<Zimbra\Common\Enum\ZimletExcludeType>")
     * @XmlAttribute
     *
     * @var ZimletExcludeType
     */
    #[Accessor(getter: "getExclude", setter: "setExclude")]
    #[SerializedName("exclude")]
    #[Type("Enum<Zimbra\Common\Enum\ZimletExcludeType>")]
    #[XmlAttribute]
    private ?ZimletExcludeType $exclude;

    /**
     * Constructor
     *
     * @param  ZimletExcludeType $exclude
     * @return self
     */
    public function __construct(?ZimletExcludeType $exclude = null)
    {
        $this->exclude = $exclude;
    }

    /**
     * Get exclude
     *
     * @return ZimletExcludeType
     */
    public function getExclude(): ?ZimletExcludeType
    {
        return $this->exclude;
    }

    /**
     * Set exclude
     *
     * @param  ZimletExcludeType $exclude
     * @return self
     */
    public function setExclude(ZimletExcludeType $exclude): self
    {
        $this->exclude = $exclude;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetAllZimletsEnvelope(new GetAllZimletsBody($this));
    }
}
