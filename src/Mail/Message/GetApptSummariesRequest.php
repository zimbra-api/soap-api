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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Soap\{EnvelopeInterface, Request};

/**
 * GetApptSummariesRequest class
 * Get appointment summaries
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetApptSummariesRequest extends Request
{
    /**
     * Range start in milliseconds since the epoch GMT
     * @Accessor(getter="getStartTime", setter="setStartTime")
     * @SerializedName("s")
     * @Type("integer")
     * @XmlAttribute
     */
    private $startTime;

    /**
     * Range end in milliseconds since the epoch GMT
     * @Accessor(getter="getEndTime", setter="setEndTime")
     * @SerializedName("e")
     * @Type("integer")
     * @XmlAttribute
     */
    private $endTime;

    /**
     * Folder ID.  Optional folder to constrain requests to; otherwise, searches all folders but trash and spam
     * @Accessor(getter="getFolderId", setter="setFolderId")
     * @SerializedName("l")
     * @Type("string")
     * @XmlAttribute
     */
    private $folderId;

    /**
     * Constructor method for GetApptSummariesRequest
     *
     * @param  int $startTime
     * @param  int $endTime
     * @param  string $folderId
     * @return self
     */
    public function __construct(
        int $startTime = 0,
        int $endTime = 0,
        ?string $folderId = NULL
    )
    {
        $this->setStartTime($startTime)
             ->setEndTime($endTime);
        if (NULL !== $folderId) {
            $this->setFolderId($folderId);
        }
    }

    /**
     * Gets startTime
     *
     * @return int
     */
    public function getStartTime(): int
    {
        return $this->startTime;
    }

    /**
     * Sets startTime
     *
     * @param  int $startTime
     * @return self
     */
    public function setStartTime(int $startTime): self
    {
        $this->startTime = $startTime;
        return $this;
    }

    /**
     * Gets endTime
     *
     * @return int
     */
    public function getEndTime(): int
    {
        return $this->endTime;
    }

    /**
     * Sets endTime
     *
     * @param  int $endTime
     * @return self
     */
    public function setEndTime(int $endTime): self
    {
        $this->endTime = $endTime;
        return $this;
    }

    /**
     * Gets folderId
     *
     * @return string
     */
    public function getFolderId(): ?string
    {
        return $this->folderId;
    }

    /**
     * Sets folderId
     *
     * @param  string $folderId
     * @return self
     */
    public function setFolderId(string $folderId): self
    {
        $this->folderId = $folderId;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new GetApptSummariesEnvelope(
            new GetApptSummariesBody($this)
        );
    }
}
