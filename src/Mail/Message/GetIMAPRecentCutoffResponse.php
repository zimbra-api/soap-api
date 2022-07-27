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
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * GetIMAPRecentCutoffResponse class
 * Return the count of recent items in the folder
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetIMAPRecentCutoffResponse implements SoapResponseInterface
{
    /**
     * The last recorded assigned item ID in the enclosing
     * Mailbox the last time the folder was accessed via a read/write IMAP session.
     * Note that this value is only updated on session closes
     * @Accessor(getter="getCutoff", setter="setCutoff")
     * @SerializedName("cutoff")
     * @Type("integer")
     * @XmlAttribute
     */
    private $cutoff;

    /**
     * Constructor method for GetIMAPRecentCutoffResponse
     *
     * @param  int $cutoff
     * @return self
     */
    public function __construct(int $cutoff = 0)
    {
        $this->setCutoff($cutoff);
    }

    /**
     * Gets cutoff
     *
     * @return int
     */
    public function getCutoff(): int
    {
        return $this->cutoff;
    }

    /**
     * Sets cutoff
     *
     * @param  int $cutoff
     * @return self
     */
    public function setCutoff(int $cutoff): self
    {
        $this->cutoff = $cutoff;
        return $this;
    }
}
