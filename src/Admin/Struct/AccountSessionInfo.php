<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};

/**
 * AccountSessionInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AccountSessionInfo
{
    /**
     * Account name
     * 
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Account ID
     * 
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Information on sessions
     * 
     * @Accessor(getter="getSessions", setter="setSessions")
     * @Type("array<Zimbra\Admin\Struct\SessionInfo>")
     * @XmlList(inline=true, entry="s", namespace="urn:zimbraAdmin")
     */
    private $sessions = [];

    /**
     * Constructor
     * 
     * @param  string $name
     * @param  string $id
     * @param  array  $sessions
     * @return self
     */
    public function __construct(
        string $name = '', string $id = '', array $sessions = []
    )
    {
        $this->setName($name)
             ->setId($id)
             ->setSessions($sessions);
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set name
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
     * Get ID
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set ID
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
     * Add session
     *
     * @param  SessionInfo $session
     * @return self
     */
    public function addSession(SessionInfo $session): self
    {
        $this->sessions[] = $session;
        return $this;
    }

    /**
     * Set sessions
     *
     * @param array $sessions
     * @return self
     */
    public function setSessions(array $sessions): self
    {
        $this->sessions = array_filter($sessions, static fn ($session) => $session instanceof SessionInfo);
        return $this;
    }

    /**
     * Get sessions
     *
     * @return array
     */
    public function getSessions(): array
    {
        return $this->sessions;
    }
}
