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
 * GetAppointmentIdsSinceRequest class
 * Get appointment ids since given id
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAppointmentIdsSinceRequest extends SoapRequest
{
    /**
     * last synced appointment id
     *
     * @var int
     */
    #[Accessor(getter: "getLastSync", setter: "setLastSync")]
    #[SerializedName("lastSync")]
    #[Type("int")]
    #[XmlAttribute]
    private int $lastSync;

    /**
     * Folder ID.
     *
     * @var string
     */
    #[Accessor(getter: "getFolderId", setter: "setFolderId")]
    #[SerializedName("l")]
    #[Type("string")]
    #[XmlAttribute]
    private string $folderId;

    /**
     * Constructor
     *
     * @param  int $lastSync
     * @param  string $folderId
     * @return self
     */
    public function __construct(int $lastSync = 0, string $folderId = "")
    {
        $this->setLastSync($lastSync)->setFolderId($folderId);
    }

    /**
     * Get lastSync
     *
     * @return int
     */
    public function getLastSync(): int
    {
        return $this->lastSync;
    }

    /**
     * Set lastSync
     *
     * @param  int $lastSync
     * @return self
     */
    public function setLastSync(int $lastSync): self
    {
        $this->lastSync = $lastSync;
        return $this;
    }

    /**
     * Get folderId
     *
     * @return string
     */
    public function getFolderId(): string
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
        return new GetAppointmentIdsSinceEnvelope(
            new GetAppointmentIdsSinceBody($this)
        );
    }
}
