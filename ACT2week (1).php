<?php
class Book {
    public $title;         // Public
    protected $author;     // Protected
    private $price;        // Private

    // Constructor to initialize title, author, and price
    public function __construct($title, $author, $price) {
        $this->title = $title;
        $this->author = $author;
        $this->price = $price;
    }

    // Method to get details of the book
    public function getDetails() {
        return "Title: {$this->title}, Author: {$this->author}, Price: {$this->price}<br/>";
    }

    // Method to set or update the price of the book
    public function setPrice($price) {
        $this->price = $price;
    }

    // Magic __call method to simulate method overloading
    public function __call($method, $arguments) {
        if ($method == "updateStock") {
            echo "Stock updated for '{$this->title}' with arguments: " . implode(', ', $arguments) . "<br/>";
        } else {
            echo "Method '{$method}' not found for Book class<br/>";
        }
    }
}

class Library {
    public $name;          // Public
    private $books = [];   // Private array to store Book objects

    // Constructor to initialize the library name
    public function __construct($name) {
        $this->name = $name;
    }

    // Method to add a book to the library
    public function addBook(Book $book) {
        $this->books[] = $book;
    }

    // Method to remove a book from the library by title
    public function removeBook($title) {
        foreach ($this->books as $key => $book) {
            if ($book->title == $title) {
                unset($this->books[$key]);
                echo "Book '{$title}' removed from the library.<br/>";
                return;
            }
        }
        echo "Book '{$title}' not found in the library.<br/>";
    }

    // Method to list all books in the library
    public function listBooks() {
        echo "Books in the Library:<br/>";
        foreach ($this->books as $book) {
            echo $book->getDetails();
        }
    }

    public function removedbook() {
        foreach ($this->books as $book) {
            echo $book->getDetails();
        }
    }

    
    // Destructor to clean up the library when it's no longer needed
    public function __destruct() {
        echo "Library {$this->name} is closing.<br/>";
    }
}

// Implementation

// Create instances of Book
$book1 = new Book("The Great Gatsby", "F. Scott Fitzgerald", 22.99);
$book2 = new Book("To Kill a Mockingbird", "Harper Lee", 24.99);
$book3 = new Book("1984", "George Orwell", 8.99);


// Create instance of Library
$library = new Library("My Library");

// Add books to the library
$library->addBook($book1);
$library->addBook($book2);
$library->addBook($book3);


// Update the price of a book
$book2->setPrice(25.99);

// Call a non-existent method on a Book object (triggers __call)
$book1->updateStock(50);

// List all books in the library
$library->listBooks();

// Remove a book from the library
$library->removeBook("To Kill a Mockingbird");

// List books after removal
echo "Books in the Library after removal:<br/>";
$library->removedbook();

// Destructor will be called automatically when script ends
?>
