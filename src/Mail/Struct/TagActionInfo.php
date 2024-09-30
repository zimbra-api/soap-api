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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
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
     *
     * @var string
     */
    #[Accessor(getter: "getSuccesses", setter: "setSuccesses")]
    #[SerializedName("id")]
    #[Type("string")]
    #[XmlAttribute]
    private $successes;

    /**
     * Operations of tags affected by successfully applied operation
     * Only present if "tn" was specified in the request
     *
     * @Accessor(getter="getSuccessNames", setter="setSuccessNames")
     * @SerializedName("tn")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getSuccessNames", setter: "setSuccessNames")]
    #[SerializedName("tn")]
    #[Type("string")]
    #[XmlAttribute]
    private $successNames;

    /**
     * Operation - "read|!read|color|delete|rename|update|retentionpolicy"
     *
     * @Accessor(getter="getOperation", setter="setOperation")
     * @SerializedName("op")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getOperation", setter: "setOperation")]
    #[SerializedName("op")]
    #[Type("string")]
    #[XmlAttribute]
    private $operation;

    /**
     * Constructor
     *
     * @param string $successes
     * @param string $successNames
     * @param string $operation
     * @return self
     */
    public function __construct(
        string $successes = "",
        ?string $successNames = null,
        ?string $operation = null
    ) {
        $this->setSuccesses($successes);
        if (null !== $successNames) {
            $this->setSuccessNames($successNames);
        }
        if (null !== $operation) {
            $this->setOperation($operation);
        }
    }

    /**
     * Get successNames
     *
     * @return string
     */
    public function getSuccessNames(): ?string
    {
        return $this->successNames;
    }

    /**
     * Set successNames
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
     * Get successes
     *
     * @return string
     */
    public function getSuccesses(): string
    {
        return $this->successes;
    }

    /**
     * Set successes
     *
     * @param  string $successes
     * @return self
     */
    public function setSuccesses(string $successes): self
    {
        $this->successes = $successes;
        return $this;
    }

    /**
     * Get the operation
     *
     * @return string
     */
    public function getOperation(): ?string
    {
        return $this->operation;
    }

    /**
     * Set the operation
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
