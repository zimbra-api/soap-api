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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement, XmlList};
use Zimbra\Mail\Struct\ExceptIdInfo;
use Zimbra\Common\Struct\{Id, SoapResponse};

/**
 * SetAppointmentResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyentry © 2020-present by Nguyen Van Nguyen.
 */
class SetAppointmentResponse extends SoapResponse
{
    /**
     * Appointment ID
     * 
     * @Accessor(getter="getCalItemId", setter="setCalItemId")
     * @SerializedName("calItemId")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getCalItemId', setter: 'setCalItemId')]
    #[SerializedName('calItemId')]
    #[Type('string')]
    #[XmlAttribute]
    private $calItemId;

    /**
     * Deprecated - appointment ID
     * 
     * @Accessor(getter="getDeprecatedApptId", setter="setDeprecatedApptId")
     * @SerializedName("apptId")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getDeprecatedApptId', setter: 'setDeprecatedApptId')]
    #[SerializedName('apptId')]
    #[Type('string')]
    #[XmlAttribute]
    private $deprecatedApptId;

    /**
     * Information about default invite
     * 
     * @Accessor(getter="getDefaultId", setter="setDefaultId")
     * @SerializedName("default")
     * @Type("Zimbra\Common\Struct\Id")
     * @XmlElement(namespace="urn:zimbraMail")
     * @var Id
     */
    #[Accessor(getter: 'getDefaultId', setter: 'setDefaultId')]
    #[SerializedName('default')]
    #[Type(Id::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private ?Id $defaultId;

    /**
     * Information about exceptions
     * 
     * @Accessor(getter="getExceptions", setter="setExceptions")
     * @Type("array<Zimbra\Mail\Struct\ExceptIdInfo>")
     * @XmlList(inline=true, entry="except", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getExceptions', setter: 'setExceptions')]
    #[Type('array<Zimbra\Mail\Struct\ExceptIdInfo>')]
    #[XmlList(inline: true, entry: 'except', namespace: 'urn:zimbraMail')]
    private $exceptions = [];

    /**
     * Constructor
     *
     * @param  string $calItemId
     * @param  string $deprecatedApptId
     * @param  Id $defaultId
     * @param  array $exceptions
     * @return self
     */
    public function __construct(
        ?string $calItemId = NULL,
        ?string $deprecatedApptId = NULL,
        ?Id $defaultId = NULL,
        array $exceptions = []
    )
    {
        $this->setExceptions($exceptions);
        $this->defaultId = $defaultId;
        if (NULL !== $calItemId) {
            $this->setCalItemId($calItemId);
        }
        if (NULL !== $deprecatedApptId) {
            $this->setDeprecatedApptId($deprecatedApptId);
        }
    }

    /**
     * Get calItemId
     *
     * @return string
     */
    public function getCalItemId(): ?string
    {
        return $this->calItemId;
    }

    /**
     * Set calItemId
     *
     * @param  string $calItemId
     * @return self
     */
    public function setCalItemId(string $calItemId): self
    {
        $this->calItemId = $calItemId;
        return $this;
    }

    /**
     * Get deprecatedApptId
     *
     * @return string
     */
    public function getDeprecatedApptId(): ?string
    {
        return $this->deprecatedApptId;
    }

    /**
     * Set deprecatedApptId
     *
     * @param  string $deprecatedApptId
     * @return self
     */
    public function setDeprecatedApptId(string $deprecatedApptId): self
    {
        $this->deprecatedApptId = $deprecatedApptId;
        return $this;
    }

    /**
     * Get defaultId
     *
     * @return Id
     */
    public function getDefaultId(): ?Id
    {
        return $this->defaultId;
    }

    /**
     * Set defaultId
     *
     * @param  Id $defaultId
     * @return self
     */
    public function setDefaultId(Id $defaultId): self
    {
        $this->defaultId = $defaultId;
        return $this;
    }

    /**
     * Set exceptions
     *
     * @param  array $exceptions
     * @return self
     */
    public function setExceptions(array $exceptions): self
    {
        $this->exceptions = array_filter($exceptions, static fn ($except) => $except instanceof ExceptIdInfo);
        return $this;
    }

    /**
     * Get exceptions
     *
     * @return array
     */
    public function getExceptions(): array
    {
        return $this->exceptions;
    }
}
