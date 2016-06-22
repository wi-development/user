<?php

namespace WI\User;

class Settings{

	protected $user;

	protected $settings = [];

	protected $allowed = [
		//'foo','bar'
		'sitemap_form_left_tab',
		'active_language_tab',
		'sitemap_form_reference_tab'
	];

	/**
	 * Settings constructor.
	 * @param $user
	 */
	public function __construct(array $settings, User $user){
		$this->settings = $settings;
		$this->allowed = array_unique(array_merge(array_keys($settings),$this->allowed));//sja...
		$this->user = $user;
	}


	public function get($key){
		return array_get($this->settings, $key);

	}

	public function set($key,$value){
		if (!($this->has($key))){
			$this->allowed[] = $key;
		}
		$this->settings[$key] = $value;
		$this->persist();
	}

	public function has($key){
		return array_key_exists($key, $this->settings);
	}

	public function hasValue($key,$value){
		if ($this->has($key)){
			return ($this->settings[$key] == $value);
		}
		return false;

	}



	//['active','inactive','default']
	function viewConfig($key,$value,$pRetval)
	{
		if ($this->has($key)){
			return ($this->hasValue($key,$value)) ? $pRetval[0] : $pRetval[1];
		}

		//setting is niet gezet && default is wel gezet: return this ['return this',,'default']
		if ((!($this->has($key))) && (isset($pRetval[2]) && ($pRetval[2] == 'default'))){
			return $pRetval[0];
		}
	}

	public function all(){
		return $this->settings;
	}


	public function merge(array $attributes){

		//json , user->getSettingsAttribute
		$settings = $this->settings;

		//json object to array
		$settings = (array) $settings;

		//merge settings array with request.all array
		$this->settings = array_merge(
			$settings,
			array_only($attributes, $this->allowed)
		);

		//array to string, user->setSettingsAttribute
		return $this->persist();
	}

	public function persist(){
		return $this->user->update(['settings' => $this->settings]);
	}

	public function __get($key){ //called when acces a property on the instance that doesn;t exist

		if ($this->has($key)){
			return $this->get($key); //$this->settings[$key];
		}
		throw new Exception('No settings with the key {$key} exists.');
	}

	public function __call($name, $arguments)
	{
		return $this;
		dc($arguments);
		// TODO: Implement __call() method.
		return "".$name."";
	}

}

?>