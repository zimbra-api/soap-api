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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};
use Zimbra\Mail\Struct\{CalTZInfo, DtTimeInfo};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * CompleteTaskInstanceRequest class
 * Complete a task instance
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CompleteTaskInstanceRequest extends SoapRequest
{
    /**
     * ID
     * 
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName('id')]
    #[Type('string')]
    #[XmlAttribute]
    private $id;

    /**
     * Exception ID
     * 
     * @var DtTimeInfo
     */
    #[Accessor(getter: "getExceptionId", setter: "setExceptionId")]
    #[SerializedName('exceptId')]
    #[Type(DtTimeInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $exceptionId;

    /**
     * Timezone information
     * 
     * @var CalTZInfo
     */
    #[Accessor(getter: "getTimezone", setter: "setTimezone")]
    #[SerializedName('tz')]
    #[Type(CalTZInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $timezone;

    /**
     * Constructor
     *
     * @param  DtTimeInfo $exceptionId
     * @param  string $id
     * @param  CalTZInfo $timezone
     * @return self
     */
    public function __construct(
        DtTimeInfo $exceptionId, string $id = '', ?CalTZInfo $timezone = NULL
    )
    {
        $this->setId($id)
             ->setExceptionId($exceptionId);
        if (NULL !== $timezone) {
            $this->setTimezone($timezone);
        }
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get exceptionId
     *
     * @return DtTimeInfo
     */
    public function getExceptionId(): DtTimeInfo
    {
        return $this->exceptionId;
    }

    /**
     * Set exceptionId
     *
     * @param  DtTimeInfo $exceptionId
     * @return self
     */
    public function setExceptionId(DtTimeInfo $exceptionId): self
    {
        $this->exceptionId = $exceptionId;
        return $this;
    }

    /**
     * Get timezone
     *
     * @return CalTZInfo
     */
    public function getTimezone(): ?CalTZInfo
    {
        return $this->timezone;
    }

    /**
     * Set timezone
     *
     * @param  CalTZInfo $timezone
     * @return self
     */
    public function setTimezone(CalTZInfo $timezone): self
    {
        $this->timezone = $timezone;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new CompleteTaskInstanceEnvelope(
            new CompleteTaskInstanceBody($this)
        );
    }
}
