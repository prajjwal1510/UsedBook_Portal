<?php

/**
 * PHP item based filtering
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * @package   PHP item based filtering
 */

require_once 'recommend.php';
require_once 'content_based.php';

$con = mysqli_connect("localhost", "root", "", "ecommerce");

$books = mysqli_query($con, "SELECT book_title, book_category, book_subject FROM book");

$objects = [];
while($book_row = $books->fetch_assoc()){

	//$category_result = mysqli_query($con, "SELECT cat_title FROM categories WHERE cat_id = " . $book_row["book_category"]);
	//$category_row = $category_result->fetch_assoc();
	$objects[$book_row["book_title"]] = array($book_row['book_category'], $book_row['book_subject']);
}

/*$objects = [
	'The Matrix' => ['Action', 'Sci-Fi'],
	'Lord of The Rings' => ['Adventure', 'Drama', 'Fantasy'],
	'Batman' => ['Action', 'Drama', 'Crime'],
	'Fight Club' => ['Drama'],
	'Pulp Fiction' => ['Drama', 'Crime'],
	'Django' => ['Drama', 'Western'],
];*/


$user = ['Biography', 'English'];

$engine = new ContentBasedRecommend($user, $objects);

var_dump($engine->getRecommendation());
