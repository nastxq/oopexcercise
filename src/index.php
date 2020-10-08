<?php

class Human extends Employee
{

    public string $name;
    public Human $peopleMet;
    public Room $visitedRooms;
    public Employee $createEmployee;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->createEmployee = new Employee();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function __toString(): string
    {
        return (string)$this->name;
    }

    public function newEmployee()
    {
        $this->createEmployee->generateRandomAge();
        $this->createEmployee->employeeProfession();
        return $this->createEmployee->getProfession();
    }


    public function setupHumanEmployee()
    {
        $whichProfession = $this->newEmployee();
        $name = $this->getName();

        return array(
            'name' => $name,
            'profession' => $whichProfession,
        );
    }


}

class Room
{
    public int $number;
    public int $capacity;


    public function setRoom(int $capacity, int $number): void
    {
        if (filter_var($number, FILTER_VALIDATE_INT) === false) {
            throw new \InvalidArgumentException("$number is not valid");
        } else {
            if (filter_var($capacity, FILTER_VALIDATE_INT) === false) {
                throw new \InvalidArgumentException("$capacity is not valid");
            }
        }
        $this->number = $number;
        $this->capacity = $capacity;
    }


    public function getNumber(): int
    {
        return $this->number;
    }

    public function getCapacity(): int
    {
        return $this->capacity;
    }


}

class Rooms
{
    public Room $newRooms;
    public Human $humanData;

    public array $roomsWithPeople;

    public array $officeRooms;
    public array $employeeData;

    public int $genRoomNumber;

    public Profession $professionObject;


    public function saveNewRoom(Room $newRooms)
    {
        $this->newRooms = $newRooms;

        if (empty($this->officeRooms)) {
            $this->officeRooms = array($this->newRooms->getNumber() => $this->newRooms->getCapacity());
        } else {
            $this->officeRooms[$this->newRooms->getNumber()] = $this->newRooms->getCapacity();
        }
    }

    public function humanSetup(Human $humanData)
    {
        $this->humanData = $humanData;
        $this->employeeData = $this->humanData->setupHumanEmployee();
        $this->generateRoomNumber();
        $this->filterRoom();
    }

    public function generateRoomNumber()
    {
        $this->genRoomNumber = rand(1, 5);
    }

    public function getRoomNumber()
    {
        return $this->genRoomNumber;
    }


    public function getEmployeeName()
    {
        return $this->employeeData['name'];
    }

    public function getEmployeeProfession()
    {
        return $this->employeeData['profession'];
    }

    public function getEmployees()
    {
        return $this->employeeData;
    }

    public function professionCount()
    {
        foreach ($this->roomsWithPeople as $professions => $value) {
            for ($i = 1; $i <= sizeof($this->roomsWithPeople[$professions]); $i++) {
             
                $this->professionObject = $this->roomsWithPeople[$professions][$i - 1]['profession'];


            }
        }
    }

 

    public function filterRoom()
    {
        if (array_key_exists(
                $this->getRoomNumber(),
                $this->officeRooms
            ) && empty($this->roomsWithPeople[$this->getRoomNumber()])) {
            // No one is in room
            $this->roomsWithPeople[$this->getRoomNumber()][0] = $this->employeeData;
        } else {
            if (array_key_exists($this->getRoomNumber(), $this->officeRooms)) {
                // There's place in room
                if ($this->officeRooms[$this->getRoomNumber()] > sizeof(
                        $this->roomsWithPeople[$this->getRoomNumber()]
                    )) {
                    array_push($this->roomsWithPeople[$this->getRoomNumber()], $this->employeeData);
                } // There's no place in room
                else {
                    if ($this->officeRooms[$this->getRoomNumber()] <= sizeof(
                            $this->roomsWithPeople[$this->getRoomNumber()]
                        )) {
                        $this->generateRoomNumber();
                        return $this->filterRoom();
                    }
                }
            }
        }
    }

    public function getPeople()
    {
        return $this->roomsWithPeople;
    }


    public function getRooms()
    {
        return $this->officeRooms;
    }

    public function getData()
    {
        return $this->employeeData;
    }

}

class Employee
{

    public Profession $whichProfession;
    public int $age;

    public function __construct()
    {
        $this->whichProfession = new Profession('none');
    }

    public function generateRandomAge()
    {
        $this->age = rand(20, 50);
    }


    public function employeeProfession()
    {
        if ($this->age >= 20 && $this->age <= 30) {
            $this->whichProfession = $this->whichProfession->phpProgrammer();
        } else {
            if ($this->age >= 30 && $this->age <= 40) {
                $this->whichProfession = $this->whichProfession->angularProgrammer();
            } else {
                if ($this->age >= 40 && $this->age <= 50) {
                    $this->whichProfession = $this->whichProfession->tester();
                }
            }
        }
    }

    public function getProfession()
    {
        return $this->whichProfession;
    }

    public function getRandomAge()
    {
        return $this->age;
    }


}

class Profession
{

    public string $givenProfession;

    public function __construct(string $givenProfession)
    {
        $this->givenProfession = $givenProfession;
    }

    public function equalsProfession(Profession $instance)
    {
        if ($this->givenProfession == $instance->givenProfession) {
           
        } else {
         
        }
    }


    public function phpProgrammer()
    {
        return new Profession('php');
    }

    public function angularProgrammer()
    {
        return new Profession('angular');
    }

    public function tester()
    {
        return new Profession('tester');
    }


}

class Office
{
    public Rooms $rooms;
    public Employee $employees;

    public function __construct( Rooms $rooms)
    {
       // $this->employees = $employees;
        $this->rooms = $rooms;
    }


    public function checkIfIntersect(){
       return $this->rooms->getPeople();
    }

}















