<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Preview\Proxy\Service;

use Twilio\Options;
use Twilio\Values;

/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
abstract class SessionOptions {
    /**
     * @param string $uniqueName A unique, developer assigned name of this Session.
     * @param string $status The Status of this Session
     * @return ReadSessionOptions Options builder
     */
    public static function read($uniqueName = Values::NONE, $status = Values::NONE) {
        return new ReadSessionOptions($uniqueName, $status);
    }

    /**
     * @param string $uniqueName A unique, developer assigned name of this Session.
     * @param integer $ttl How long will this session stay open, in seconds.
     * @param string $status The Status of this Session
     * @param string $participants The participants
     * @return CreateSessionOptions Options builder
     */
    public static function create($uniqueName = Values::NONE, $ttl = Values::NONE, $status = Values::NONE, $participants = Values::NONE) {
        return new CreateSessionOptions($uniqueName, $ttl, $status, $participants);
    }

    /**
     * @param string $uniqueName A unique, developer assigned name of this Session.
     * @param integer $ttl How long will this session stay open, in seconds.
     * @param string $status The Status of this Session
     * @param string $participants The participants
     * @return UpdateSessionOptions Options builder
     */
    public static function update($uniqueName = Values::NONE, $ttl = Values::NONE, $status = Values::NONE, $participants = Values::NONE) {
        return new UpdateSessionOptions($uniqueName, $ttl, $status, $participants);
    }
}

class ReadSessionOptions extends Options {
    /**
     * @param string $uniqueName A unique, developer assigned name of this Session.
     * @param string $status The Status of this Session
     */
    public function __construct($uniqueName = Values::NONE, $status = Values::NONE) {
        $this->options['uniqueName'] = $uniqueName;
        $this->options['status'] = $status;
    }

    /**
     * Provides a unique and addressable name to be assigned to this Session, assigned by the developer, to be optionally used in addition to SID.
     * 
     * @param string $uniqueName A unique, developer assigned name of this Session.
     * @return $this Fluent Builder
     */
    public function setUniqueName($uniqueName) {
        $this->options['uniqueName'] = $uniqueName;
        return $this;
    }

    /**
     * The Status of this Session. One of `in-progess` or `completed`.
     * 
     * @param string $status The Status of this Session
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
        return '[Twilio.Preview.Proxy.ReadSessionOptions ' . implode(' ', $options) . ']';
    }
}

class CreateSessionOptions extends Options {
    /**
     * @param string $uniqueName A unique, developer assigned name of this Session.
     * @param integer $ttl How long will this session stay open, in seconds.
     * @param string $status The Status of this Session
     * @param string $participants The participants
     */
    public function __construct($uniqueName = Values::NONE, $ttl = Values::NONE, $status = Values::NONE, $participants = Values::NONE) {
        $this->options['uniqueName'] = $uniqueName;
        $this->options['ttl'] = $ttl;
        $this->options['status'] = $status;
        $this->options['participants'] = $participants;
    }

    /**
     * Provides a unique and addressable name to be assigned to this Session, assigned by the developer, to be optionally used in addition to SID.
     * 
     * @param string $uniqueName A unique, developer assigned name of this Session.
     * @return $this Fluent Builder
     */
    public function setUniqueName($uniqueName) {
        $this->options['uniqueName'] = $uniqueName;
        return $this;
    }

    /**
     * How long will this session stay open, in seconds. Each new interaction resets this timer.
     * 
     * @param integer $ttl How long will this session stay open, in seconds.
     * @return $this Fluent Builder
     */
    public function setTtl($ttl) {
        $this->options['ttl'] = $ttl;
        return $this;
    }

    /**
     * The Status of this Session. One of `in-progess` or `completed`.
     * 
     * @param string $status The Status of this Session
     * @return $this Fluent Builder
     */
    public function setStatus($status) {
        $this->options['status'] = $status;
        return $this;
    }

    /**
     * The participants
     * 
     * @param string $participants The participants
     * @return $this Fluent Builder
     */
    public function setParticipants($participants) {
        $this->options['participants'] = $participants;
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
        return '[Twilio.Preview.Proxy.CreateSessionOptions ' . implode(' ', $options) . ']';
    }
}

class UpdateSessionOptions extends Options {
    /**
     * @param string $uniqueName A unique, developer assigned name of this Session.
     * @param integer $ttl How long will this session stay open, in seconds.
     * @param string $status The Status of this Session
     * @param string $participants The participants
     */
    public function __construct($uniqueName = Values::NONE, $ttl = Values::NONE, $status = Values::NONE, $participants = Values::NONE) {
        $this->options['uniqueName'] = $uniqueName;
        $this->options['ttl'] = $ttl;
        $this->options['status'] = $status;
        $this->options['participants'] = $participants;
    }

    /**
     * Provides a unique and addressable name to be assigned to this Session, assigned by the developer, to be optionally used in addition to SID.
     * 
     * @param string $uniqueName A unique, developer assigned name of this Session.
     * @return $this Fluent Builder
     */
    public function setUniqueName($uniqueName) {
        $this->options['uniqueName'] = $uniqueName;
        return $this;
    }

    /**
     * How long will this session stay open, in seconds. Each new interaction resets this timer.
     * 
     * @param integer $ttl How long will this session stay open, in seconds.
     * @return $this Fluent Builder
     */
    public function setTtl($ttl) {
        $this->options['ttl'] = $ttl;
        return $this;
    }

    /**
     * The Status of this Session. One of `in-progess` or `completed`.
     * 
     * @param string $status The Status of this Session
     * @return $this Fluent Builder
     */
    public function setStatus($status) {
        $this->options['status'] = $status;
        return $this;
    }

    /**
     * The participants
     * 
     * @param string $participants The participants
     * @return $this Fluent Builder
     */
    public function setParticipants($participants) {
        $this->options['participants'] = $participants;
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
        return '[Twilio.Preview.Proxy.UpdateSessionOptions ' . implode(' ', $options) . ']';
    }
}