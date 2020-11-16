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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlList, XmlRoot};

/**
 * AccountSessionInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="info")
 */
class AccountSessionInfo
{
    /**
     * Account name
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Account ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Information on sessions
     * @Accessor(getter="getSessions", setter="setSessions")
     * @SerializedName("s")
     * @Type("array<Zimbra\Admin\Struct\SessionInfo>")
     * @XmlList(inline = true, entry = "s")
     */
    private $sessions;

    /**
     * Constructor method for AccountSessionInfo
     * 
     * @param  string $name
     * @param  string $id
     * @param  array  $sessions
     * @return self
     */
    public function __construct($name, $id, array $sessions = [])
    {
        $this->setName($name)
             ->setId($id)
             ->setSessions($sessions);
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
    public function setName($name): self
    {
        $this->name = trim($name);
        return $this;
    }

    /**
     * Gets ID
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Sets ID
     *
     * @param  string $id
     * @return self
     */
    public function setId($id): self
    {
        $this->id = trim($id);
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
     * Sets sessions
     *
     * @param array $sessions
     * @return self
     */
    public function setSessions(array $sessions): self
    {
        $this->sessions = [];
        foreach ($sessions as $session) {
            if ($session instanceof SessionInfo) {
                $this->sessions[] = $session;
            }
        }
        return $this;
    }

    /**
     * Gets sessions
     *
     * @return array
     */
    public function getSessions(): array
    {
        return $this->sessions;
    }
}
