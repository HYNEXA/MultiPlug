<?php
/**
 * Created by PhpStorm.
 * User: RiipZuu
 * Date: 06.01.2019
 * Time: 23:48
 */

namespace RiipZuu\spawn;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use RiipZuu\Loader;

class AlwaysSpawn implements Listener {


	public function onJoin(PlayerJoinEvent $event){

		$player = $event->getPlayer();

		$player->teleport(Loader::getInstance()->getServer()->getDefaultLevel()->getSafeSpawn());
		$player->sendMessage(Loader::getInstance()->getPrefix() . "§l§aWelcome on The Spawn");
	}

}