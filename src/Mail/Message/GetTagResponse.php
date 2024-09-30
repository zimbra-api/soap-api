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
use Zimbra\Mail\Struct\TagInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetTagResponse class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetTagResponse extends SoapResponse
{
    /**
     * Information about tags
     *
     * @Accessor(getter="getTags", setter="setTags")
     * @Type("array<Zimbra\Mail\Struct\TagInfo>")
     * @XmlList(inline=true, entry="tag", namespace="urn:zimbraMail")
     *
     * @var array
     */
    #[Accessor(getter: "getTags", setter: "setTags")]
    #[Type("array<Zimbra\Mail\Struct\TagInfo>")]
    #[XmlList(inline: true, entry: "tag", namespace: "urn:zimbraMail")]
    private $tags = [];

    /**
     * Constructor
     *
     * @param  array $tags
     * @return self
     */
    public function __construct(array $tags = [])
    {
        $this->setTags($tags);
    }

    /**
     * Set tags
     *
     * @param  array $tags
     * @return self
     */
    public function setTags(array $tags): self
    {
        $this->tags = array_filter(
            $tags,
            static fn($tag) => $tag instanceof TagInfo
        );
        return $this;
    }

    /**
     * Get tags
     *
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }
}
