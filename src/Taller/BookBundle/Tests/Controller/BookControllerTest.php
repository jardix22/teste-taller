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
                    'taller_bookbundle_booktype[title]' => 'The Lost Symbol '.uniqid(),
                    'taller_bookbundle_booktype[author]' => 'Dan Brown',
                    'taller_bookbundle_booktype[summary]' => 'The Lost Symbol is a 2009 novel written by American writer Dan Brown. It is a thriller set in Washington, D.C., after the events of The Da Vinci Code, and relies on Freemasonry for both its recurring theme and its major characters.',
                    'taller_bookbundle_booktype[edition_date][day]' => 15,
                    'taller_bookbundle_booktype[edition_date][month]' => 9,
                    'taller_bookbundle_booktype[edition_date][year]' => 2009,
                    'taller_bookbundle_booktype[image]' => $fixtures.'/book3.jpg'
                )
            ),
            array(
                array(
                    'taller_bookbundle_booktype[title]' => 'The Lightning Thief-'.uniqid(),
                    'taller_bookbundle_booktype[author]' => 'author',
                    'taller_bookbundle_booktype[summary]' => 'The Lightning Thief is a 2005 fantasy-adventure novel based on Greek mythology, the first young adult novel written by Rick Riordan. Wikipedia',
                    'taller_bookbundle_booktype[edition_date][day]' => 11,
                    'taller_bookbundle_booktype[edition_date][month]' => 11,
                    'taller_bookbundle_booktype[edition_date][year]' => 2002,
                    'taller_bookbundle_booktype[image]' => $fixtures.'/book4.jpg'
                )
            )
        );
    }
}
