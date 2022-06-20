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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * ImportStatusInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
abstract class ImportStatusInfo
{
    /**
     * Data source ID
     * 
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Whether data is currently being imported from this data source
     * 
     * @Accessor(getter="getRunning", setter="setRunning")
     * @SerializedName("isRunning")
     * @Type("bool")
     * @XmlAttribute
     */
    private $running;

    /**
     * Whether the last import completed successfully.
     * (not returned if the import has not run yet)
     * 
     * @Accessor(getter="getSuccess", setter="setSuccess")
     * @SerializedName("success")
     * @Type("bool")
     * @XmlAttribute
     */
    private $success;

    /**
     * If the last import failed, this is the error message that was returned.
     * (not returned if the import has not run yet)
     * 
     * @Accessor(getter="getError", setter="setError")
     * @SerializedName("error")
     * @Type("string")
     * @XmlAttribute
     */
    private $error;

    /**
     * Constructor mothod
     *
     * @param string $id
     * @param bool $running
     * @param bool $success
     * @param string $error
     * @return self
     */
    public function __construct(
        ?string $id = NULL,
        ?bool $running = NULL,
        ?bool $success = NULL,
        ?string $error = NULL
    )
    {
        if (NULL !== $id) {
            $this->setId($id);
        }
        if (NULL !== $running) {
            $this->setRunning($running);
        }
        if (NULL !== $success) {
            $this->setSuccess($success);
        }
        if (NULL !== $error) {
            $this->setError($error);
        }
    }

    /**
     * Gets the id
     *
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Sets the id
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
     * Gets the running
     *
     * @return bool
     */
    public function getRunning(): ?bool
    {
        return $this->running;
    }

    /**
     * Sets the running
     *
     * @param  bool $running
     * @return self
     */
    public function setRunning(bool $running): self
    {
        $this->running = $running;
        return $this;
    }

    /**
     * Gets the success
     *
     * @return bool
     */
    public function getSuccess(): ?bool
    {
        return $this->success;
    }

    /**
     * Sets the success
     *
     * @param  bool $success
     * @return self
     */
    public function setSuccess(bool $success): self
    {
        $this->success = $success;
        return $this;
    }

    /**
     * Gets error
     *
     * @return string
     */
    public function getError(): ?string
    {
        return $this->error;
    }

    /**
     * Sets error
     *
     * @param  string $error
     * @return self
     */
    public function setError(string $error): self
    {
        $this->error = $error;
        return $this;
    }
}
