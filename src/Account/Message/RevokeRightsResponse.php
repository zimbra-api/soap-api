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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlList, XmlRoot};
use Zimbra\Account\Struct\AccountACEInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * RevokeRightsResponse class
 * Returns rights that are successfully revoked
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="RevokeRightsResponse")
 */
class RevokeRightsResponse implements ResponseInterface
{
    /**
     * Access Control Entries
     * @Accessor(getter="getAces", setter="setAces")
     * @SerializedName("ace")
     * @Type("array<Zimbra\Account\Struct\AccountACEInfo>")
     * @XmlList(inline = true, entry = "ace")
     */
    private $aces;

    /**
     * Constructor method for RevokeRightsResponse
     * 
     * @param  array $aces
     * @return self
     */
    public function __construct(array $aces = [])
    {
        $this->setAces($aces);
    }

    /**
     * Add a ace
     *
     * @param  AccountACEInfo $ace
     * @return self
     */
    public function addAce(AccountACEInfo $ace): self
    {
        $this->aces[] = $ace;
        return $this;
    }

    /**
     * Set aces
     *
     * @param  array $aces
     * @return self
     */
    public function setAces(array $aces): self
    {
        $this->aces = [];
        foreach ($aces as $ace) {
            if ($ace instanceof AccountACEInfo) {
                $this->aces[] = $ace;
            }
        }
        return $this;
    }

    /**
     * Gets aces
     *
     * @return array
     */
    public function getAces(): array
    {
        return $this->aces;
    }
}