<?php

declare(strict_types=1);

namespace skh6075\lib\scoreboard;

use pocketmine\network\mcpe\protocol\RemoveObjectivePacket;
use pocketmine\network\mcpe\protocol\SetDisplayObjectivePacket;
use pocketmine\network\mcpe\protocol\SetScorePacket;
use pocketmine\player\Player;

final class ScoreBoard{

	public function __construct(public Player $player){}

	private function createTitle(ScoreBoardText $text): SetDisplayObjectivePacket{
		return SetDisplayObjectivePacket::create(
			displaySlot: 'sidebar',
			objectiveName: $this->player->getName(),
			displayName: $text->title,
			criteriaName: 'dummpy',
			sortOrder: 0
		);
	}

	private function createScorePacket(ScoreBoardText $text): SetScorePacket{
		return SetScorePacket::create(SetScorePacket::TYPE_CHANGE, $text->entries($this->player->getName()));
	}

	public function send(ScoreBoardText $text): void{
		if(!$this->player->getNetworkSession()->isConnected()){
			return;
		}
		$this->player->getNetworkSession()->sendDataPacket($this->createTitle($text));
		$this->player->getNetworkSession()->sendDataPacket($this->createScorePacket($text));
	}

	public function remove(): void{
		if(!$this->player->getNetworkSession()->isConnected()){
			return;
		}
		$this->player->getNetworkSession()->sendDataPacket(RemoveObjectivePacket::create($this->player->getName()));
	}
}