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
use Zimbra\Admin\Struct\ReindexProgressInfo as Progress;
use Zimbra\Enum\ReIndexStatus  as Status;
use Zimbra\Soap\ResponseInterface;

/**
 * ReIndexResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ReIndexResponse implements ResponseInterface
{
    /**
     * Status - one of started|running|cancelled|idle
     * @Accessor(getter="getStatus", setter="setStatus")
     * @SerializedName("status")
     * @Type("Zimbra\Enum\ReIndexStatus")
     * @XmlAttribute
     */
    private $status;

    /**
     * Specify reindexing to perform
     * @Accessor(getter="getProgress", setter="setProgress")
     * @SerializedName("progress")
     * @Type("Zimbra\Admin\Struct\ReindexProgressInfo")
     * @XmlElement
     */
    private $progress;

    /**
     * Constructor method for ReIndexResponse
     * 
     * @param Status  $status
     * @param Progress  $progress
     * @return self
     */
    public function __construct(Status $status, Progress $progress = NULL)
    {
        $this->setStatus($status);
        if ($progress instanceof Progress) {
            $this->setProgress($progress);
        }
    }

    /**
     * Gets the progress.
     *
     * @return Progress
     */
    public function getProgress(): Progress
    {
        return $this->progress;
    }

    /**
     * Sets the progress.
     *
     * @param  Progress $progress
     * @return self
     */
    public function setProgress(Progress $progress): self
    {
        $this->progress = $progress;
        return $this;
    }

    /**
     * Gets status
     *
     * @return Status
     */
    public function getStatus(): Status
    {
        return $this->status;
    }

    /**
     * Sets status
     *
     * @param  Status $status
     * @return self
     */
    public function setStatus(Status $status): self
    {
        $this->status = $status;
        return $this;
    }
}
