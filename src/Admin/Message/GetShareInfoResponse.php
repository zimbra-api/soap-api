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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};
use Zimbra\Struct\ShareInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * GetShareInfoResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetShareInfoResponse implements ResponseInterface
{
    /**
     * Share information
     * @Accessor(getter="getShares", setter="setShares")
     * @SerializedName("share")
     * @Type("array<Zimbra\Struct\ShareInfo>")
     * @XmlList(inline = true, entry = "share")
     */
    private $shares;

    /**
     * Constructor method for GetShareInfoResponse
     * 
     * @param array $shares
     * @return self
     */
    public function __construct(array $shares = [])
    {
        $this->setShares($shares);
    }

    /**
     * Add share information
     *
     * @param  ShareInfo $share
     * @return self
     */
    public function addShare(ShareInfo $share): self
    {
        $this->shares[] = $share;
        return $this;
    }

    /**
     * Sets share information
     *
     * @param array $shares
     * @return self
     */
    public function setShares(array $shares): self
    {
        $this->shares = [];
        foreach ($shares as $share) {
            if ($share instanceof ShareInfo) {
                $this->shares[] = $share;
            }
        }
        return $this;
    }

    /**
     * Gets share information
     *
     * @return array
     */
    public function getShares(): array
    {
        return $this->shares;
    }
}
