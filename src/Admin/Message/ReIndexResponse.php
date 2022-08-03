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
use Zimbra\Common\Enum\ReIndexStatus  as Status;
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * ReIndexResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ReIndexResponse implements SoapResponseInterface
{
    /**
     * Status - one of started|running|cancelled|idle
     * @Accessor(getter="getStatus", setter="setStatus")
     * @SerializedName("status")
     * @Type("Enum<Zimbra\Common\Enum\ReIndexStatus>")
     * @XmlAttribute
     */
    private Status $status;

    /**
     * Specify reindexing to perform
     * @Accessor(getter="getProgress", setter="setProgress")
     * @SerializedName("progress")
     * @Type("Zimbra\Admin\Struct\ReindexProgressInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?Progress $progress = NULL;

    /**
     * Constructor method for ReIndexResponse
     * 
     * @param Status  $status
     * @param Progress  $progress
     * @return self
     */
    public function __construct(?Status $status = NULL, ?Progress $progress = NULL)
    {
        $this->setStatus($status ?? Status::RUNNING());
        if ($progress instanceof Progress) {
            $this->setProgress($progress);
        }
    }

    /**
     * Get the progress.
     *
     * @return Progress
     */
    public function getProgress(): ?Progress
    {
        return $this->progress;
    }

    /**
     * Set the progress.
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
     * Get status
     *
     * @return Status
     */
    public function getStatus(): Status
    {
        return $this->status;
    }

    /**
     * Set status
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
