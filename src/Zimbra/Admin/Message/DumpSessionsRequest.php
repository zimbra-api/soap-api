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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};
use Zimbra\Admin\Struct\AttachmentIdAttrib;
use Zimbra\Soap\Request;

/**
 * DumpSessionsRequest class
 * Deploy Zimlet(s)
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="DumpSessionsRequest")
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
     * @param  bool $includeAccounts
     * @param  bool $groupByAccount
     * @return self
     */
    public function __construct($includeAccounts = NULL, $groupByAccount = NULL)
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
    public function setIncludeAccounts($includeAccounts): self
    {
        $this->includeAccounts = (bool) $includeAccounts;
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
    public function setGroupByAccount($groupByAccount): self
    {
        $this->groupByAccount = (bool) $groupByAccount;
        return $this;
    }

    protected function internalInit()
    {
        $this->envelope = new DumpSessionsEnvelope(
            NULL,
            new DumpSessionsBody($this)
        );
    }
}
