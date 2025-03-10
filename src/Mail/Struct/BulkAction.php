<?php declare(strict_types=1);
/**
 * This file is version of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Enum\BulkOperation;

/**
 * BulkAction struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class BulkAction
{
    /**
     * Operation to perform
     * - move: move the search result to specified folder location
     * - read: mark the search result as read
     * - unread: mark the search result as unread
     *
     * @var BulkOperation
     */
    #[Accessor(getter: "getOp", setter: "setOp")]
    #[SerializedName("op")]
    #[XmlAttribute]
    private BulkOperation $op;

    /**
     * Folder
     * Required if op="move". Folder pathname where all matching items should be moved.
     *
     * @var string
     */
    #[Accessor(getter: "getFolder", setter: "setFolder")]
    #[SerializedName("l")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $folder = null;

    /**
     * Constructor
     *
     * @param BulkOperation $op
     * @param string $folder
     * @return self
     */
    public function __construct(
        ?BulkOperation $op = null,
        ?string $folder = null
    ) {
        $this->setOp($op ?? BulkOperation::READ);
        if (null !== $folder) {
            $this->setFolder($folder);
        }
    }

    /**
     * Get folder
     *
     * @return string
     */
    public function getFolder(): ?string
    {
        return $this->folder;
    }

    /**
     * Set folder
     *
     * @param  string $folder
     * @return self
     */
    public function setFolder(string $folder): self
    {
        $this->folder = $folder;
        return $this;
    }

    /**
     * Get op
     *
     * @return BulkOperation
     */
    public function getOp(): BulkOperation
    {
        return $this->op;
    }

    /**
     * Set op
     *
     * @param  BulkOperation $op
     * @return self
     */
    public function setOp(BulkOperation $op): self
    {
        $this->op = $op;
        return $this;
    }
}
