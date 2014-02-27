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
    private $_volume;

    /**
     * The mbox
     * @var TypedSequence<IntIdAttr>
     */
    private $_mbox;

    /**
     * Constructor method for CheckBlobConsistency
     * @param array $volume The volume
     * @param array $mbox The mbox
     * @param bool  $checkSize The checkSize
     * @param bool  $reportUsedBlobs The reportUsedBlobs
     * @return self
     */
    public function __construct(
        array $volume = array(),
        array $mbox = array(),
        $checkSize = null,
        $reportUsedBlobs = null)
    {
        parent::__construct();
        $this->_volume = new TypedSequence('Zimbra\Admin\Struct\IntIdAttr', $volume);
        $this->_mbox = new TypedSequence('Zimbra\Admin\Struct\IntIdAttr', $mbox);
        if(null !== $checkSize)
        {
            $this->property('checkSize', (bool) $checkSize);
        }
        if(null !== $reportUsedBlobs)
        {
            $this->property('reportUsedBlobs', (bool) $reportUsedBlobs);
        }

        $this->on('before', function(Base $sender)
        {
            if($sender->volume()->count())
            {
                $sender->child('volume', $sender->volume()->all());
            }
            if($sender->mbox()->count())
            {
                $sender->child('mbox', $sender->mbox()->all());
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
        $this->_volume->add($volume);
        return $this;
    }

    /**
     * Gets volume sequence
     *
     * @return Sequence
     */
    public function volume()
    {
        return $this->_volume;
    }

    /**
     * Add a mbox
     *
     * @param  IntIdAttr $mbox
     * @return self
     */
    public function addMbox(IntIdAttr $mbox)
    {
        $this->_mbox->add($mbox);
        return $this;
    }

    /**
     * Gets mbox sequence
     *
     * @return Sequence
     */
    public function mbox()
    {
        return $this->_mbox;
    }

    /**
     * Gets or sets checkSize
     *
     * @param  bool $checkSize
     * @return bool|self
     */
    public function checkSize($checkSize = null)
    {
        if(null === $checkSize)
        {
            return $this->property('checkSize');
        }
        return $this->property('checkSize', (bool) $checkSize);
    }

    /**
     * Gets or sets reportUsedBlobs
     *
     * @param  bool $reportUsedBlobs
     * @return bool|self
     */
    public function reportUsedBlobs($reportUsedBlobs = null)
    {
        if(null === $reportUsedBlobs)
        {
            return $this->property('reportUsedBlobs');
        }
        return $this->property('reportUsedBlobs', (bool) $reportUsedBlobs);
    }
}
