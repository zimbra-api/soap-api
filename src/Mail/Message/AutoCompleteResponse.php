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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlList, XmlRoot};
use Zimbra\Mail\Struct\AutoCompleteMatch;
use Zimbra\Soap\ResponseInterface;

/**
 * AutoCompleteResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="AutoCompleteResponse")
 */
class AutoCompleteResponse implements ResponseInterface
{
    /**
     * Flag whether can be cached
     * 
     * @Accessor(getter="getCanBeCached", setter="setCanBeCached")
     * @SerializedName("canBeCached")
     * @Type("bool")
     * @XmlAttribute
     */
    private $canBeCached;

    /**
     * Matches
     * 
     * @Accessor(getter="getMatches", setter="setMatches")
     * @SerializedName("match")
     * @Type("array<Zimbra\Mail\Struct\AutoCompleteMatch>")
     * @XmlList(inline = true, entry = "match")
     */
    private $matches;

    /**
     * Constructor method for AutoCompleteResponse
     *
     * @param  array $matches
     * @param  bool $canBeCached
     * @return self
     */
    public function __construct(
        array $matches = [],
        ?bool $canBeCached = NULL
    )
    {
        $this->setMatches($matches);
        if (NULL !== $canBeCached) {
            $this->setCanBeCached($canBeCached);
        }
    }

    /**
     * Add match
     *
     * @param  AutoCompleteMatch $match
     * @return self
     */
    public function addMatch(AutoCompleteMatch $match): self
    {
        $this->matches[] = $match;
        return $this;
    }

    /**
     * Sets matches
     *
     * @param  array $matches
     * @return self
     */
    public function setMatches(array $matches): self
    {
        $this->matches = [];
        foreach ($matches as $match) {
            if ($match instanceof AutoCompleteMatch) {
                $this->matches[] = $match;
            }
        }
        return $this;
    }

    /**
     * Gets matches
     *
     * @return array
     */
    public function getMatches(): array
    {
        return $this->matches;
    }

    /**
     * Gets canBeCached
     *
     * @return bool
     */
    public function getCanBeCached(): ?bool
    {
        return $this->canBeCached;
    }

    /**
     * Sets canBeCached
     *
     * @param  bool $canBeCached
     * @return self
     */
    public function setCanBeCached(bool $canBeCached): self
    {
        $this->canBeCached = $canBeCached;
        return $this;
    }
}