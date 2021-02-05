<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};
use Zimbra\Enum\ZimletPresence;
use Zimbra\Struct\ZimletContextInterface;

/**
 * AccountZimletContext class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="zimletContext")
 */
class AccountZimletContext implements ZimletContextInterface
{
    /**
     * Zimlet Base URL
     * @Accessor(getter="getZimletBaseUrl", setter="setZimletBaseUrl")
     * @SerializedName("baseUrl")
     * @Type("string")
     * @XmlAttribute
     */
    private $zimletBaseUrl;

    /**
     * Zimlet Priority
     * @Accessor(getter="getZimletPriority", setter="setZimletPriority")
     * @SerializedName("priority")
     * @Type("int")
     * @XmlAttribute
     */
    private $zimletPriority;

    /**
     * Zimlet presence
     * Valid values: mandatory | enabled | disabled
     * @Accessor(getter="getZimletPresence", setter="setZimletPresence")
     * @SerializedName("presence")
     * @Type("Zimbra\Enum\ZimletPresence")
     * @XmlAttribute
     */
    private $zimletPresence;

    /**
     * Constructor method for AccountZimletContext
     * @param string $baseUrl
     * @param ZimletPresence $presence
     * @param int $priority
     * @return self
     */
    public function __construct(
        string $baseUrl,
        ZimletPresence $presence,
        ?int $priority = NULL
    )
    {
        $this->setZimletBaseUrl($baseUrl)
             ->setZimletPresence($presence);
        if (NULL !== $priority) {
            $this->setZimletPriority($priority);
        }
    }

    /**
     * Gets zimlet base url
     *
     * @return string
     */
    public function getZimletBaseUrl(): string
    {
        return $this->zimletBaseUrl;
    }

    /**
     * Sets zimlet base url
     *
     * @param  string $baseUrl
     * @return self
     */
    public function setZimletBaseUrl(string $baseUrl): self
    {
        $this->zimletBaseUrl = $baseUrl;
        return $this;
    }

    /**
     * Gets zimlet priority
     *
     * @return int
     */
    public function getZimletPriority(): ?int
    {
        return $this->zimletPriority;
    }

    /**
     * Sets zimlet priority
     *
     * @param  int $priority
     * @return self
     */
    public function setZimletPriority(int $priority): self
    {
        $this->zimletPriority = $priority;
        return $this;
    }

    /**
     * Gets zimlet presence
     *
     * @return ZimletPresence
     */
    public function getZimletPresence(): ZimletPresence
    {
        return $this->zimletPresence;
    }

    /**
     * Sets zimlet presence
     *
     * @param  ZimletPresence $presence
     * @return self
     */
    public function setZimletPresence(ZimletPresence $presence): self
    {
        $this->zimletPresence = $presence;
        return $this;
    }
}