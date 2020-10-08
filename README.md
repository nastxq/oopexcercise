# oopexcercise
PHP OOP excersise


Create office where employees generate randomly and take created before rooms 

Quick guide how to create objects to make it work

$firstRoom = new Room();

$first = new Human('name');

$newRooms = new Rooms();   // One object for entire office

$newRooms->saveNewRoom($firstRoom);  

$newRooms->humanSetup($first);    // Save randomly generated employee data and assign him to room

$newRooms->getPeople();
