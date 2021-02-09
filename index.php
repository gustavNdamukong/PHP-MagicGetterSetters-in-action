<?php

    trait Adapter
    {

        private $callingClass = '';



        public function __construct()
        {
            $this->callingClass = get_class($this);
        }




        public function __set($property, $value)
        {
            if (property_exists($this->callingClass, $property)) {
                $this->callingClass->{$property} = $value;
            }
            else
            {
                throw new Exception("Cannot set value. Property {$property} does not exist");
            }
        }




        public function __get($property)
        {

            if (property_exists($this->callingClass, $property)) {
                return $this->callingClass->{$property};
            }
            else
            {
                throw new Exception("Cannot get value of the property {$property}, because it does not exist");
            }
        }


    }



    class Test
    {
        use Adapter;


        public $name = 'James';

        public $contact = '0123456789';

    }


    $test = new Test();

    try {
        //setting non-existent property
        //$test->keys = 'myKeys';
        //retrieving non-existent property
        //echo $test->keys;

        //setting value of existing property
        $test->name = 'John Bands';
        //retrieving value of existing property
        echo $test->name;
    }
    catch(Exception $e)
    {
        echo "Message: " .$e->getMessage();
    }