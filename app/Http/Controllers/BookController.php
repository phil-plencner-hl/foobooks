<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class BookController extends Controller
{
    /*
     * GET /books/
     */
    public function index()
    {
        return view('books.index');
    }

    /*
     * GET /books/{title}
     */
    public function show($title)
    {
        return view('books.show')->with([
            'title' => $title
        ]);
    }

    /*
     * GET /books/search
     */
    public function search(Request $request)
    {
        $searchTerm = $request->session()->get('searchTerm', '');
        $caseSensitive = $request->session()->get('caseSensitive', false);
        $searchResults = $request->session()->get('searchResults', null);

        return view('books.search')->with([
            'searchTerm' => $searchTerm,
            'caseSensitive' => $caseSensitive,
            'searchResults' => $searchResults,
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
            # Open the books.json data file
            # database_path() is a Laravel helper to get the path to the database folder
            # See https://laravel.com/docs/helpers for other path related helpers
            $booksRawData = file_get_contents(database_path('/books.json'));

            # Decode the book JSON data into an array
            # Nothing fancy here; just a built in PHP method
            $books = json_decode($booksRawData, true);

            # Loop through all the book data, looking for matches
            # This code was taken from v0 of foobooks we built earlier in the semester
            foreach ($books as $title => $book) {
                # Case sensitive boolean check for a match
                if ($request->has('caseSensitive')) {
                    $match = $title == $searchTerm;
                    # Case insensitive boolean check for a match
                } else {
                    $match = strtolower($title) == strtolower($searchTerm);
                }

                # If it was a match, add it to our results
                if ($match) {
                    $searchResults[$title] = $book;
                }
            }
        }

        # Redirect back to the search page w/ the searchTerm *and* searchResults (if any) stored in the session
        # Ref: https://laravel.com/docs/redirects#redirecting-with-flashed-session-data
        return redirect('/books/search')->with([
            'searchTerm' => $searchTerm,
            'caseSensitive' => $request->has('caseSensitive'),
            'searchResults' => $searchResults
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

        # Code will eventually go here to add the book to the database,
        # but for now we'll just dump the form data to the page for proof of concept
        dump($request->all());
    }
}
