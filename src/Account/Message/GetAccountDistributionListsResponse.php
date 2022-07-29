<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Message;

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Account\Struct\DLInfo;
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * GetAccountDistributionListsResponse class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetAccountDistributionListsResponse implements SoapResponseInterface
{
    /**
     * Information on distribution lists
     * @Accessor(getter="getDlList", setter="setDlList")
     * @Type("array<Zimbra\Account\Struct\DLInfo>")
     * @XmlList(inline=true, entry="dl", namespace="urn:zimbraAccount")
     */
    private $dlList = [];

    /**
     * Constructor method for GetAccountDistributionListsResponse
     * 
     * @param  array $dlList
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
     * Set dlList
     *
     * @param  array $dlList
     * @return self
     */
    public function setDlList(array $dlList): self
    {
        $this->dlList = array_filter($dlList, static fn ($dl) => $dl instanceof DLInfo);
        return $this;
    }

    /**
     * Get dlList
     *
     * @return array
     */
    public function getDlList(): array
    {
        return $this->dlList;
    }
}
