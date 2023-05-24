<?php

declare(strict_types=1);


namespace App;


class Customer
{
    private string $name;
    private array $rentals = [];

    // As said on previous exercice
    // If PHP >= 8 can be refactorized
    public function __construct(String $name)
    {
        $this->name = $name;
    }

    public function addRental(Rental $rental)
    {
        return $this->rentals[] = $rental;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function statement(): string {
        $totalAmount = 0.0;
        $frequentRenterPoints = 0;
        $result = "Rental Record for " . $this->getName() . "\n";

        foreach ($this->rentals as $rental){
            /* @var $rentalMovie Movie */
           $rentalMovie = $rental->getMovie();
           $thisAmount = 0.0;
           $frequentRenterPoints++;

           /* @var $rental Rental */
           // determines the amount for each line
           switch($rentalMovie->getPriceCode()) {
               case Movie::REGULAR:
                   $thisAmount += 2;
                   // Handle amount
                   if($rental->getDaysRented() > 2) {
                       $thisAmount += ($rental->getDaysRented() - 2) * 1.5;
                   }
                   // Handle renter points (no need to duplicate condition)
                   if($rental->getDaysRented() > 1) {
                        $frequentRenterPoints++;
                   }
                   break;
               case Movie::NEW_RELEASE:
                   $thisAmount += $rental->getDaysRented() * 3;
                   break;
               case Movie::CHILDREN:
                   $thisAmount += 1.5;
                   if($rental->getDaysRented() > 3) {
                       $thisAmount += ($rental->getDaysRented() - 3) * 1.5;
                   }
                   break;
           }

            $result .= "\t" . $rentalMovie->getTitle() . "\t"
                . number_format($thisAmount, 1) . "\n";
            $totalAmount += $thisAmount;

        }

        // Can be : $result .= "You owed " . number_format($totalAmount, 1)  . "\n You earned " . $frequentRenterPoints . " frequent renter points\n";
        // But losing readibility
        $result .= "You owed " . number_format($totalAmount, 1)  . "\n";
        $result .= "You earned " . $frequentRenterPoints . " frequent renter points\n";

        return $result;
    }
}