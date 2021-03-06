<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use IanLChapman\PigLatinTranslator\Parser;
use App\Book;
use App\Author;
use App\Course;
use App\Department;

class PracticeController extends Controller
{

    /**
     *
     */
    public function practice24()
    {
        $course = Course::where('name', '=', 'Dynamic Web Applications')->first();
        //dump($course->name);
        //dump($course);
        //dump($course->toArray());
        //dump($course->credits);
        echo $course;
    }
    /**
     *
     */
    public function practice23()
    {
        $course = Course::where('name', '=', 'Dynamic Web Applications')->first();
        //dump($course->name);
        //dump($course);
        //dump($course->toArray());
        //dump($course->credits);
        echo $course;
    }

    /**
     *
     */
    public function practice22()
    {
        $courses = Course::with('department')->get();

        foreach($courses as $course) {

            dump($course->department);

        }
    }

    /**
     *
     */
    public function practice21()
    {
        $courses = Course::all();

        foreach($courses as $course) {

            dump($course->department);

        }
    }

    /**
     *
     */
    public function practice20()
    {
        $books = Book::with('tags')->get();
        foreach($books as $book) {
            dump($book->title);
            foreach ($book->tags as $tag) {
                dump($tag->name);
            }
        }
    }

    /**
     *
     */
    public function practice19()
    {
        # Get the first book as an example
        $books = Book::with('author')->get();;
        foreach ($books as $book) {
            dump($book->title.' was written by '.$book->author->first_name.' '.$book->author->last_name);
        }
    }

    /**
     *
     */
    public function practice18()
    {
        # Get the first book as an example
        $book = Book::first();

        # Get the author from this book using the "author" dynamic property
        # "author" corresponds to the the relationship method defined in the Book model
        $author = $book->author;
        dump($author->toArray());

        # Output
        //dump($book->title.' was written by '.$author->first_name.' '.$author->last_name);
        //dump($book->toArray());
    }

    /**
     *
     */
    public function practice17()
    {
        $author = Author::where('first_name', '=', 'J.K.')->first();

        $book = new Book();
        $book->title = "Fantastic Beasts and Where to Find Them";
        $book->published_year = 2017;
        $book->cover_url = 'http://prodimage.images-bn.com/pimages/9781338132311_p0_v2_s192x300.jpg';
        $book->purchase_url = 'http://www.barnesandnoble.com/w/fantastic-beasts-and-where-to-find-them-j-k-rowling/1004478855';
        $book->author()->associate($author); # <--- Associate the author with this book
        $book->save();
        dump($book->toArray());
    }

    /**
     *
     */
    public function practice16()
    {
        $books = Book::all();
        echo $books;
    }

    /**
     *
     */
    public function practice15()
    {
        $books = Book::all();
        dump($books->toArray());
        # loop through the Collection and access just the data
        foreach ($books as $book) {
            dump($book->title);
        }
    }

    /**
     *
     */
    public function practice14()
    {
        #Remove any/all books with an author name that includes the string “Rowling”.
        # First get a books to delete
        $books = Book::where('author', 'LIKE', '%Rowling%')->delete();
        dump('Deletion complete; check the database to see if it worked...');
    }

    /**
     *
     */
    public function practice13()
    {
        #Find any books by the author “J.K. Rowling” and update the author name to be “JK Rowling”
        # First get a book to update
        $books = Book::where('author', '=', 'J.K. Rowling')->update(['author' => 'JK Rowling']);
        dump('Update complete; check the database to confirm the update worked.');
    }

    /**
     *
     */
    public function practice12()
    {
        #Retrieve all the books in descending order according to published date.
        $books = Book::orderBy('published_year', 'desc')->get();
        Book::dump($books);
    }

    /**
     *
     */
    public function practice11()
    {
        #Retrieve all the books in alphabetical order by title.
        $books = Book::orderBy('title')->get();
        Book::dump($books);
    }

    /**
     *
     */
    public function practice10()
    {
        #Retrieve all the books published after 1950.
        $books = Book::where('published_year', '>', '1950')->get();
        Book::dump($books);
    }

    /**
     *
     */
    public function practice9()
    {
        # Retrieve the last 2 books that were added to the books table.
        $books = Book::orderBy('created_at', 'desc')->limit(2)->get();

        Book::dump($books);
    }

    /**
     *
     */
    public function practice8()
    {
        # First get a book to delete
        $book = Book::where('author', '=', 'F. Scott Fitzgerald')->first();

        if (!$book) {
            dump('Did not delete- Book not found.');
        } else {
            $book->delete();
            dump('Deletion complete; check the database to see if it worked...');
        }
    }

    /**
     *
     */
    public function practice7()
    {
        # First get a book to update
        $book = Book::where('author', '=', 'F. Scott Fitzgerald')->first();

        if (!$book) {
            dump("Book not found, can't update.");
        } else {
            # Change some properties
            $book->title = 'The Really Great Gatsby';
            $book->published_year = '2025';

            # Save the changes
            $book->save();

            dump('Update complete; check the database to confirm the update worked.');
        }
    }

    /**
     *
     */
    public function practice6()
    {
        $book = new Book();
        $books = $book->where('title', 'LIKE', '%Harry Potter%')->get();

        if ($books->isEmpty()) {
            dump('No matches found');
        } else {
            foreach ($books as $book) {
                dump($book->title);
            }
        }
    }

    /**
     *
     */
    public function practice5()
    {
        $book = new Book();

        # Set the properties
        # Note how each property corresponds to a field in the table
        $book->title = 'Harry Potter and the Sorcerer\'s Stone';
        $book->author = 'J.K. Rowling';
        $book->published_year = 1997;
        $book->cover_url = 'http://prodimage.images-bn.com/pimages/9780590353427_p0_v1_s484x700.jpg';
        $book->purchase_url = 'http://www.barnesandnoble.com/w/harry-potter-and-the-sorcerers-stone-j-k-rowling/1100036321?ean=9780590353427';

        # Invoke the Eloquent `save` method to generate a new row in the
        # `books` table, with the above data
        $book->save();

        dump($book->toArray());
    }

    /**
     *
     */
    public function practice3()
    {
        $translator = new Parser();
        $translation = $translator->translate('Hello World');
        dump($translation);
    }

    /**
     *
     */
    public function practice2()
    {
        return 'Need help? Email us at ' . config('mail.supportEmail');
    }

    /**
     * Demonstrating the first practice example
     */
    public function practice1()
    {
        dump('This is the first example.');
    }

    /**
     * ANY (GET/POST/PUT/DELETE)
     * /practice/{n?}
     * This method accepts all requests to /practice/ and
     * invokes the appropriate method.
     * http://foobooks.loc/practice => Shows a listing of all practice routes
     * http://foobooks.loc/practice/1 => Invokes practice1
     * http://foobooks.loc/practice/5 => Invokes practice5
     * http://foobooks.loc/practice/999 => 404 not found
     */
    public function index($n = null)
    {
        $methods = [];

        # Load the requested `practiceN` method
        if (!is_null($n)) {
            $method = 'practice' . $n; # practice1

            # Invoke the requested method if it exists; if not, throw a 404 error
            return (method_exists($this, $method)) ? $this->$method() : abort(404);
        } # If no `n` is specified, show index of all available methods
        else {
            # Build an array of all methods in this class that start with `practice`
            foreach (get_class_methods($this) as $method) {
                if (strstr($method, 'practice')) {
                    $methods[] = $method;
                }
            }

            # Load the view and pass it the array of methods
            return view('practice')->with(['methods' => $methods]);
        }
    }
}
