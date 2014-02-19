teste-taller
============

Software to registration books. [Symfony2]

Stories
========

1. I as a user want to register books
2. I as a user want to edit books
3. I as a user want to be able to delete books
4. I as a user want to be able to list the imported books
5. I as a user want to be able to order books.

Routes
======

* book_index      /books              GET
* book_add        /book/add           GET
* book_edit       /books/{id}/edit    GET
* book_create     /book               POST
* book_update     /books/{id}         POST
* book_delete     /books/{id}/delete  POST
