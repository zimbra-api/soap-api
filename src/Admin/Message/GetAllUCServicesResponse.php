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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Admin\Struct\UCServiceInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetAllUCServicesResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAllUCServicesResponse extends SoapResponse
{
    /**
     * Information about uc services
     *
     * @var array
     */
    #[Accessor(getter: "getUCServiceList", setter: "setUCServiceList")]
    #[Type("array<Zimbra\Admin\Struct\UCServiceInfo>")]
    #[XmlList(inline: true, entry: "ucservice", namespace: "urn:zimbraAdmin")]
    private $ucServiceList = [];

    /**
     * Constructor
     *
     * @param array $ucServiceList
     * @return self
     */
    public function __construct(array $ucServiceList = [])
    {
        $this->setUCServiceList($ucServiceList);
    }

    /**
     * Set ucServiceList
     *
     * @param  array $list
     * @return self
     */
    public function setUCServiceList(array $list): self
    {
        $this->ucServiceList = array_filter(
            $list,
            static fn($item) => $item instanceof UCServiceInfo
        );
        return $this;
    }

    /**
     * Get ucServiceList
     *
     * @return array
     */
    public function getUCServiceList(): array
    {
        return $this->ucServiceList;
    }
}
