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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Soap\{EnvelopeInterface, Request};

/**
 * DumpSessionsRequest class
 * Dump sessions
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class DumpSessionsRequest extends Request
{
    /**
     * List Sessions flag
     * @Accessor(getter="getIncludeAccounts", setter="setIncludeAccounts")
     * @SerializedName("listSessions")
     * @Type("bool")
     * @XmlAttribute
     */
    private $includeAccounts;

    /**
     * Group by account flag
     * @Accessor(getter="getGroupByAccount", setter="setGroupByAccount")
     * @SerializedName("groupByAccount")
     * @Type("bool")
     * @XmlAttribute
     */
    private $groupByAccount;

    /**
     * Constructor method for DumpSessionsRequest
     * 
     * @param  bool $includeAccounts
     * @param  bool $groupByAccount
     * @return self
     */
    public function __construct(?bool $includeAccounts = NULL, ?bool $groupByAccount = NULL)
    {
        if (NULL !== $includeAccounts) {
            $this->setIncludeAccounts($includeAccounts);
        }
        if (NULL !== $groupByAccount) {
            $this->setGroupByAccount($groupByAccount);
        }
    }

    /**
     * Gets includeAccounts
     *
     * @return bool
     */
    public function getIncludeAccounts(): ?bool
    {
        return $this->includeAccounts;
    }

    /**
     * Sets includeAccounts
     *
     * @param  bool $includeAccounts
     * @return self
     */
    public function setIncludeAccounts(bool $includeAccounts): self
    {
        $this->includeAccounts = $includeAccounts;
        return $this;
    }

    /**
     * Gets groupByAccount
     *
     * @return bool
     */
    public function getGroupByAccount(): ?bool
    {
        return $this->groupByAccount;
    }

    /**
     * Sets groupByAccount
     *
     * @param  bool $groupByAccount
     * @return self
     */
    public function setGroupByAccount(bool $groupByAccount): self
    {
        $this->groupByAccount = $groupByAccount;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new DumpSessionsEnvelope(
            new DumpSessionsBody($this)
        );
    }
}
