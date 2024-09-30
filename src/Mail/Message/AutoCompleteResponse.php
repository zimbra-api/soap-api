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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlList
};
use Zimbra\Mail\Struct\AutoCompleteMatch;
use Zimbra\Common\Struct\SoapResponse;

/**
 * AutoCompleteResponse class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AutoCompleteResponse extends SoapResponse
{
    /**
     * Flag whether can be cached
     *
     * @Accessor(getter="getCanBeCached", setter="setCanBeCached")
     * @SerializedName("canBeCached")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "getCanBeCached", setter: "setCanBeCached")]
    #[SerializedName("canBeCached")]
    #[Type("bool")]
    #[XmlAttribute]
    private $canBeCached;

    /**
     * Matches
     *
     * @Accessor(getter="getMatches", setter="setMatches")
     * @Type("array<Zimbra\Mail\Struct\AutoCompleteMatch>")
     * @XmlList(inline=true, entry="match", namespace="urn:zimbraMail")
     *
     * @var array
     */
    #[Accessor(getter: "getMatches", setter: "setMatches")]
    #[Type("array<Zimbra\Mail\Struct\AutoCompleteMatch>")]
    #[XmlList(inline: true, entry: "match", namespace: "urn:zimbraMail")]
    private $matches = [];

    /**
     * Constructor
     *
     * @param  array $matches
     * @param  bool $canBeCached
     * @return self
     */
    public function __construct(array $matches = [], ?bool $canBeCached = null)
    {
        $this->setMatches($matches);
        if (null !== $canBeCached) {
            $this->setCanBeCached($canBeCached);
        }
    }

    /**
     * Set matches
     *
     * @param  array $matches
     * @return self
     */
    public function setMatches(array $matches): self
    {
        $this->matches = array_filter(
            $matches,
            static fn($match) => $match instanceof AutoCompleteMatch
        );
        return $this;
    }

    /**
     * Get matches
     *
     * @return array
     */
    public function getMatches(): array
    {
        return $this->matches;
    }

    /**
     * Get canBeCached
     *
     * @return bool
     */
    public function getCanBeCached(): ?bool
    {
        return $this->canBeCached;
    }

    /**
     * Set canBeCached
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
