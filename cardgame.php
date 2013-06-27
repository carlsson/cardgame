<?php
class Player{

    public $name;
    public $hand = array();

    public function __construct($name){
        $this->name = $name;
    }

    public function give($card){
        array_push($this->hand, $card);
    }
}

class Deck{

    protected $ranks = array("2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K", "A");
    protected $suits = array("S", "D", "C", "H");
    public $cards = array();

    public function __construct(){
        $this->createCards();
    }

    protected function createCards(){
        $this->cards = array();
        foreach($this->ranks as $rank){
            foreach($this->suits as $suit){
                $card = sprintf("%s%s", $rank, $suit);
                array_push($this->cards, $card);
            }
        }
    }

    public function shuffle(){
        shuffle($this->cards);
    }

    public function deal(){
        if(empty($this->cards)){
            return Null;
        }
        return array_shift($this->cards);
    }
}

class Game{

    public $players = array();
    public $deck;
    protected $cardsPerPlayer = 5;

    public function __construct($deck){
        $this->deck = $deck;
        $this->deck->shuffle();
    }

    public function addPlayer($player){
        array_push($this->players, $player);
    }

    function dealCards(){
        for($i = 0; $i < $this->cardsPerPlayer; $i++){
            foreach($this->players as $player){
                $card = $this->deck->deal();
                if(is_null($card)){
                    throw new Exception("Not enough cards in the deck");
                }
                $player->give($card);
            }
        }
    }
}

class XMLRenderer{

    private $game;

    function __construct($game){
        $this->game = $game;
    }

    function render(){
        $this->xml = new SimpleXMLElement('<xml/>');
        $this->addPlayers($game->players);
        return $xml;
    }

    private function addPlayers($players){
        $track = $this->xml->addChild('player');
    }

    private function addPlayer($player){

    }

    private function addCards(){

    }
}
