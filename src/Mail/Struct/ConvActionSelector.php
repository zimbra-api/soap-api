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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Common\Enum\ConvActionOp;

/**
 * ConvActionSelector class
 * Conversation action selector
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ConvActionSelector extends ActionSelector
{
    /**
     * In case of "move" operation, this attr can also be used to specify the target folder,
     * in terms of the relative path from the account / data source's root folder. The target account / data source is
     * identified based on where the messages in this conversation already reside. If a conversation contains messages
     * belonging of multiple accounts / data sources then it would not be affected by this operation.
     * 
     * @Accessor(getter="getAcctRelativePath", setter="setAcctRelativePath")
     * @SerializedName("acctRelPath")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraMail")
     */
    private $acctRelativePath;

    /**
     * Constructor
     *
     * @param  string $operation
     * @param  string $ids
     * @param  string $acctRelativePath
     * @param  string $constraint
     * @param  int $tag
     * @param  string $folder
     * @param  string $rgb
     * @param  int $color
     * @param  string $name
     * @param  string $flags
     * @param  string $tags
     * @param  string $tagNames
     * @param  bool $nonExistentIds
     * @param  bool $newlyCreatedIds
     * @return self
     */
    public function __construct(
        string $operation = '',
        ?string $ids = NULL,
        ?string $acctRelativePath = NULL,
        ?string $constraint = NULL,
        ?int $tag = NULL,
        ?string $folder = NULL,
        ?string $rgb = NULL,
        ?int $color = NULL,
        ?string $name = NULL,
        ?string $flags = NULL,
        ?string $tags = NULL,
        ?string $tagNames = NULL,
        ?bool $nonExistentIds = NULL,
        ?bool $newlyCreatedIds = NULL
    )
    {
        parent::__construct(
            $operation,
            $ids,
            $constraint,
            $tag,
            $folder,
            $rgb,
            $color,
            $name,
            $flags,
            $tags,
            $tagNames,
            $nonExistentIds,
            $newlyCreatedIds
        );
        if (NULL !== $acctRelativePath) {
            $this->setAcctRelativePath($acctRelativePath);
        }
    }

    /**
     * Set operation
     *
     * @param  string $operation
     * @return self
     */
    public function setOperation(string $operation): self
    {
        if (ConvActionOp::isValid($operation)) {
            parent::setOperation($operation);
        }
        return $this;
    }

    /**
     * Get acctRelativePath
     *
     * @return string
     */
    public function getAcctRelativePath(): ?string
    {
        return $this->acctRelativePath;
    }

    /**
     * Set acctRelativePath
     *
     * @param  string $acctRelativePath
     * @return self
     */
    public function setAcctRelativePath(string $acctRelativePath): self
    {
        $this->acctRelativePath = $acctRelativePath;
        return $this;
    }
}
