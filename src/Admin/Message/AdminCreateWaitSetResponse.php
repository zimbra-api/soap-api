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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};
use Zimbra\Common\Struct\IdAndType;
use Zimbra\Soap\ResponseInterface;

/**
 * AdminCreateWaitSetResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class AdminCreateWaitSetResponse implements ResponseInterface
{
    /**
     * WaitSet ID
     * @Accessor(getter="getWaitSetId", setter="setWaitSetId")
     * @SerializedName("waitSet")
     * @Type("string")
     * @XmlAttribute
     */
    private $waitSetId;

    /**
     * Default interest types: comma-separated list
     * @Accessor(getter="getDefaultInterests", setter="setDefaultInterests")
     * @SerializedName("defTypes")
     * @Type("string")
     * @XmlAttribute
     */
    private $defaultInterests;

    /**
     * sequence
     * @Accessor(getter="getSequence", setter="setSequence")
     * @SerializedName("seq")
     * @Type("int")
     * @XmlAttribute
     */
    private $sequence;

    /**
     * Error information
     * @Accessor(getter="getErrors", setter="setErrors")
     * @SerializedName("error")
     * @Type("array<Zimbra\Common\Struct\IdAndType>")
     * @XmlList(inline = true, entry = "error")
     */
    private $errors = [];

    /**
     * Constructor method for AdminCreateWaitSetResponse
     * 
     * @param string $waitSetId
     * @param string $defaultInterests
     * @param int $sequence
     * @param array   $errors
     * @return self
     */
    public function __construct(
    	string $waitSetId,
        string $defaultInterests,
        int $sequence,
        array $errors = [])
    {
        $this->setWaitSetId($waitSetId)
        	 ->setDefaultInterests($defaultInterests)
        	 ->setSequence($sequence)
        	 ->setErrors($errors);
    }

    /**
     * Gets WaitSet ID
     *
     * @return string
     */
    public function getWaitSetId(): string
    {
        return $this->waitSetId;
    }

    /**
     * Sets WaitSet ID
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
    public function getDefaultInterests(): string
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
        $this->defaultInterests = $defaultInterests;
        return $this;
    }

    /**
     * Gets sequence
     *
     * @return int
     */
    public function getSequence(): int
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

    /**
     * Add error information
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
     * Sets error information
     *
     * @param array $errors
     * @return self
     */
    public function setErrors(array $errors): self
    {
        $this->errors = array_filter($errors, static fn($error) => $error instanceof IdAndType);
        return $this;
    }

    /**
     * Gets error information
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
