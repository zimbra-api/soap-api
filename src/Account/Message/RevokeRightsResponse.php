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
use Zimbra\Account\Struct\AccountACEInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * RevokeRightsResponse class
 * Returns rights that are successfully revoked
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class RevokeRightsResponse extends SoapResponse
{
    /**
     * Access Control Entries
     *
     * @Accessor(getter="getAces", setter="setAces")
     * @Type("array<Zimbra\Account\Struct\AccountACEInfo>")
     * @XmlList(inline=true, entry="ace", namespace="urn:zimbraAccount")
     *
     * @var array
     */
    #[Accessor(getter: "getAces", setter: "setAces")]
    #[Type("array<Zimbra\Account\Struct\AccountACEInfo>")]
    #[XmlList(inline: true, entry: "ace", namespace: "urn:zimbraAccount")]
    private $aces = [];

    /**
     * Constructor
     *
     * @param  array $aces
     * @return self
     */
    public function __construct(array $aces = [])
    {
        $this->setAces($aces);
    }

    /**
     * Set aces
     *
     * @param  array $aces
     * @return self
     */
    public function setAces(array $aces): self
    {
        $this->aces = array_filter(
            $aces,
            static fn($ace) => $ace instanceof AccountACEInfo
        );
        return $this;
    }

    /**
     * Get aces
     *
     * @return array
     */
    public function getAces(): array
    {
        return $this->aces;
    }
}
