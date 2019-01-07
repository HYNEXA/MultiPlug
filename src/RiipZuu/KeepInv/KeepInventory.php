<?php
/**
 * Created by PhpStorm.
 * User: RiipZuu
 * Date: 07.01.2019
 * Time: 00:27
 */

namespace RiipZuu\KeepInv;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;

class KeepInventory implements Listener {

	public function onDeath(PlayerDeathEvent $event) {

		$event->setKeepInventory(true);

	}
}