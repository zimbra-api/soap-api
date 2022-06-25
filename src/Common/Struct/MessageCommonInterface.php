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

/**
 * MessageCommonInterface interface
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
interface MessageCommonInterface
{
    function setSize(int $size): self;
    function setDate(int $date): self;
    function setFolder(string $folder): self;
    function setConversationId(string $conversationId): self;
    function setFlags(string $flags): self;
    function setTags(string $tags): self;
    function setTagNames(string $tagNames): self;
    function setRevision(int $revision): self;
    function setChangeDate(int $changeDate): self;
    function setModifiedSequence(int $modifiedSequence): self;
    function setMetadatas(array $metadatas): self;
    function addMetadata(CustomMetadataInterface $metadata): self;

    function getSize(): ?int;
    function getDate(): ?int;
    function getFolder(): ?string;
    function getConversationId(): ?string;
    function getFlags(): ?string;
    function getTags(): ?string;
    function getTagNames(): ?string;
    function getRevision(): ?int;
    function getChangeDate(): ?int;
    function getModifiedSequence(): ?int;
    function getMetadatas(): array;
}
