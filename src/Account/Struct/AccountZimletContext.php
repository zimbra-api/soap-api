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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Enum\ZimletPresence;
use Zimbra\Common\Struct\ZimletContextInterface;

/**
 * AccountZimletContext class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AccountZimletContext implements ZimletContextInterface
{
    /**
     * Zimlet Base URL
     *
     * @var string
     */
    #[Accessor(getter: "getZimletBaseUrl", setter: "setZimletBaseUrl")]
    #[SerializedName("baseUrl")]
    #[Type("string")]
    #[XmlAttribute]
    private string $zimletBaseUrl;

    /**
     * Zimlet priority
     *
     * @var int
     */
    #[Accessor(getter: "getZimletPriority", setter: "setZimletPriority")]
    #[SerializedName("priority")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $zimletPriority = null;

    /**
     * Zimlet presence
     * Valid values: mandatory | enabled | disabled
     *
     * @var ZimletPresence
     */
    #[Accessor(getter: "getZimletPresence", setter: "setZimletPresence")]
    #[SerializedName("presence")]
    #[XmlAttribute]
    private ZimletPresence $zimletPresence;

    /**
     * Constructor
     *
     * @param string $baseUrl
     * @param ZimletPresence $presence
     * @param int $priority
     * @return self
     */
    public function __construct(
        string $baseUrl = "",
        ?ZimletPresence $presence = null,
        ?int $priority = null
    ) {
        $this->setZimletBaseUrl($baseUrl)->setZimletPresence(
            $presence ?? ZimletPresence::ENABLED
        );
        if (null !== $priority) {
            $this->setZimletPriority($priority);
        }
    }

    /**
     * Get zimlet base url
     *
     * @return string
     */
    public function getZimletBaseUrl(): string
    {
        return $this->zimletBaseUrl;
    }

    /**
     * Set zimlet base url
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
     * Get zimlet priority
     *
     * @return int
     */
    public function getZimletPriority(): ?int
    {
        return $this->zimletPriority;
    }

    /**
     * Set zimlet priority
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
     * Get zimlet presence
     *
     * @return ZimletPresence
     */
    public function getZimletPresence(): ZimletPresence
    {
        return $this->zimletPresence;
    }

    /**
     * Set zimlet presence
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
