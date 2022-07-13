<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Struct;

use Zimbra\Common\Enum\{SearchSortBy, WantRecipsSetting};

/**
 * SearchParameters interface
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
interface SearchParameters
{
    function setIncludeTagDeleted(bool $includeTagDeleted): self;
    function setIncludeTagMuted(bool $includeTagMuted);
    function setAllowableTaskStatus(string $allowableTaskStatus): self;
    function setCalItemExpandStart(int $calItemExpandStart): self;
    function setCalItemExpandEnd(int $calItemExpandEnd): self;
    function setQuery(string $query): self;
    function setInDumpster(bool $inDumpster): self;
    function setSearchTypes(string $searchTypes): self;
    function setGroupBy(string $groupBy): self;
    function setQuick(bool $quick): self;
    function setSortBy(SearchSortBy $sortBy): self;
    function setFetch(string $fetch): self;
    function setMarkRead(bool $markRead): self;
    function setMaxInlinedLength(int $maxInlinedLength): self;
    function setWantHtml(bool $wantHtml);
    function setNeedCanExpand(bool $needCanExpand): self;
    function setNeuterImages(bool $neuterImages): self;
    function setWantRecipients(WantRecipsSetting $wantRecipients): self;
    function setPrefetch(bool $prefetch): self;
    function setResultMode(string $resultMode): self;
    function setField(string $field): self;
    function setLimit(int $limit): self;
    function setOffset(int $offset): self;
    function setHeaders(array $headers): self;
    function addHeader(AttributeName $header): self;
    function setCalTz(CalTZInfoInterface $calTz): self;
    function setLocale(string $locale): self;
    function setCursor(CursorInfo $cursor): self;

    function getIncludeTagDeleted(): ?bool;
    function getIncludeTagMuted(): ?bool;
    function getAllowableTaskStatus(): ?string;
    function getCalItemExpandStart(): ?int;
    function getCalItemExpandEnd(): ?int;
    function getQuery(): ?string;
    function getInDumpster(): ?bool;
    function getSearchTypes(): ?string;
    function getGroupBy(): ?string;
    function getQuick(): ?bool;
    function getSortBy(): ?SearchSortBy;
    function getFetch(): ?string;
    function getMarkRead(): ?bool;
    function getMaxInlinedLength(): ?int;
    function getWantHtml(): ?bool;
    function getNeedCanExpand(): ?bool;
    function getNeuterImages(): ?bool;
    function getWantRecipients(): ?WantRecipsSetting;
    function getPrefetch(): ?bool;
    function getResultMode(): ?string;
    function getField(): ?string;
    function getLimit(): ?int;
    function getOffset(): ?int;
    function getHeaders(): array;
    function getCalTz(): ?CalTZInfoInterface;
    function getLocale(): ?string;
    function getCursor(): ?CursorInfo;
}
