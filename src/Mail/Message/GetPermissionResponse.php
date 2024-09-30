<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Mail\Struct\AccountACEinfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetPermissionResponse class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetPermissionResponse extends SoapResponse
{
    /**
     * Account ACE information
     *
     * @Accessor(getter="getAces", setter="setAces")
     * @Type("array<Zimbra\Mail\Struct\AccountACEinfo>")
     * @XmlList(inline=true, entry="ace", namespace="urn:zimbraMail")
     *
     * @var array
     */
    #[Accessor(getter: "getAces", setter: "setAces")]
    #[Type("array<Zimbra\Mail\Struct\AccountACEinfo>")]
    #[XmlList(inline: true, entry: "ace", namespace: "urn:zimbraMail")]
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
            static fn($ace) => $ace instanceof AccountACEinfo
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
