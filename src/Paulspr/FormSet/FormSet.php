<?php

namespace Paulspr\FormSet;

class FormBuilder extends \Bllim\Laravalid\FormBuilder {

	public function postalcode($name, $value = null, $options = [])
	{
		if(isset($options['class'])){
			$options['class'] .= ' postalcodeNL';
		}
		else{
			$options['class'] = 'postalcodeNL';
		}
		$options = $this->converter->convert(Helper::getFormAttribute($name)) + $options;
		return parent::text($name, $value, $options);
	}


	public function makeSet( $label, $input ){
		return '
		<div class="row is-form-row">
			<div class="is-form-label-holder">
				'.$label.'
			</div>
			<div class="is-form-widget-holder">
				'.$input.'
			</div>
        </div>';
	}


	public function textSet($name, $options = [], $value = null){
		return self::inputSet('text', $name, $value, $options);
	}
	public function passwordSet($name, $options = [], $value = null){
		return self::inputSet('password', $name, $value, $options);
	}
	public function emailSet($name, $options = [], $value = null){
		return self::inputSet('email', $name, $value, $options);
	}
	public function telSet($name, $options = [], $value = null){
		return self::inputSet('tel', $name, $value, $options);
	}
	public function numberSet($name, $options = [], $value = null){
		return self::inputSet('number', $name, $value, $options);
	}

	public function dateSet($name, $options = [], $value = null){
		return self::inputSet('date', $name, $value, $options);
	}
	public function datetimeSet($name, $options = [], $value = null){
		return self::inputSet('datetime', $name, $value, $options);
	}
	public function datetimeLocalSet($name, $options = [], $value = null){
		return self::inputSet('datetime-local', $name, $value, $options);
	}

	public function timeSet($name, $options = [], $value = null){
		return self::inputSet('time', $name, $value, $options);
	}
	public function urlSet($name, $options = [], $value = null){
		return self::inputSet('url', $name, $value, $options);
	}
	public function fileSet($name, $options = [], $value = null){
		return self::inputSet('file', $name, $value, $options);
	}

	public function postalcodeSet($name, $options = [], $value = null){
		$customInput = self::postalcode($name, $value, $options);
		return self::inputSet('text', $name, $value, $options, $customInput);
	}


	public function inputSet($type, $name, $value = null, $options = [], $customInput = null){
		$options = $this->converter->convert(Helper::getFormAttribute($name)) + $options;

		$labelText = isset($options['label']) ? $options['label'] : null;
		$requiredLabel = isset($options['data-rule-required']) ? self::$requiredLabel : '';

		$label = self::label($name, $labelText, [], $requiredLabel);
		$input = isset($customInput) ? $customInput : parent::input($type, $name, $value, $options);
		return self::makeSet($label, $input);
	}

}