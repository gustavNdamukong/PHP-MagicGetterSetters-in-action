
# PHP-MagicGetterSetters-in-action

    The trait Adapter has the magic properties __set() and __get(). They allow you to set and retrieve the values of properties without having to
    explicitly have a setter or getter method on the calling object. I have designed this trait to have a constructor that will detect the class that
    is calling it, and record that class in its $callingClass property. That way it is not only extendable; but it knows to run its operations
    of getting and setting property values on the right class.

    As can be seen in the example, the __set() magic method accepts a property name and a value. This property is the target property whose value you
    are about to set or modify with the value ($value) in the second argument.
    The first thing it does is to check if the property you are targeting actually exists on the target/calling class. If it does exist; it modifies
    its value, otherwise, it throws an exception saying that property cannot be set because it does not exist on the target object.

    The __get() method of the Adapter trait works similarly, though it only accepts one argument; the property whose value you are trying to retrieve.
    It also checks on the calling object if that property exists. If it does, it returns its value, otherwise, it throws an exception saying the value
    of a non-existent property cannot be retrieved.

    To use it, create an object that will us this Adapter trait and it will have the __set() and __get() available to it.
    Here is an example:

```$test = new Test();

       try {
           //setting non-existent property
           $test->keys = 'myKeys';
           //retrieving non-existent property
           echo $test->keys;

           //setting value of existing property
           $test->name = 'John Bands';
           //retrieving value of existing property
           echo $test->name;
       }
       catch(Exception $e)
       {
           echo "Message: " .$e->getMessage();
       }
```


    The Test class have the two properties name and contact. Trying to assign a value to these properties will work just fine, but if the Test class tries to assign a value
    to another property that does not exist on itself, it will fail and cause an exception being thrown.


# WHY DID I USE A TRAIT

    For the design I chose a trait because, while a simple class would have worked just as well, a trait would make this functionality even more
    extendable. PHP has an inherent issue of not supporting multiple inheritance, and so I think that when you have some extra feature like this
    getter-setter functionality that you think may be good for your application, making it widely available to all your objects is a good idea. Your
    other objects will be able to use it as needed, while others that do not need it will simply not use the trait.

    An interface would not work well in this case because interfaces supply a template pattern for your application design. An interface declares
    methods but does not define these methods itself. It is the duty of the implementing objects to define the content of the methods it specifies
    for them. This is great because it allows a group of objects having a common class and methods to implement these methods differently. This
    getter-setter feature is not suitable for such a design, since the functionality needs to be defined and should work identically for all the
    objects subscribing to it.

    This is why I chose to use a trait for this MagicGetterSetter application.