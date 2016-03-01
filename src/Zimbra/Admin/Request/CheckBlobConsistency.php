<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Request;

use Zimbra\Admin\Struct\IntIdAttr;
use Zimbra\Common\TypedSequence;

/**
 * CheckBlobConsistency request class
 * Checks for items that have no blob, blobs that have no item, and items that have an incorrect blob size stored in their metadata.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CheckBlobConsistency extends Base
{
    /**
     * The volume
     * @var TypedSequence<IntIdAttr>
     */
    private $_volumes;

    /**
     * The mbox
     * @var TypedSequence<IntIdAttr>
     */
    private $_mboxes;

    /**
     * Constructor method for CheckBlobConsistency
     * @param array $volumes The array of volume
     * @param array $mboxes The array of mail box
     * @param bool  $checkSize The check size flag
     * @param bool  $reportUsedBlobs The report used blobs flag
     * @return self
     */
    public function __construct(
        array $volumes = [],
        array $mboxes = [],
        $checkSize = null,
        $reportUsedBlobs = null)
    {
        parent::__construct();
        $this->setVolumes($volumes);
        $this->setMailboxes($mboxes);
        if(null !== $checkSize)
        {
            $this->setProperty('checkSize', (bool) $checkSize);
        }
        if(null !== $reportUsedBlobs)
        {
            $this->setProperty('reportUsedBlobs', (bool) $reportUsedBlobs);
        }

        $this->on('before', function(Base $sender)
        {
            if($sender->getVolumes()->count())
            {
                $sender->setChild('volume', $sender->getVolumes()->all());
            }
            if($sender->getMailboxes()->count())
            {
                $sender->setChild('mbox', $sender->getMailboxes()->all());
            }
        });
    }

    /**
     * Add a volume
     *
     * @param  IntIdAttr $volume
     * @return self
     */
    public function addVolume(IntIdAttr $volume)
    {
        $this->_volumes->add($volume);
        return $this;
    }

    /**
     * Sets volume sequence
     *
     * @param array $volumes
     * @return self
     */
    public function setVolumes(array $volumes)
    {
        $this->_volumes = new TypedSequence('Zimbra\Admin\Struct\IntIdAttr', $volumes);
        return $this;
    }

    /**
     * Gets volume sequence
     *
     * @return Sequence
     */
    public function getVolumes()
    {
        return $this->_volumes;
    }

    /**
     * Add a mail box
     *
     * @param  IntIdAttr $mbox
     * @return self
     */
    public function addMailbox(IntIdAttr $mbox)
    {
        $this->_mboxes->add($mbox);
        return $this;
    }

    /**
     * Sets mail box sequence
     *
     * @param array $mboxes
     * @return self
     */
    public function setMailboxes(array $mboxes)
    {
        $this->_mboxes = new TypedSequence('Zimbra\Admin\Struct\IntIdAttr', $mboxes);
        return $this;
    }

    /**
     * Gets mail box sequence
     *
     * @return Sequence
     */
    public function getMailboxes()
    {
        return $this->_mboxes;
    }

    /**
     * Gets check size flag
     *
     * @return bool
     */
    public function getCheckSize()
    {
        return $this->getProperty('checkSize');
    }

    /**
     * Sets check size flag
     *
     * @param  bool $checkSize
     * @return self
     */
    public function setCheckSize($checkSize)
    {
        return $this->setProperty('checkSize', (bool) $checkSize);
    }

    /**
     * Gets report used blobs flag
     *
     * @return string
     */
    public function getReportUsedBlobs()
    {
        return $this->getProperty('reportUsedBlobs');
    }

    /**
     * Sets report used blobs flag
     *
     * @param  string $reportUsedBlobs
     * @return self
     */
    public function setReportUsedBlobs($reportUsedBlobs)
    {
        return $this->setProperty('reportUsedBlobs', (bool) $reportUsedBlobs);
    }
}
