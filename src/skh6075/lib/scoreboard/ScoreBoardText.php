<?php

declare(strict_types=1);

namespace skh6075\lib\scoreboard;

use JetBrains\PhpStorm\Pure;
use pocketmine\block\utils\SignText;
use pocketmine\network\mcpe\protocol\types\ScorePacketEntry;

final class ScoreBoardText{

	public string $title;
	public array $contents;

	#[Pure]
	public static function create(string $title, array $contents): ScoreBoardText{
		$result = new self;
		$result->title = $title;
		$result->contents = $contents;
		return $result;
	}

	/** @return ScorePacketEntry[] */
	#[Pure]
	public function entries(string $objectName): array{
		$entries = [];
		foreach($this->contents as $index => $content){
			$entry = new ScorePacketEntry();
			$entry->objectiveName = $objectName;
			$entry->score = $index;
			$entry->type = ScorePacketEntry::TYPE_FAKE_PLAYER;
			$entry->scoreboardId = $index;
			$entry->customName = $content;
			$entries[] = $entry;
		}
		return $entries;
	}
}