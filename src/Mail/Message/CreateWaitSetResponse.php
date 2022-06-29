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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};
use Zimbra\Common\Enum\InterestType;
use Zimbra\Common\Struct\{CreateWaitSetResp, IdAndType};
use Zimbra\Soap\ResponseInterface;

/**
 * CreateWaitSetResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class CreateWaitSetResponse implements CreateWaitSetResp, ResponseInterface
{
    /**
     * WaitSet ID
     * 
     * @Accessor(getter="getWaitSetId", setter="setWaitSetId")
     * @SerializedName("waitSet")
     * @Type("string")
     * @XmlAttribute
     */
    private $waitSetId;

    /**
     * Default interest types: comma-separated list.  Currently:
     * f: folders
     * m: messages
     * c: contacts
     * a: appointments
     * t: tasks
     * d: documents
     * all: all types (equiv to "f,m,c,a,t,d")
     * 
     * This is used if types isn't specified for an account
     * @Accessor(getter="getDefaultInterests", setter="setDefaultInterests")
     * @SerializedName("defTypes")
     * @Type("string")
     * @XmlAttribute
     */
    private $defaultInterests;

    /**
     * Sequence
     * 
     * @Accessor(getter="getSequence", setter="setSequence")
     * @SerializedName("seq")
     * @Type("integer")
     * @XmlAttribute
     */
    private $sequence;

    /**
     * Error information
     * 
     * @Accessor(getter="getErrors", setter="setErrors")
     * @Type("array<Zimbra\Common\Struct\IdAndType>")
     * @XmlList(inline=true, entry="error", namespace="urn:zimbraMail")
     */
    private $errors = [];

    /**
     * Constructor method for CreateWaitSetResponse
     *
     * @param  string $waitSetId
     * @param  sequence $defaultInterests
     * @param  int $sequence
     * @param  array $errors
     * @return self
     */
    public function __construct(
        ?string $waitSetId = NULL,
        ?string $defaultInterests = NULL,
        ?int $sequence = NULL,
        array $errors = []
    )
    {
        $this->setErrors($errors);
        if (NULL !== $waitSetId) {
            $this->setWaitSetId($waitSetId);
        }
        if (NULL !== $defaultInterests) {
            $this->setDefaultInterests($defaultInterests);
        }
        if (NULL !== $sequence) {
            $this->setSequence($sequence);
        }
    }

    /**
     * Gets waitSetId
     *
     * @return string
     */
    public function getWaitSetId(): ?string
    {
        return $this->waitSetId;
    }

    /**
     * Sets waitSetId
     *
     * @param  string $waitSetId
     * @return self
     */
    public function setWaitSetId(string $waitSetId): self
    {
        $this->waitSetId = $waitSetId;
        return $this;
    }

    /**
     * Gets defaultInterests
     *
     * @return string
     */
    public function getDefaultInterests(): ?string
    {
        return $this->defaultInterests;
    }

    /**
     * Sets defaultInterests
     *
     * @param  string $defaultInterests
     * @return self
     */
    public function setDefaultInterests(string $defaultInterests): self
    {
        $types = array_filter(explode(',', $defaultInterests), static fn ($type) => InterestType::isValid($type));
        $this->defaultInterests = implode(',', array_unique($types));
        return $this;
    }

    /**
     * Add error
     *
     * @param  IdAndType $error
     * @return self
     */
    public function addError(IdAndType $error): self
    {
        $this->errors[] = $error;
        return $this;
    }

    /**
     * Sets errors
     *
     * @param  array $errors
     * @return self
     */
    public function setErrors(array $errors = []): self
    {
        $this->errors = array_filter($errors, static fn ($error) => $error instanceof IdAndType);
        return $this;
    }

    /**
     * Gets errors
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Gets sequence
     *
     * @return int
     */
    public function getSequence(): ?int
    {
        return $this->sequence;
    }

    /**
     * Sets sequence
     *
     * @param  int $sequence
     * @return self
     */
    public function setSequence(int $sequence): self
    {
        $this->sequence = $sequence;
        return $this;
    }
}
