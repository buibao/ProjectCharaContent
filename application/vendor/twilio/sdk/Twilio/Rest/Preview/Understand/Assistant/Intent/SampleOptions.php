<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Preview\Understand\Assistant\Intent;

use Twilio\Options;
use Twilio\Values;

/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
abstract class SampleOptions {
    /**
     * @param string $language The language
     * @return ReadSampleOptions Options builder
     */
    public static function read($language = Values::NONE) {
        return new ReadSampleOptions($language);
    }

    /**
     * @param string $sourceChannel The source_channel
     * @return CreateSampleOptions Options builder
     */
    public static function create($sourceChannel = Values::NONE) {
        return new CreateSampleOptions($sourceChannel);
    }

    /**
     * @param string $language The language
     * @param string $taggedText The tagged_text
     * @param string $sourceChannel The source_channel
     * @return UpdateSampleOptions Options builder
     */
    public static function update($language = Values::NONE, $taggedText = Values::NONE, $sourceChannel = Values::NONE) {
        return new UpdateSampleOptions($language, $taggedText, $sourceChannel);
    }
}

class ReadSampleOptions extends Options {
    /**
     * @param string $language The language
     */
    public function __construct($language = Values::NONE) {
        $this->options['language'] = $language;
    }

    /**
     * The language
     * 
     * @param string $language The language
     * @return $this Fluent Builder
     */
    public function setLanguage($language) {
        $this->options['language'] = $language;
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
        return '[Twilio.Preview.Understand.ReadSampleOptions ' . implode(' ', $options) . ']';
    }
}

class CreateSampleOptions extends Options {
    /**
     * @param string $sourceChannel The source_channel
     */
    public function __construct($sourceChannel = Values::NONE) {
        $this->options['sourceChannel'] = $sourceChannel;
    }

    /**
     * The source_channel
     * 
     * @param string $sourceChannel The source_channel
     * @return $this Fluent Builder
     */
    public function setSourceChannel($sourceChannel) {
        $this->options['sourceChannel'] = $sourceChannel;
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
        return '[Twilio.Preview.Understand.CreateSampleOptions ' . implode(' ', $options) . ']';
    }
}

class UpdateSampleOptions extends Options {
    /**
     * @param string $language The language
     * @param string $taggedText The tagged_text
     * @param string $sourceChannel The source_channel
     */
    public function __construct($language = Values::NONE, $taggedText = Values::NONE, $sourceChannel = Values::NONE) {
        $this->options['language'] = $language;
        $this->options['taggedText'] = $taggedText;
        $this->options['sourceChannel'] = $sourceChannel;
    }

    /**
     * The language
     * 
     * @param string $language The language
     * @return $this Fluent Builder
     */
    public function setLanguage($language) {
        $this->options['language'] = $language;
        return $this;
    }

    /**
     * The tagged_text
     * 
     * @param string $taggedText The tagged_text
     * @return $this Fluent Builder
     */
    public function setTaggedText($taggedText) {
        $this->options['taggedText'] = $taggedText;
        return $this;
    }

    /**
     * The source_channel
     * 
     * @param string $sourceChannel The source_channel
     * @return $this Fluent Builder
     */
    public function setSourceChannel($sourceChannel) {
        $this->options['sourceChannel'] = $sourceChannel;
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
        return '[Twilio.Preview.Understand.UpdateSampleOptions ' . implode(' ', $options) . ']';
    }
}