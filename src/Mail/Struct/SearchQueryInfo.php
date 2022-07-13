<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Common\Struct\WildcardExpansionQueryInfo;

/**
 * SearchQueryInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class SearchQueryInfo
{
    /**
     * Suggest query info
     * 
     * @Accessor(getter="getSuggests", setter="setSuggests")
     * @Type("array<Zimbra\Mail\Struct\SuggestedQueryString>")
     * @XmlList(inline=true, entry="suggest", namespace="urn:zimbraMail")
     */
    private $suggests = [];

    /**
     * Wildcard query info
     * 
     * @Accessor(getter="getWildcards", setter="setWildcards")
     * @Type("array<Zimbra\Common\Struct\WildcardExpansionQueryInfo>")
     * @XmlList(inline=true, entry="wildcard", namespace="urn:zimbraMail")
     */
    private $wildcards = [];

    /**
     * Constructor method
     *
     * @return self
     */
    public function __construct(array $suggests = [], array $wildcards = [])
    {
        $this->setSuggests($suggests)
             ->setWildcards($wildcards);
    }

    /**
     * Add suggest
     *
     * @param  SuggestedQueryString $suggest
     * @return self
     */
    public function addSuggest(SuggestedQueryString $suggest): self
    {
        $this->suggests[] = $suggest;
        return $this;
    }

    /**
     * Set suggests
     *
     * @param  array $suggests
     * @return self
     */
    public function setSuggests(array $suggests): self
    {
        $this->suggests = array_filter($suggests, static fn($suggest) => $suggest instanceof SuggestedQueryString);
        return $this;
    }

    /**
     * Gets suggests
     *
     * @return array
     */
    public function getSuggests(): array
    {
        return $this->suggests;
    }

    /**
     * Add wildcard
     *
     * @param  WildcardExpansionQueryInfo $wildcard
     * @return self
     */
    public function addWildcard(WildcardExpansionQueryInfo $wildcard): self
    {
        $this->wildcards[] = $wildcard;
        return $this;
    }

    /**
     * Set wildcards
     *
     * @param  array $wildcards
     * @return self
     */
    public function setWildcards(array $wildcards): self
    {
        $this->wildcards = array_filter($wildcards, static fn($wildcard) => $wildcard instanceof WildcardExpansionQueryInfo);
        return $this;
    }

    /**
     * Gets wildcards
     *
     * @return array
     */
    public function getWildcards(): array
    {
        return $this->wildcards;
    }
}
