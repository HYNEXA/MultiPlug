<?php
/**
 * Created by PhpStorm.
 * User: RiipZuu
 * Date: 06.01.2019
 * Time: 15:02
 */

namespace RiipZuu;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use RiipZuu\anticheat\AntiCheat;
use RiipZuu\commandspy\CommandEvent;
use RiipZuu\KeepInv\KeepInventory;
use RiipZuu\playercloud\PlayerCloud;
use RiipZuu\score\Scoreboard;
use RiipZuu\spawn\AlwaysSpawn;


class Loader extends PluginBase {

	private static $instance;

	public $vanishlist = array();

	public $frezzelist = array();

	public $prefix = "§aMulti§cPlug §8|§r ";



	/**
	 *
	 */
	public function onEnable()
	{

	
		self::$instance = $this;

		$this->getLogger()->info("§aMultiPlug activated");


		$this->initEvents();

		if(!file_exists($this->getDataFolder() . "config.yml")){
			$c = new Config($this->getDataFolder() . "config.yml", Config::YAML);
            $c->set("CommandSpy", true);
            $c->set("PlayerCloud", true);
            $c->set("KeepInventoy", false);
            $c->set("Scoreboard", false);
            $c->set("AntiCheat", true);
            $c->set("AlwaysSpawn", true);
			$c->save();
		}

	}


	/**
	 * @return string
	 */
	public function getPrefix(){
		return $this->prefix;
	}

	/**
	 * @return Loader
	 */
	public static function getInstance() : Loader {
		return Loader::$instance;
	}


	public function initTasks(){



	}

	public function initEvents(){
		$c = new Config($this->getDataFolder() . "config.yml");
		 if($c->get("AntiCheat") === true) {
			 $this->getLogger()->info($this->getPrefix() . "§aAntiCheat Loaded");
		 	$this->getServer()->getPluginManager()->registerEvents(new AntiCheat(), $this);
		 } else {
		 	$this->getLogger()->info($this->getPrefix() . "§cAntiCheat disabled!");
		 }

		if($c->get("CommandSpy") === true) {
			$this->getServer()->getPluginManager()->registerEvents(new CommandEvent(), $this);
			$this->getLogger()->info($this->getPrefix() . "§aCommandSpy Loaded");
		} else {
			$this->getLogger()->info($this->getPrefix() . "§cCommandSpy disabled!");
		}
		if($c->get("Scoreboard") === true) {
			$this->getServer()->getPluginManager()->registerEvents(new Scoreboard(), $this);
			$this->getLogger()->info($this->getPrefix() . "§aScoreboard Loaded");

			 if(!(file_exists($this->getDataFolder() . "scoreboard.json"))) {

				 $scorec = new Config($this->getDataFolder() . "scoreboard.json", Config::JSON);
				 $scorec->setAll([



				 	 'Title' => 'SERVER.NET',
					 'Description' => 'Description of Scoreboard'

				 ]);
				 $scorec->save();
			 }
		} else {
			$this->getLogger()->info($this->getPrefix() . "§cScoreboard disabled!");
		}


		if($c->get("AlwaysSpawn") === true) {

			$this->getServer()->getPluginManager()->registerEvents(new AlwaysSpawn(), $this);
			$this->getLogger()->info($this->getPrefix() . "§aAlwaysSpawn Loaded");
		} else {

			$this->getLogger()->info($this->getPrefix() . "§cAlwaysSpawn disabled!");
		}
		if($c->get("KeepInventory") === true) {

			$this->getServer()->getPluginManager()->registerEvents(new KeepInventory(), $this);
			$this->getLogger()->info($this->getPrefix() . "§aKeepInventory Loaded");
		} else {

			$this->getLogger()->info($this->getPrefix() . "§cKeepInventory disabled!");
		}
		if($c->get("PlayerCloud") === true) {

			$this->getServer()->getPluginManager()->registerEvents(new PlayerCloud(), $this);
			$this->getLogger()->info($this->getPrefix() . "§aPlayerCloud Loaded");
		} else {

			$this->getLogger()->info($this->getPrefix() . "§cPlayerCloud disabled!");
		}
	}


}
