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
 * InfoForSessionType struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class InfoForSessionType
{
    /**
     * Count of number of active accounts
     * 
     * @var int
     */
    #[Accessor(getter: 'getActiveAccounts', setter: 'setActiveAccounts')]
    #[SerializedName('activeAccounts')]
    #[Type('int')]
    #[XmlAttribute]
    private $activeAccounts;

    /**
     * Count of number of active sessions
     * 
     * @var int
     */
    #[Accessor(getter: 'getActiveSessions', setter: 'setActiveSessions')]
    #[SerializedName('activeSessions')]
    #[Type('int')]
    #[XmlAttribute]
    private $activeSessions;

    /**
     * If the request selected "groupByAccount" and "listSessions" then
     * the session information will be grouped under here.
     * 
     * @var array
     */
    #[Accessor(getter: 'getAccounts', setter: 'setAccounts')]
    #[Type('array<Zimbra\Admin\Struct\AccountSessionInfo>')]
    #[XmlList(inline: true, entry: 'zid', namespace: 'urn:zimbraAdmin')]
    private $accounts = [];

    /**
     * If the request selected "listSessions" but NOT "groupByAccount" then
     * the session information will be under here.
     * 
     * @var array
     */
    #[Accessor(getter: 'getSessions', setter: 'setSessions')]
    #[Type('array<Zimbra\Admin\Struct\SessionInfo>')]
    #[XmlList(inline: true, entry: 's', namespace: 'urn:zimbraAdmin')]
    private $sessions = [];

    /**
     * Constructor
     * 
     * @param  int $activeSessions
     * @param  int $activeAccounts
     * @param  array $accounts
     * @param  array $sessions
     * @return self
     */
    public function __construct(
        int $activeSessions = 0, ?int $activeAccounts = NULL, array $accounts = [], array $sessions = []
    )
    {
        $this->setActiveSessions($activeSessions)
             ->setAccounts($accounts)
             ->setSessions($sessions);
        if (NULL !== $activeAccounts) {
            $this->setActiveAccounts($activeAccounts);
        }
    }

    /**
     * Get activeAccounts
     *
     * @return int
     */
    public function getActiveAccounts(): ?int
    {
        return $this->activeAccounts;
    }

    /**
     * Set activeAccounts
     *
     * @param  int $activeAccounts
     * @return self
     */
    public function setActiveAccounts(int $activeAccounts): self
    {
        $this->activeAccounts = $activeAccounts;
        return $this;
    }

    /**
     * Get activeSessions
     *
     * @return int
     */
    public function getActiveSessions(): int
    {
        return $this->activeSessions;
    }

    /**
     * Set activeSessions
     *
     * @param  int $activeSessions
     * @return self
     */
    public function setActiveSessions(int $activeSessions): self
    {
        $this->activeSessions = $activeSessions;
        return $this;
    }

    /**
     * Set accounts
     *
     * @param array $accounts
     * @return self
     */
    public function setAccounts(array $accounts): self
    {
        $this->accounts = array_filter(
            $accounts, static fn ($account) => $account instanceof AccountSessionInfo
        );
        return $this;
    }

    /**
     * Get accounts
     *
     * @return array
     */
    public function getAccounts(): array
    {
        return $this->accounts;
    }

    /**
     * Set sessions
     *
     * @param array $sessions
     * @return self
     */
    public function setSessions(array $sessions): self
    {
        $this->sessions = array_filter(
            $sessions, static fn ($session) => $session instanceof SessionInfo
        );
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
