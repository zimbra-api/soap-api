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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement, XmlList};
use Zimbra\Common\Struct\Id;
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * GetMiniCalRequest class
 * Get information needed for Mini Calendar.
 * Date is returned if there is at least one appointment on that date.  The date computation uses the requesting
 * (authenticated) account's time zone, not the time zone of the account that owns the calendar folder.
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetMiniCalRequest extends Request
{
    /**
     * Range start time in milliseconds
     * @Accessor(getter="getStartTime", setter="setStartTime")
     * @SerializedName("s")
     * @Type("integer")
     * @XmlAttribute
     */
    private $startTime;

    /**
     * Range end time in milliseconds
     * @Accessor(getter="getEndTime", setter="setEndTime")
     * @SerializedName("e")
     * @Type("integer")
     * @XmlAttribute
     */
    private $endTime;

    /**
     * Local and/or remote calendar folders
     * 
     * @Accessor(getter="getFolders", setter="setFolders")
     * @Type("array<Zimbra\Common\Struct\Id>")
     * @XmlList(inline=true, entry="folder", namespace="urn:zimbraMail")
     */
    private $folders = [];

    /**
     * Optional timezone specifier.  References an existing server-known timezone by ID or
     * the full specification of a custom timezone
     * 
     * @Accessor(getter="getTimezone", setter="setTimezone")
     * @SerializedName("tz")
     * @Type("Zimbra\Mail\Struct\CalTZInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private $timezone = [];

    /**
     * Constructor method for GetMiniCalRequest
     *
     * @param  int $startTime
     * @param  int $endTime
     * @param  array $folders
     * @param  CalTZInfo $timezone
     * @return self
     */
    public function __construct(
        int $startTime = 0,
        int $endTime = 0,
        array $folders = [],
        ?CalTZInfo $timezone = NULL
    )
    {
        $this->setStartTime($startTime)
             ->setEndTime($endTime)
             ->setFolders($folders);
        if ($timezone instanceof CalTZInfo) {
            $this->setTimezone($timezone);
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
     * Set timezone
     *
     * @param  CalTZInfo $timezone
     * @return self
     */
    public function setTimezone(CalTZInfo $timezone): self
    {
        $this->timezone = $timezone;
        return $this;
    }

    /**
     * Gets timezone
     *
     * @return CalTZInfo
     */
    public function getTimezone(): ?CalTZInfo
    {
        return $this->timezone;
    }

    /**
     * Add folder
     *
     * @param  Id $folder
     * @return self
     */
    public function addFolder(Id $folder): self
    {
        $this->folders[] = $folder;
        return $this;
    }

    /**
     * Sets folders
     *
     * @param  array $folders
     * @return self
     */
    public function setFolders(array $folders): self
    {
        $this->folders = array_filter($folders, static fn ($folder) => $folder instanceof Id);
        return $this;
    }

    /**
     * Gets folders
     *
     * @return array
     */
    public function getFolders(): array
    {
        return $this->folders;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new GetMiniCalEnvelope(
            new GetMiniCalBody($this)
        );
    }
}
