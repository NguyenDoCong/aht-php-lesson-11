<?php
class Controller
{
    public function category()
    {
        include 'view/category/displaycategory.php';
    }
    public function student()
    {
        include 'view/student/displaystudent.php';
    }
    public function author()
    {
        include 'view/author/displayauthor.php';
    }
    public function book()
    {
        include 'view/book/displaybook.php';
    }
}
