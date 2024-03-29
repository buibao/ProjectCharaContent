<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Taskrouter\V1\Workspace\TaskQueue;

use Twilio\Options;
use Twilio\Values;

abstract class TaskQueueRealTimeStatisticsOptions {
    /**
     * @param string $taskChannel Filter real-time and cumulative statistics by
     *                            TaskChannel.
     * @return FetchTaskQueueRealTimeStatisticsOptions Options builder
     */
    public static function fetch($taskChannel = Values::NONE) {
        return new FetchTaskQueueRealTimeStatisticsOptions($taskChannel);
    }
}

class FetchTaskQueueRealTimeStatisticsOptions extends Options {
    /**
     * @param string $taskChannel Filter real-time and cumulative statistics by
     *                            TaskChannel.
     */
    public function __construct($taskChannel = Values::NONE) {
        $this->options['taskChannel'] = $taskChannel;
    }

    /**
     * Filter real-time and cumulative statistics by TaskChannel. Takes in a Unique Name ("voice", "sms", "default", etc.) or a TaskChannelSid.
     * 
     * @param string $taskChannel Filter real-time and cumulative statistics by
     *                            TaskChannel.
     * @return $this Fluent Builder
     */
    public function setTaskChannel($taskChannel) {
        $this->options['taskChannel'] = $taskChannel;
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
        return '[Twilio.Taskrouter.V1.FetchTaskQueueRealTimeStatisticsOptions ' . implode(' ', $options) . ']';
    }
}