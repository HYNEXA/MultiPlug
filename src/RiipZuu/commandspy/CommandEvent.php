<?php
/**
 * Created by PhpStorm.
 * User: RiipZuu
 * Date: 06.01.2019
 * Time: 15:36
 */

namespace RiipZuu\commandspy;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerCommandPreprocessEvent;
use RiipZuu\Loader;


class CommandEvent implements Listener {

	/**
	 * @param PlayerCommandPreprocessEvent $event
	 */
	public function onCMDSpy(PlayerCommandPreprocessEvent $event){

		$message = $event->getMessage();
		$player = $event->getPlayer();

		 if($message[0] == "/"){

		 	Loader::getInstance()->getLogger()->info("§b{$player->getName()} §8>§6 " . $message);
		}

	}

}