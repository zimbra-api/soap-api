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
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Common\Struct\{Id, SoapEnvelopeInterface, SoapRequest};

/**
 * GetMiniCalRequest class
 * Get information needed for Mini Calendar.
 * Date is returned if there is at least one appointment on that date.
 * The date computation uses the requesting (authenticated) account's time zone,
 * not the time zone of the account that owns the calendar folder.
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetMiniCalRequest extends SoapRequest
{
    /**
     * Range start time in milliseconds
     * 
     * @var int
     */
    #[Accessor(getter: 'getStartTime', setter: 'setStartTime')]
    #[SerializedName('s')]
    #[Type('int')]
    #[XmlAttribute]
    private $startTime;

    /**
     * Range end time in milliseconds
     * 
     * @var int
     */
    #[Accessor(getter: 'getEndTime', setter: 'setEndTime')]
    #[SerializedName('e')]
    #[Type('int')]
    #[XmlAttribute]
    private $endTime;

    /**
     * Local and/or remote calendar folders
     * 
     * @var array
     */
    #[Accessor(getter: 'getFolders', setter: 'setFolders')]
    #[Type('array<Zimbra\Common\Struct\Id>')]
    #[XmlList(inline: true, entry: 'folder', namespace: 'urn:zimbraMail')]
    private $folders = [];

    /**
     * Optional timezone specifier.
     * References an existing server-known timezone by ID or the full specification of a custom timezone
     * 
     * @var CalTZInfo
     */
    #[Accessor(getter: 'getTimezone', setter: 'setTimezone')]
    #[SerializedName('tz')]
    #[Type(CalTZInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private ?CalTZInfo $timezone;

    /**
     * Constructor
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
        $this->timezone = $timezone;
    }

    /**
     * Get startTime
     *
     * @return int
     */
    public function getStartTime(): int
    {
        return $this->startTime;
    }

    /**
     * Set startTime
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
     * Get endTime
     *
     * @return int
     */
    public function getEndTime(): int
    {
        return $this->endTime;
    }

    /**
     * Set endTime
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
     * Get timezone
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
     * Set folders
     *
     * @param  array $folders
     * @return self
     */
    public function setFolders(array $folders): self
    {
        $this->folders = array_filter(
            $folders, static fn ($folder) => $folder instanceof Id
        );
        return $this;
    }

    /**
     * Get folders
     *
     * @return array
     */
    public function getFolders(): array
    {
        return $this->folders;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetMiniCalEnvelope(
            new GetMiniCalBody($this)
        );
    }
}
