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
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * GetApptSummariesRequest class
 * Get appointment summaries
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetApptSummariesRequest extends SoapRequest
{
    /**
     * Range start in milliseconds since the epoch GMT
     *
     * @var int
     */
    #[Accessor(getter: "getStartTime", setter: "setStartTime")]
    #[SerializedName("s")]
    #[Type("int")]
    #[XmlAttribute]
    private int $startTime;

    /**
     * Range end in milliseconds since the epoch GMT
     *
     * @var int
     */
    #[Accessor(getter: "getEndTime", setter: "setEndTime")]
    #[SerializedName("e")]
    #[Type("int")]
    #[XmlAttribute]
    private int $endTime;

    /**
     * Folder ID. Optional folder to constrain requests to; otherwise, searches all folders but trash and spam
     *
     * @var string
     */
    #[Accessor(getter: "getFolderId", setter: "setFolderId")]
    #[SerializedName("l")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $folderId = null;

    /**
     * Constructor
     *
     * @param  int $startTime
     * @param  int $endTime
     * @param  string $folderId
     * @return self
     */
    public function __construct(
        int $startTime = 0,
        int $endTime = 0,
        ?string $folderId = null
    ) {
        $this->setStartTime($startTime)->setEndTime($endTime);
        if (null !== $folderId) {
            $this->setFolderId($folderId);
        }
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
     * Get folderId
     *
     * @return string
     */
    public function getFolderId(): ?string
    {
        return $this->folderId;
    }

    /**
     * Set folderId
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetApptSummariesEnvelope(new GetApptSummariesBody($this));
    }
}
