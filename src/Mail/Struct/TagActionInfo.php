<?php declare(strict_types=1);
/**
 * This file is version of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * TagActionInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class TagActionInfo
{
    /**
     * Tag IDs for successfully applied operation
     * 
     * @Accessor(getter="getSuccesses", setter="setSuccesses")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $successes;

    /**
     * Operations of tags affected by successfully applied operation
     * Only present if "tn" was specified in the request
     * 
     * @Accessor(getter="getSuccessNames", setter="setSuccessNames")
     * @SerializedName("tn")
     * @Type("string")
     * @XmlAttribute
     */
    private $successNames;

    /**
     * Operation - "read|!read|color|delete|rename|update|retentionpolicy"
     * 
     * @Accessor(getter="getOperation", setter="setOperation")
     * @SerializedName("op")
     * @Type("string")
     * @XmlAttribute
     */
    private $operation;

    /**
     * Constructor method
     * 
     * @param string $successes
     * @param string $successNames
     * @param string $operation
     * @return self
     */
    public function __construct(
        string $successes = '',
        ?string $successNames = NULL,
        ?string $operation = NULL
    )
    {
        $this->setSuccesses($successes);
        if (NULL !== $successNames) {
            $this->setSuccessNames($successNames);
        }
        if (NULL !== $operation) {
            $this->setOperation($operation);
        }
    }

    /**
     * Gets successNames
     *
     * @return string
     */
    public function getSuccessNames(): ?string
    {
        return $this->successNames;
    }

    /**
     * Sets successNames
     *
     * @param  string $successNames
     * @return self
     */
    public function setSuccessNames(string $successNames): self
    {
        $this->successNames = $successNames;
        return $this;
    }

    /**
     * Gets ID
     *
     * @return string
     */
    public function getSuccesses(): string
    {
        return $this->successes;
    }

    /**
     * Sets ID
     *
     * @param  string $id
     * @return self
     */
    public function setSuccesses(string $successes): self
    {
        $this->successes = $successes;
        return $this;
    }

    /**
     * Gets the operation
     *
     * @return string
     */
    public function getOperation(): ?string
    {
        return $this->operation;
    }

    /**
     * Sets the operation
     *
     * @param  string $operation
     * @return self
     */
    public function setOperation(string $operation): self
    {
        $this->operation = $operation;
        return $this;
    }
}