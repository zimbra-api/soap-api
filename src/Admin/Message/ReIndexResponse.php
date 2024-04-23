<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};
use Zimbra\Admin\Struct\ReindexProgressInfo;
use Zimbra\Common\Enum\ReIndexStatus;
use Zimbra\Common\Struct\SoapResponse;

/**
 * ReIndexResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ReIndexResponse extends SoapResponse
{
    /**
     * Status - one of started|running|cancelled|idle
     * 
     * @var ReIndexStatus
     */
    #[Accessor(getter: 'getStatus', setter: 'setStatus')]
    #[SerializedName('status')]
    #[XmlAttribute]
    private ?ReIndexStatus $status;

    /**
     * Specify reindexing to perform
     * 
     * @var ReindexProgressInfo
     */
    #[Accessor(getter: 'getProgress', setter: 'setProgress')]
    #[SerializedName('progress')]
    #[Type(ReindexProgressInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private ?ReindexProgressInfo $progress;

    /**
     * Constructor
     * 
     * @param ReIndexStatus $status
     * @param ReindexProgressInfo $progress
     * @return self
     */
    public function __construct(
        ?ReIndexStatus $status = null, ?ReindexProgressInfo $progress = null
    )
    {
        $this->status = $status;
        $this->progress = $progress;
    }

    /**
     * Get the progress.
     *
     * @return ReindexProgressInfo
     */
    public function getProgress(): ?ReindexProgressInfo
    {
        return $this->progress;
    }

    /**
     * Set the progress.
     *
     * @param  ReindexProgressInfo $progress
     * @return self
     */
    public function setProgress(ReindexProgressInfo $progress): self
    {
        $this->progress = $progress;
        return $this;
    }

    /**
     * Get status
     *
     * @return ReIndexStatus
     */
    public function getStatus(): ReIndexStatus
    {
        return $this->status;
    }

    /**
     * Set status
     *
     * @param  ReIndexStatus $status
     * @return self
     */
    public function setStatus(ReIndexStatus $status): self
    {
        $this->status = $status;
        return $this;
    }
}
