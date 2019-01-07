<?php
/**
 * Created by PhpStorm.
 * User: RiipZuu
 * Date: 06.01.2019
 * Time: 15:25
 */

namespace RiipZuu\anticheat;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerGameModeChangeEvent;
use pocketmine\event\player\PlayerToggleFlightEvent;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\network\mcpe\protocol\LoginPacket;
use pocketmine\Player;
use RiipZuu\Loader;

class AntiCheat implements Listener{

	public function onGChange(PlayerGameModeChangeEvent $event)
	{
		$player = $event->getPlayer();
		if ($player->hasPermission("multiplug.anticheat.gamemodechange")) {

		}

		if($event->getNewGamemode() == 1){
			$event->setCancelled(true);

		}
		if($event->getNewGamemode() == 2){
			$event->setCancelled(true);

		}
		if($event->getNewGamemode() == 0){
			$event->setCancelled(true);

		}
	}


	 public function onFly(PlayerToggleFlightEvent $event){
		$player = $event->getPlayer();

		if($event->isFlying()){
			if ($player->hasPermission("multiplug.anticheat.fly")){

			} else {
				$event->setCancelled(true);

			}
		}
	 }
}
