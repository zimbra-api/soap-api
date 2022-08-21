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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Mail\Struct\TagInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * CreateTagResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CreateTagResponse extends SoapResponse
{
    /**
     * Information about the newly created tag
     * 
     * @Accessor(getter="getTag", setter="setTag")
     * @SerializedName("tag")
     * @Type("Zimbra\Mail\Struct\TagInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var TagInfo
     */
    #[Accessor(getter: "getTag", setter: "setTag")]
    #[SerializedName('tag')]
    #[Type(TagInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private ?TagInfo $tag;

    /**
     * Constructor
     *
     * @param  TagInfo $tag
     * @return self
     */
    public function __construct(?TagInfo $tag = NULL)
    {
        $this->tag = $tag;
    }

    /**
     * Get tag point
     *
     * @return TagInfo
     */
    public function getTag(): ?TagInfo
    {
        return $this->tag;
    }

    /**
     * Set tag point
     *
     * @param  TagInfo $tag
     * @return self
     */
    public function setTag(TagInfo $tag): self
    {
        $this->tag = $tag;
        return $this;
    }
}
