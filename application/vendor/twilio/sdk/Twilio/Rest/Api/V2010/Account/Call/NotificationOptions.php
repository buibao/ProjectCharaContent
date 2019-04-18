<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Api\V2010\Account\Call;

use Twilio\Options;
use Twilio\Values;

abstract class NotificationOptions {
    /**
     * @param integer $log The log
     * @param string $messageDateBefore The message_date
     * @param string $messageDate The message_date
     * @param string $messageDateAfter The message_date
     * @return ReadNotificationOptions Options builder
     */
    public static function read($log = Values::NONE, $messageDateBefore = Values::NONE, $messageDate = Values::NONE, $messageDateAfter = Values::NONE) {
        return new ReadNotificationOptions($log, $messageDateBefore, $messageDate, $messageDateAfter);
    }
}

class ReadNotificationOptions extends Options {
    /**
     * @param integer $log The log
     * @param string $messageDateBefore The message_date
     * @param string $messageDate The message_date
     * @param string $messageDateAfter The message_date
     */
    public function __construct($log = Values::NONE, $messageDateBefore = Values::NONE, $messageDate = Values::NONE, $messageDateAfter = Values::NONE) {
        $this->options['log'] = $log;
        $this->options['messageDateBefore'] = $messageDateBefore;
        $this->options['messageDate'] = $messageDate;
        $this->options['messageDateAfter'] = $messageDateAfter;
    }

    /**
     * The log
     * 
     * @param integer $log The log
     * @return $this Fluent Builder
     */
    public function setLog($log) {
        $this->options['log'] = $log;
        return $this;
    }

    /**
     * The message_date
     * 
     * @param string $messageDateBefore The message_date
     * @return $this Fluent Builder
     */
    public function setMessageDateBefore($messageDateBefore) {
        $this->options['messageDateBefore'] = $messageDateBefore;
        return $this;
    }

    /**
     * The message_date
     * 
     * @param string $messageDate The message_date
     * @return $this Fluent Builder
     */
    public function setMessageDate($messageDate) {
        $this->options['messageDate'] = $messageDate;
        return $this;
    }

    /**
     * The message_date
     * 
     * @param string $messageDateAfter The message_date
     * @return $this Fluent Builder
     */
    public function setMessageDateAfter($messageDateAfter) {
        $this->options['messageDateAfter'] = $messageDateAfter;
        return $this;
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        $options = array();
        foreach ($this->options as $key => $value) {
            if ($value != Values::NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Api.V2010.ReadNotificationOptions ' . implode(' ', $options) . ']';
    }
}