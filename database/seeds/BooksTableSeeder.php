<?php

use Illuminate\Database\Seeder;
use App\Book;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $books = [
            ['The Great Gatsby', 'F. Scott Fitzgerald', 1925, 'http://img2.imagesbn.com/p/9780743273565_p0_v4_s114x166.JPG', 'http://www.barnesandnoble.com/w/the-great-gatsby-francis-scott-fitzgerald/1116668135?ean=9780743273565'],
            ['The Bell Jar', 'Sylvia Plath', 1963, 'http://img1.imagesbn.com/p/9780061148514_p0_v2_s114x166.JPG', 'http://www.barnesandnoble.com/w/bell-jar-sylvia-plath/1100550703?ean=9780061148514'],
            ['I Know Why the Caged Bird Sings', 'Maya Angelou', 1969, 'http://img1.imagesbn.com/p/9780345514400_p0_v1_s114x166.JPG', 'http://www.barnesandnoble.com/w/i-know-why-the-caged-bird-sings-maya-angelou/1100392955?ean=9780345514400'],
            ['Harry Potter and the Sorcerer\'s Stone', 'J.K. Rowling', 1997, 'http://prodimage.images-bn.com/pimages/9780590353427_p0_v1_s484x700.jpg', 'http://www.barnesandnoble.com/w/harry-potter-and-the-sorcerers-stone-j-k-rowling/1100036321?ean=9780590353427'],
            ['Harry Potter and the Chamber of Secrets', 'J.K. Rowling', 1998, 'http://prodimage.images-bn.com/pimages/9780439064873_p0_v1_s192x300.jpg', 'http://www.barnesandnoble.com/w/harry-potter-and-the-chamber-of-secrets-j-k-rowling/1004338523?ean=9780439064873'],
            ['Harry Potter and the The Prisoner of Azkaban', 'J.K. Rowling', 1999, 'http://prodimage.images-bn.com/pimages/9780439136365_p0_v1_s192x300.jpg', 'http://www.barnesandnoble.com/w/harry-potter-and-the-prisoner-of-azkaban-j-k-rowling/1100178339?ean=9780439136365'],
        ];

        $count = count($books);

        foreach ($books as $key => $bookData) {
            $book = new Book();

            $book->created_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
            $book->updated_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
            $book->title = $bookData[0];
            $book->author = $bookData[1];
            $book->published_year = $bookData[2];
            $book->cover_url = $bookData[3];
            $book->purchase_url = $bookData[4];

            $book->save();
            $count--;
        }
    }
}
