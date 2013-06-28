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

class Card{

    public $suit;
    public $rank;

    public function __construct($rank, $suit){
        $this->rank = $rank;
        $this->suit = $suit;
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
                array_push($this->cards, new Card($rank, $suit));
            }
        }
    }

    public function shuffle(){
        shuffle($this->cards);
    }

    public function deal(){
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
        $this->xml = new SimpleXMLElement('<game/>');
        $this->addPlayers();
        return $this->xml->asXml();
    }

    private function addPlayers(){
        foreach($this->game->players as $player){
            $this->playerxml = $this->xml->addChild('player');
            $this->playerxml->addAttribute('name', $player->name);
            $this->addCards($player);
        }
    }

    private function addCards($player){
        foreach($player->hand as $card){
            $cardxml = $this->playerxml->addChild('card');
            $cardxml->addAttribute("rank", $card->rank);
            $cardxml->addAttribute("suit", $card->suit);
        }
    }
}
