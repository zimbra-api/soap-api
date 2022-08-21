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

use Zimbra\Mail\Struct\{
    MailDataSource,
    MailDataSourceTrait
};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * ModifyDataSourceRequest class
 * Changes attributes of the given data source.  Only the attributes specified in the
 * request are modified.  If the username, host or leaveOnServer settings are modified, the server wipes out saved
 * state for this data source.  As a result, any previously downloaded messages that are still stored on the remote
 * server will be downloaded again.
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ModifyDataSourceRequest extends SoapRequest
{
    use MailDataSourceTrait;

    /**
     * Constructor
     *
     * @param  MailDataSource $dataSource
     * @return self
     */
    public function __construct(?MailDataSource $dataSource = NULL)
    {
        $this->imapDataSource = 
        $this->pop3DataSource = 
        $this->caldavDataSource = 
        $this->yabDataSource = 
        $this->rssDataSource = 
        $this->galDataSource = 
        $this->calDataSource = 
        $this->unknownDataSource = NULL;
        if ($dataSource instanceof MailDataSource) {
            $this->setDataSource($dataSource);
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new ModifyDataSourceEnvelope(
            new ModifyDataSourceBody($this)
        );
    }
}
