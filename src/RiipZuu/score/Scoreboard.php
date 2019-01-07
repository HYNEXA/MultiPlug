<?php
/**
 * Created by PhpStorm.
 * User: RiipZuu
 * Date: 07.01.2019
 * Time: 02:43
 */

namespace RiipZuu\score;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\network\mcpe\protocol\RemoveObjectivePacket;
use pocketmine\network\mcpe\protocol\SetDisplayObjectivePacket;
use pocketmine\network\mcpe\protocol\SetScorePacket;
use pocketmine\network\mcpe\protocol\types\ScorePacketEntry;
use pocketmine\Player;
use RiipZuu\Loader;

use pocketmine\utils\Config;

class Scoreboard implements Listener {

	/**
	 * @param Player $player
	 * @param string $title
	 * @param string $objName
	 * @param string $slot
	 * @param int $order
	 */
	public function createScoreboard(Player $player, string $title, string $objName, string $slot = "sidebar", $order = 0) {
		$pk = new SetDisplayObjectivePacket();
		$pk->displaySlot = $slot;
		$pk->objectiveName = $objName;
		$pk->displayName = $title;
		$pk->criteriaName = "dummy";
		$pk->sortOrder = $order;
		$player->sendDataPacket($pk);
	}

	/**
	 * @param PlayerJoinEvent $event
	 */
	public function onJoin(PlayerJoinEvent $event)
	{
		$pl = Loader::getInstance()->getServer()->getOnlinePlayers();
		foreach ($pl as $player) {
			$scorec = new Config(Loader::getInstance()->getDataFolder() . "scoreboard.json");
			$this->rmScoreboard($player, "objektName");
			$this->createScoreboard($player, "§6{$scorec->get("Title")}", "objektName");
			$this->setScoreboardEntry($player, 1, "§bDescription §8>", "objektName");
			$this->setScoreboardEntry($player, 2, "§e" . $scorec->get("Description") . "", "objektName");

		}
	}


	/**
	 * @param Player $player
	 * @param int $score
	 * @param string $msg
	 * @param string $objName
	 */
	public function setScoreboardEntry(Player $player, int $score, string $msg, string $objName) {
		$entry = new ScorePacketEntry();
		$entry->objectiveName = $objName;
		$entry->type = 3;
		$entry->customName = " $msg   ";
		$entry->score = $score;
		$entry->scoreboardId = $score;
		$pk = new SetScorePacket();
		$pk->type = 0;
		$pk->entries[$score] = $entry;
		$player->sendDataPacket($pk);
	}

	/**
	 * @param Player $player
	 * @param int $score
	 */
	public function rmScoreboardEntry(Player $player, int $score) {
		$pk = new SetScorePacket();
		if(isset($pk->entries[$score])) {
			unset($pk->entries[$score]);
			$player->sendDataPacket($pk);
		}
	}

	/**
	 * @param Player $player
	 * @param string $objName
	 */
	public function rmScoreboard(Player $player, string $objName) {
		$pk = new RemoveObjectivePacket();
		$pk->objectiveName = $objName;
		$player->sendDataPacket($pk);
	}
}