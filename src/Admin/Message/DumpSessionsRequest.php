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
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * DumpSessionsRequest class
 * Dump sessions
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DumpSessionsRequest extends SoapRequest
{
    /**
     * List Sessions flag
     *
     * @var bool
     */
    #[Accessor(getter: "getIncludeAccounts", setter: "setIncludeAccounts")]
    #[SerializedName("listSessions")]
    #[Type("bool")]
    #[XmlAttribute]
    private $includeAccounts;

    /**
     * Group by account flag
     *
     * @var bool
     */
    #[Accessor(getter: "getGroupByAccount", setter: "setGroupByAccount")]
    #[SerializedName("groupByAccount")]
    #[Type("bool")]
    #[XmlAttribute]
    private $groupByAccount;

    /**
     * Constructor
     *
     * @param  bool $includeAccounts
     * @param  bool $groupByAccount
     * @return self
     */
    public function __construct(
        ?bool $includeAccounts = null,
        ?bool $groupByAccount = null
    ) {
        if (null !== $includeAccounts) {
            $this->setIncludeAccounts($includeAccounts);
        }
        if (null !== $groupByAccount) {
            $this->setGroupByAccount($groupByAccount);
        }
    }

    /**
     * Get includeAccounts
     *
     * @return bool
     */
    public function getIncludeAccounts(): ?bool
    {
        return $this->includeAccounts;
    }

    /**
     * Set includeAccounts
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
     * Get groupByAccount
     *
     * @return bool
     */
    public function getGroupByAccount(): ?bool
    {
        return $this->groupByAccount;
    }

    /**
     * Set groupByAccount
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new DumpSessionsEnvelope(new DumpSessionsBody($this));
    }
}
