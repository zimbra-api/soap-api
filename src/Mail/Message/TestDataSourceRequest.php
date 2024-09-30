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

use Zimbra\Mail\Struct\{MailDataSource, MailDataSourceTrait};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * TestDataSourceRequest class
 * Tests the connection to the specified data source.
 * Does not modify the data source or import data.
 * If the id is specified, uses an existing data source.
 * Any values specified in the request are used in the test instead of the saved values.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class TestDataSourceRequest extends SoapRequest
{
    use MailDataSourceTrait;

    /**
     * Constructor
     *
     * @param  MailDataSource $dataSource
     * @return self
     */
    public function __construct(?MailDataSource $dataSource = null)
    {
        $this->imapDataSource = $this->pop3DataSource = $this->caldavDataSource = $this->yabDataSource = $this->rssDataSource = $this->galDataSource = $this->calDataSource = $this->unknownDataSource = null;
        if ($dataSource instanceof MailDataSource) {
            $this->setDataSource($dataSource);
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new TestDataSourceEnvelope(new TestDataSourceBody($this));
    }
}
