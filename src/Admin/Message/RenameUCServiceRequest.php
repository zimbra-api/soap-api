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
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * RenameUCServiceRequest class
 * Rename Unified Communication Service
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class RenameUCServiceRequest extends Request
{
    /**
     * Zimbra ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $id;

    /**
     * new COS name
     * @Accessor(getter="getNewName", setter="setNewName")
     * @SerializedName("newName")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $newName;

    /**
     * Constructor method for RenameUCServiceRequest
     * 
     * @param string $id
     * @param string $newName
     * @return self
     */
    public function __construct(string $id, string $newName)
    {
        $this->setId($id)
             ->setNewName($newName);
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Sets id
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
     * Gets newName
     *
     * @return string
     */
    public function getNewName(): ?string
    {
        return $this->newName;
    }

    /**
     * Sets newName
     *
     * @param  string $newName
     * @return self
     */
    public function setNewName(string $newName): self
    {
        $this->newName = $newName;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new RenameUCServiceEnvelope(
            new RenameUCServiceBody($this)
        );
    }
}
