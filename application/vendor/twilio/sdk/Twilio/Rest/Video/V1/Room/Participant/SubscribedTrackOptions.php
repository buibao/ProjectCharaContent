<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Video\V1\Room\Participant;

use Twilio\Options;
use Twilio\Values;

abstract class SubscribedTrackOptions {
    /**
     * @param \DateTime $dateCreatedAfter The date_created_after
     * @param \DateTime $dateCreatedBefore The date_created_before
     * @param string $track The track
     * @param string $publisher The publisher
     * @param string $kind The kind
     * @return ReadSubscribedTrackOptions Options builder
     */
    public static function read($dateCreatedAfter = Values::NONE, $dateCreatedBefore = Values::NONE, $track = Values::NONE, $publisher = Values::NONE, $kind = Values::NONE) {
        return new ReadSubscribedTrackOptions($dateCreatedAfter, $dateCreatedBefore, $track, $publisher, $kind);
    }

    /**
     * @param string $track The track
     * @param string $publisher The publisher
     * @param string $kind The kind
     * @param string $status The status
     * @return UpdateSubscribedTrackOptions Options builder
     */
    public static function update($track = Values::NONE, $publisher = Values::NONE, $kind = Values::NONE, $status = Values::NONE) {
        return new UpdateSubscribedTrackOptions($track, $publisher, $kind, $status);
    }
}

class ReadSubscribedTrackOptions extends Options {
    /**
     * @param \DateTime $dateCreatedAfter The date_created_after
     * @param \DateTime $dateCreatedBefore The date_created_before
     * @param string $track The track
     * @param string $publisher The publisher
     * @param string $kind The kind
     */
    public function __construct($dateCreatedAfter = Values::NONE, $dateCreatedBefore = Values::NONE, $track = Values::NONE, $publisher = Values::NONE, $kind = Values::NONE) {
        $this->options['dateCreatedAfter'] = $dateCreatedAfter;
        $this->options['dateCreatedBefore'] = $dateCreatedBefore;
        $this->options['track'] = $track;
        $this->options['publisher'] = $publisher;
        $this->options['kind'] = $kind;
    }

    /**
     * The date_created_after
     * 
     * @param \DateTime $dateCreatedAfter The date_created_after
     * @return $this Fluent Builder
     */
    public function setDateCreatedAfter($dateCreatedAfter) {
        $this->options['dateCreatedAfter'] = $dateCreatedAfter;
        return $this;
    }

    /**
     * The date_created_before
     * 
     * @param \DateTime $dateCreatedBefore The date_created_before
     * @return $this Fluent Builder
     */
    public function setDateCreatedBefore($dateCreatedBefore) {
        $this->options['dateCreatedBefore'] = $dateCreatedBefore;
        return $this;
    }

    /**
     * The track
     * 
     * @param string $track The track
     * @return $this Fluent Builder
     */
    public function setTrack($track) {
        $this->options['track'] = $track;
        return $this;
    }

    /**
     * The publisher
     * 
     * @param string $publisher The publisher
     * @return $this Fluent Builder
     */
    public function setPublisher($publisher) {
        $this->options['publisher'] = $publisher;
        return $this;
    }

    /**
     * The kind
     * 
     * @param string $kind The kind
     * @return $this Fluent Builder
     */
    public function setKind($kind) {
        $this->options['kind'] = $kind;
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
        return '[Twilio.Video.V1.ReadSubscribedTrackOptions ' . implode(' ', $options) . ']';
    }
}

class UpdateSubscribedTrackOptions extends Options {
    /**
     * @param string $track The track
     * @param string $publisher The publisher
     * @param string $kind The kind
     * @param string $status The status
     */
    public function __construct($track = Values::NONE, $publisher = Values::NONE, $kind = Values::NONE, $status = Values::NONE) {
        $this->options['track'] = $track;
        $this->options['publisher'] = $publisher;
        $this->options['kind'] = $kind;
        $this->options['status'] = $status;
    }

    /**
     * The track
     * 
     * @param string $track The track
     * @return $this Fluent Builder
     */
    public function setTrack($track) {
        $this->options['track'] = $track;
        return $this;
    }

    /**
     * The publisher
     * 
     * @param string $publisher The publisher
     * @return $this Fluent Builder
     */
    public function setPublisher($publisher) {
        $this->options['publisher'] = $publisher;
        return $this;
    }

    /**
     * The kind
     * 
     * @param string $kind The kind
     * @return $this Fluent Builder
     */
    public function setKind($kind) {
        $this->options['kind'] = $kind;
        return $this;
    }

    /**
     * The status
     * 
     * @param string $status The status
     * @return $this Fluent Builder
     */
    public function setStatus($status) {
        $this->options['status'] = $status;
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
        return '[Twilio.Video.V1.UpdateSubscribedTrackOptions ' . implode(' ', $options) . ']';
    }
}