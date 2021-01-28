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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlRoot};

/**
 * InvitationInfo class
 * Invitation Component
 *
 * @package   Zimbra
 * @subpackage Mail
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="inv")
 */
class InvitationInfo  extends InviteComponent
{
    /**
     * ID
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Content-Type
     * @Accessor(getter="getValue", setter="setValue")
     * @SerializedName("ct")
     * @Type("string")
     * @XmlAttribute
     */
    private $contentType;

    /**
     * Content-Id
     * @Accessor(getter="getValue", setter="setValue")
     * @SerializedName("ci")
     * @Type("string")
     * @XmlAttribute
     */
    private $contentId;

    /**
     * Content
     * @Accessor(getter="getValue", setter="setValue")
     * @SerializedName("content")
     * @Type("Zimbra\Mail\Struct\RawInvite")
     * @XmlElement
     */
    private $content;

    /**
     * Constructor method for InvitationInfo
     *
     * @param  string $name
     * @param  string $value
     * @return self
     */
    public function __construct(string $name, string $value)
    {
        $this->setName($name)
             ->setValue($value);
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets value
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Sets value
     *
     * @param  string $value
     * @return self
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }
}
