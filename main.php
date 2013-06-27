<?php
require "cardgame.php";
$deck = new Deck();
$game = new Game($deck);
$game->addPlayer(new Player("Player 1"));
$game->addPlayer(new Player("Player 2"));
$game->addPlayer(new Player("Player 3"));
$game->addPlayer(new Player("Player 4"));
$game->addPlayer(new Player("Player 5"));
$game->dealCards();
$renderer = new XMLRenderer($game);
print $renderer->render();