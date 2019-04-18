<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Api\V2010\Account\Message;

use Twilio\ListResource;
use Twilio\Options;
use Twilio\Values;
use Twilio\Version;

class FeedbackList extends ListResource {
    /**
     * Construct the FeedbackList
     * 
     * @param Version $version Version that contains the resource
     * @param string $accountSid The account_sid
     * @param string $messageSid The message_sid
     * @return \Twilio\Rest\Api\V2010\Account\Message\FeedbackList 
     */
    public function __construct(Version $version, $accountSid, $messageSid) {
        parent::__construct($version);

        // Path Solution
        $this->solution = array('accountSid' => $accountSid, 'messageSid' => $messageSid, );

        $this->uri = '/Accounts/' . rawurlencode($accountSid) . '/Messages/' . rawurlencode($messageSid) . '/Feedback.json';
    }

    /**
     * Create a new FeedbackInstance
     * 
     * @param array|Options $options Optional Arguments
     * @return FeedbackInstance Newly created FeedbackInstance
     */
    public function create($options = array()) {
        $options = new Values($options);

        $data = Values::of(array('Outcome' => $options['outcome'], ));

        $payload = $this->version->create(
            'POST',
            $this->uri,
            array(),
            $data
        );

        return new FeedbackInstance(
            $this->version,
            $payload,
            $this->solution['accountSid'],
            $this->solution['messageSid']
        );
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        return '[Twilio.Api.V2010.FeedbackList]';
    }
}