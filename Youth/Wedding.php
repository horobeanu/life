<?php
/**
 * The code that changed my life.
 * ----------------------------------------------------------
 *                                   _      Daniel and Adina
 *             ___            {@}  _|=|_
 *            /___\          /(")\  (")
 *         .---'-'---.      /((~))\/<x>\        _   .-.
 *        /___________\     ~~/@\~~\|_|/       {v} ((_))
 *         | A /^\ A |       /   \  |||       ((_)) '-'
 *         |   |"|   |      /~@~@~\ |||        '-'
 *     ____|___|_|___|_____/_______\|||_____June 25 2016_____
 */
class Wedding extends Event implements Invitation
{
    public function __construct() 
    {
        $husband = new Person('Daniel Horobeanu');
        $wife = new Person('Adina Bulbes');
        $weddingEvent = $this->gettingMarried($husband, $wife);
        $party = new Party('Wedding Dinner, Dance, Fun & Joy');
        $location = array(
            'name' => 'Restaurantul Grandis Apulum',
            'address' => 'B-dul Dacia, nr.14 A',
            'city' => 'Mioveni',
            'county' => 'Arges'
        );
        $party->setLocation($location);
        $party->setDate(new DateTime('2016-06-25'));
        $party->setTime('19:00');
        
        $you = new Person('Family or Friend');
        try {
            $this->invite($you, $party, $weddingEvent);
        } catch (RefuseException $exception) {
            echo 'Something bad happened ' . $exception->getReason();
        }
    }
    
    public function gettingMarried($husband, $wife)
    {
        return new CeremonyEvent($husband, $wife, 'Biserica Valea Titesti');
    }
    
    public function invite($you, $party, $weddingEvent)
    {
        $you->setGoodMood(true);
        $you->setAttend($weddingEvent);
        // confirm 14 days before the event
        $party->confirm($party->getDate()->sub(new DateInterval('P14D')));
    }
}