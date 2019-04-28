<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Book;

class BookController extends Controller
{
    /*
     * GET /books/
     */
    public function index()
    {
        //$newBooks = Book::latest()->limit(3)->get();

        $books = Book::orderBy('title')->get();

        $newBooks = $books->sortByDesc('created_at')->take(3);

        return view('books.index')->with([
            'books' => $books,
            'newBooks' => $newBooks,
        ]);
    }

    /*
     * GET /books/{id}
     */
    public function show($id)
    {
       $book = Book::find($id);

        if (!$book) {
            return redirect('/books')->with([
            'alert' => 'The book you were looking for was not found.',
            ]);
        }

        return view('books.show')->with([
            'book' => $book
        ]);
    }

    /*
     * GET /books/search
     */
    public function search(Request $request)
    {
        $searchTerm = $request->session()->get('searchTerm', '');
        $caseSensitive = $request->session()->get('caseSensitive', false);
        $books = $request->session()->get('books', null);

        return view('books.search')->with([
            'searchTerm' => $searchTerm,
            'caseSensitive' => $caseSensitive,
            'books' => $books,
        ]);
    }

    public function searchProcess(Request $request)
    {

        $request->validate([
            'searchTerm' => 'required'
        ]);

        # Start with an empty array of search results; books that
        # match our search query will get added to this array
        $searchResults = [];

        # Store the searchTerm in a variable for easy access
        # The second parameter (null) is what the variable
        # will be set to *if* searchTerm is not in the request.
        $searchTerm = $request->input('searchTerm', null);

        # Only try and search *if* there's a searchTerm
        if ($searchTerm) {
            if ($request->has('caseSensitive')) {
                $books = Book::whereRaw("BINARY title  = '$searchTerm' ")->get();
            }
            else {
                $books = Book::where('title', '=', $searchTerm)->get();
            }
        }

        # Redirect back to the search page w/ the searchTerm *and* searchResults (if any) stored in the session
        # Ref: https://laravel.com/docs/redirects#redirecting-with-flashed-session-data
        return redirect('/books/search')->with([
            'searchTerm' => $searchTerm,
            'caseSensitive' => $request->has('caseSensitive'),
            'books' => $books
        ]);
    }

    /*
     * GET /books/create
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * POST /books
     * Process the form for adding a new book
     */
    public function store(Request $request)
    {
        # Validate the request data
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'published_year' => 'required|digits:4',
            'cover_url' => 'required|url',
            'purchase_url' => 'required|url'
        ]);

        # Note: If validation fails, it will redirect the visitor back to the form page
        # and none of the code that follows will execute.

        $book = new Book();

        # Set the properties
        # Note how each property corresponds to a field in the table
        $book->title = $request->title;
        $book->author = $request->author;
        $book->published_year = $request->published_year;
        $book->cover_url = $request->cover_url;
        $book->purchase_url = $request->purchase_url;

        # Invoke the Eloquent `save` method to generate a new row in the
        # `books` table, with the above data
        $book->save();

        return redirect('books/create')->with([
            'alert' => 'The book '. $book->title .' was added.'
        ]);
    }

    /*
* GET /books/{id}/edit
*/
    public function edit($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return redirect('/books')->with([
                'alert' => 'The book you were looking for was not found.',
            ]);
        }

        return view('books.edit')->with([
            'book' => $book,
        ]);
    }

    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        # Set the properties
        # Note how each property corresponds to a field in the table
        $book->title = $request->title;
        $book->author = $request->author;
        $book->published_year = $request->published_year;
        $book->cover_url = $request->cover_url;
        $book->purchase_url = $request->purchase_url;

        # Invoke the Eloquent `save` method to generate a new row in the
        # `books` table, with the above data
        $book->save();

        return redirect('books/'.$id.'/edit')->with([
            'alert' => 'Your changes were saved.'
        ]);
    }

    /*
    * DELETE /books/{id}
    */
    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return redirect('/books')->with([
                'alert' => 'The book you were looking for was not found.',
            ]);
        }

        $book->delete();

        return redirect('books')->with([
            'alert' => 'The book '. $book->title .' was deleted.'
        ]);
    }
}