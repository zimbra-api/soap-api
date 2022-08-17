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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
abstract class ImportStatusInfo
{
    /**
     * Data source ID
     * 
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName(name: 'id')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $id;

    /**
     * Whether data is currently being imported from this data source
     * 
     * @var bool
     */
    #[Accessor(getter: 'getRunning', setter: 'setRunning')]
    #[SerializedName(name: 'isRunning')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $running;

    /**
     * Whether the last import completed successfully.
     * (not returned if the import has not run yet)
     * 
     * @var bool
     */
    #[Accessor(getter: 'getSuccess', setter: 'setSuccess')]
    #[SerializedName(name: 'success')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $success;

    /**
     * If the last import failed, this is the error message that was returned.
     * (not returned if the import has not run yet)
     * 
     * @var string
     */
    #[Accessor(getter: 'getError', setter: 'setError')]
    #[SerializedName(name: 'error')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $error;

    /**
     * Constructor
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
     * Get the id
     *
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Set the id
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
     * Get the running
     *
     * @return bool
     */
    public function getRunning(): ?bool
    {
        return $this->running;
    }

    /**
     * Set the running
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
     * Get the success
     *
     * @return bool
     */
    public function getSuccess(): ?bool
    {
        return $this->success;
    }

    /**
     * Set the success
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
     * Get error
     *
     * @return string
     */
    public function getError(): ?string
    {
        return $this->error;
    }

    /**
     * Set error
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
