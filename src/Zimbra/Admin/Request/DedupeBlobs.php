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
use Zimbra\Enum\DedupAction;

/**
 * DedupeBlobs request class
 * Dedupe the blobs having the same digest.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class DedupeBlobs extends Base
{
    /**
     * Volumes
     * @var TypedSequence<IntIdAttr>
     */
    private $_volumes;

    /**
     * Constructor method for DedupeBlobs
     * @param  DedupAction $action Action to perform - one of start|status|stop
     * @param  array  $volumes Volumes
     * @return DedupeBlobs
     */
    public function __construct(DedupAction $action, array $volumes = [])
    {
        parent::__construct();
        $this->setProperty('action', $action);
        $this->setVolumes($volumes);

        $this->on('before', function(Base $sender)
        {
            if($sender->getVolumes()->count())
            {
                $sender->setChild('volume', $sender->getVolumes()->all());
            }
        });
    }

    /**
     * Gets action
     *
     * @return DedupAction
     */
    public function getAction()
    {
        return $this->getProperty('action');
    }

    /**
     * Sets action
     *
     * @param  DedupAction $action
     * @return self
     */
    public function setAction(DedupAction $action)
    {
        return $this->setProperty('action', $action);
    }


    /**
     * Add an attr
     *
     * @param  KeyValuePair $attr
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
     * @param  array  $volumes
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
}
