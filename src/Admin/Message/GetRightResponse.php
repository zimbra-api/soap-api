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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Admin\Struct\RightInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetRightResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetRightResponse extends SoapResponse
{
    /**
     * Right information
     *
     * @Accessor(getter="getRight", setter="setRight")
     * @SerializedName("right")
     * @Type("Zimbra\Admin\Struct\RightInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var RightInfo
     */
    #[Accessor(getter: "getRight", setter: "setRight")]
    #[SerializedName("right")]
    #[Type(RightInfo::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?RightInfo $right;

    /**
     * Constructor
     *
     * @param RightInfo $right
     * @return self
     */
    public function __construct(?RightInfo $right = null)
    {
        $this->right = $right;
    }

    /**
     * Get the right.
     *
     * @return RightInfo
     */
    public function getRight(): ?RightInfo
    {
        return $this->right;
    }

    /**
     * Set the right.
     *
     * @param  RightInfo $right
     * @return self
     */
    public function setRight(RightInfo $right): self
    {
        $this->right = $right;
        return $this;
    }
}
