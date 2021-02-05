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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlList, XmlRoot};
use Zimbra\Admin\Struct\DLInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * GetAccountMembershipResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="GetAccountMembershipResponse")
 */
class GetAccountMembershipResponse implements ResponseInterface
{
    /**
     * List membership information
     * @Accessor(getter="getDlList", setter="setDlList")
     * @SerializedName("dl")
     * @Type("array<Zimbra\Admin\Struct\DLInfo>")
     * @XmlList(inline = true, entry = "dl")
     */
    private $dlList;

    /**
     * Constructor method for GetAccountMembershipResponse
     *
     * @param array $dlList
     * @return self
     */
    public function __construct(array $dlList = [])
    {
        $this->setDlList($dlList);
    }

    /**
     * Add a dl
     *
     * @param  DLInfo $dl
     * @return self
     */
    public function addDl(DLInfo $dl): self
    {
        $this->dlList[] = $dl;
        return $this;
    }

    /**
     * Sets dlList
     *
     * @param array $dlList
     * @return self
     */
    public function setDlList(array $dlList): self
    {
        $this->dlList = [];
        foreach ($dlList as $dl) {
            if ($dl instanceof DLInfo) {
                $this->dlList[] = $dl;
            }
        }
        return $this;
    }

    /**
     * Gets dlList
     *
     * @return array
     */
    public function getDlList(): ?array
    {
        return $this->dlList;
    }
}