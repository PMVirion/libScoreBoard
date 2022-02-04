# libScoreBoard
PocketMine-MP virion for easy handling of ScoreBoard packets

# How to use

Connecting the scoreboard to the player
```php
public ScoreBoard $scoreBoard;

$this->scoreBoard = new ScoreBoard($player);
```

ScoreBoard Design
```php
$text = new ScoreBoardText(
	title: "SocreBoard Title",
	contents: ["Hello", "World", "!!"]
);
```

Pass the scoreboard to the player
```php
$this->scoreBoard->remove();
$this->scoreBoard->send($text);
```
