<?php

namespace Taller\BookBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BookControllerTest extends WebTestCase
{
    /**
     * @dataProvider generateBooks
     */
    public function testAdd($book)
    {
        print_r($book);

        $client = static::createClient();
        $client->followRedirects(true);

        $crawler = $client->request('GET', '/books');

        $linkAddBooks = $crawler->selectLink("Add Books")->link();
        $crawler = $client->click($linkAddBooks);

        $this->assertGreaterThan(0, $crawler->filter('html:contains("Add Book")')->count(), 'After click in button add books in the root path, load the page with the form to add a new book');

        $form = $crawler->selectButton('Save')->form($book);
        $crawler = $client->submit($form);

        $this->assertTrue($client->getResponse()->isSuccessful());

    }

    public function generateBooks()
    {
        $fixtures = __DIR__.'/fixtures/images';

        return array(
            array(
                array(
                    'taller_bookbundle_booktype[title]' => 'book-'.uniqid(),
                    'taller_bookbundle_booktype[author]' => 'author-demo',
                    'taller_bookbundle_booktype[summary]' => 'some text to demo',
                    'taller_bookbundle_booktype[edition_date][day]' => 21,
                    'taller_bookbundle_booktype[edition_date][month]' => 01,
                    'taller_bookbundle_booktype[edition_date][year]' => 2012,
                    'taller_bookbundle_booktype[image]' => $fixtures.'/book1.jpg'
                )
            ),
            array(
                array(
                    'taller_bookbundle_booktype[title]' => 'book-'.uniqid(),
                    'taller_bookbundle_booktype[author]' => 'author',
                    'taller_bookbundle_booktype[summary]' => 'some text to demo of book',
                    'taller_bookbundle_booktype[edition_date][day]' => 11,
                    'taller_bookbundle_booktype[edition_date][month]' => 11,
                    'taller_bookbundle_booktype[edition_date][year]' => 2002,
                    'taller_bookbundle_booktype[image]' => $fixtures.'/book2.jpg'
                )
            )
        );
    }
}
