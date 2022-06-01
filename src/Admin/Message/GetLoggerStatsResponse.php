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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement, XmlList};
use Zimbra\Admin\Struct\HostStats;
use Zimbra\Soap\ResponseInterface;

/**
 * GetLoggerStatsResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetLoggerStatsResponse implements ResponseInterface
{
    /**
     * Info by hostname
     * 
     * @Accessor(getter="getHostNames", setter="setHostNames")
     * @SerializedName("hostname")
     * @Type("array<Zimbra\Admin\Struct\HostStats>")
     * @XmlList(inline = true, entry = "hostname")
     */
    private $hostNames = [];

    /**
     * Note.  For instance "Logger is not enabled"
     * @Accessor(getter="getNote", setter="setNote")
     * @SerializedName("note")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $note;

    /**
     * Constructor method for GetLoggerStatsResponse
     *
     * @param array $hostNames
     * @param string $note
     * @return self
     */
    public function __construct(array $hostNames = [], ?string $note = NULL)
    {
        $this->setHostNames($hostNames);
        if (NULL !== $note) {
            $this->setNote($note);
        }
    }

    /**
     * Add a hostname
     *
     * @param  HostStats $hostname
     * @return self
     */
    public function addHostName(HostStats $hostname): self
    {
        $this->hostNames[] = $hostname;
        return $this;
    }

    /**
     * Sets hostNames
     *
     * @param  array $hostNames
     * @return self
     */
    public function setHostNames(array $hostNames): self
    {
        $this->hostNames = [];
        foreach ($hostNames as $hostname) {
            if ($hostname instanceof HostStats) {
                $this->hostNames[] = $hostname;
            }
        }
        return $this;
    }

    /**
     * Gets hostNames
     *
     * @return array
     */
    public function getHostNames(): array
    {
        return $this->hostNames;
    }

    /**
     * Gets note
     *
     * @return string
     */
    public function getNote(): ?string
    {
        return $this->note;
    }

    /**
     * Sets note
     *
     * @param  string $note
     * @return self
     */
    public function setNote(string $note): self
    {
        $this->note = $note;
        return $this;
    }
}
