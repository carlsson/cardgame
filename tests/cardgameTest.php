<?php
$root = dirname( dirname(__FILE__) );
require_once $root . "/cardgame.php";

class DeckTestCase extends PHPUnit_Framework_TestCase {

    public function setUp(){
        $this->deck = new Deck();
    }

    public function testCreate(){
        $this->assertEquals(52, count($this->deck->cards));
    }

    public function testDeal(){
        $card = $this->deck->deal();
        $this->assertEquals(51, count($this->deck->cards));
    }
}

class GameTestCase extends PHPUnit_Framework_TestCase {

    public function setUp(){
        $deck = new Deck();
        $this->game = new Game($deck);
    }

    public function testDealCards(){
        $player = new Player("test");
        $this->game->addPlayer($player);
        $this->game->dealCards();
        $this->assertEquals(5, count($player->hand));
        $this->assertEquals(47, count($this->game->deck->cards));

    }
}

class XMLRendererTestCase extends PHPUnit_Framework_TestCase {

    public function testRender(){
        $game = new Game(new Deck());
        $player = new Player("test");
        $player->give(new Card("10", "H"));
        $game->addPlayer($player);
        $renderer = new XMLRenderer($game);
        $xml = $renderer->render();
        $trimmed_xml = preg_replace('/^\s+|\n|\r|\s+$/m', '', $xml);
        $this->assertEquals('<?xml version="1.0"?><game><player name="test"><card rank="10" suit="H"/></player></game>', $trimmed_xml);
    }
}
