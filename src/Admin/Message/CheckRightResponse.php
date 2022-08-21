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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};
use Zimbra\Admin\Struct\RightViaInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * CheckRightResponse class
 * Auto-provision an via
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CheckRightResponse extends SoapResponse
{
    /**
     * Result of the CheckRightRequest
     * 
     * @Accessor(getter="getAllow", setter="setAllow")
     * @SerializedName("allow")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'getAllow', setter: 'setAllow')]
    #[SerializedName('allow')]
    #[Type('bool')]
    #[XmlAttribute]
    private $allow;

    /**
     * Via information for the grant that decisively lead to the result
     * 
     * @Accessor(getter="getVia", setter="setVia")
     * @SerializedName("via")
     * @Type("Zimbra\Admin\Struct\RightViaInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * 
     * @var RightViaInfo
     */
    #[Accessor(getter: 'getVia', setter: 'setVia')]
    #[SerializedName('via')]
    #[Type(RightViaInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private ?RightViaInfo $via;

    /**
     * Constructor
     *
     * @param bool $allow
     * @param RightViaInfo $via
     * @return self
     */
    public function __construct(bool $allow = FALSE, ?RightViaInfo $via = NULL)
    {
        $this->setAllow($allow);
        $this->via = $via;
    }

    /**
     * Get allow
     *
     * @return bool
     */
    public function getAllow(): bool
    {
        return $this->allow;
    }

    /**
     * Set allow
     *
     * @param  bool $allow
     * @return self
     */
    public function setAllow(bool $allow): self
    {
        $this->allow = $allow;
        return $this;
    }

    /**
     * Get the via.
     *
     * @return RightViaInfo
     */
    public function getVia(): ?RightViaInfo
    {
        return $this->via;
    }

    /**
     * Set the via.
     *
     * @param  RightViaInfo $via
     * @return self
     */
    public function setVia(RightViaInfo $via): self
    {
        $this->via = $via;
        return $this;
    }
}
