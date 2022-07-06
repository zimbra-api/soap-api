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
use Zimbra\Soap\ResponseInterface;

/**
 * GetTagResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetTagResponse implements ResponseInterface
{
    /**
     * Information about tags
     * 
     * @Accessor(getter="getTags", setter="setTags")
     * @Type("array<Zimbra\Mail\Struct\TagInfo>")
     * @XmlList(inline=true, entry="tag", namespace="urn:zimbraMail")
     */
    private $tags = [];

    /**
     * Constructor method for GetTagResponse
     *
     * @param  array $tags
     * @return self
     */
    public function __construct(array $tags = [])
    {
        $this->setTags($tags);
    }

    /**
     * Add tag
     *
     * @param  TagInfo $tag
     * @return self
     */
    public function addTag(TagInfo $tag): self
    {
        $this->tags[] = $tag;
        return $this;
    }

    /**
     * Sets tags
     *
     * @param  array $tags
     * @return self
     */
    public function setTags(array $tags): self
    {
        $this->tags = array_filter($tags, static fn ($tag) => $tag instanceof TagInfo);
        return $this;
    }

    /**
     * Gets tags
     *
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }
}
