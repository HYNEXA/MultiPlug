<?php
/**
 * Created by PhpStorm.
 * User: RiipZuu
 * Date: 06.01.2019
 * Time: 20:36
 */

namespace RiipZuu\playercloud;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerPreLoginEvent;
use pocketmine\utils\Config;
use RiipZuu\Loader;

class PlayerCloud implements Listener {

	/**
	 * @param PlayerPreLoginEvent $event
	 * @throws \Exception
	 */
	public function onPLogin(PlayerJoinEvent $event){

		$player = $event->getPlayer();

		if(!file_exists(Loader::getInstance()->getDataFolder() . $player->getName() . ".json")){
			$c = new Config(Loader::getInstance()->getDataFolder() . $player->getName() . ".json", Config::JSON);
			$c->setAll([

				"IP" => $player->getAddress(),
				"UUID" => $player->getUniqueId()->toString(),
				"XboxID" => $player->getXuid(),
				"ID" => random_int(1, 999999)



			]);
			$c->save();

			$p = new Config(Loader::getInstance()->getDataFolder() . $c->get("ID") . ".json", Config::JSON);
			$p->setAll([

				"Name" => $player->getName()

			]);
			$player->sendMessage(Loader::getInstance()->getPrefix() . "§aWelcome your User ID is §6" . $c->get("ID"));
			$p->save();
		}
		$c = new Config(Loader::getInstance()->getDataFolder() . $player->getName() . ".json");


		$player->sendMessage(Loader::getInstance()->getPrefix() . "§aWelcome your User ID is §6" . $c->get("ID"));


	}
}