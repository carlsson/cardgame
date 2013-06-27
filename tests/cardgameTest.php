<?php
$root = dirname( dirname(__FILE__) );
require_once $root . "/cardgame.php";

class DeckTestCase extends PHPUnit_Framework_TestCase {

    public function testCreate(){
        $deck = new Deck();
        $this->assertEquals(52, count($deck->cards));
    }

    public function testDeal(){
        $deck = new Deck();
        $card = $deck->deal();
        $this->assertEquals(51, count($deck->cards));
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

    }
}
