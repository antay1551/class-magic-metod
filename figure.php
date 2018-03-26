<?php

interface CanCountPerimeter {
  function perimeter();
}

abstract class FlatFigure  implements CanCountPerimeter {
	abstract function perimeter();

	function __toString(){
		return get_class($this) . PHP_EOL .
		"Perimeter is equal to " . $this->perimeter() . PHP_EOL;
	
	}
	public function __get($sizes)
	{
		return($this->$sizes);
	}
 	public function __isset($sizes) {
        return ( isset($this->sizes));
   }
	public function __unset($sizes) {
		unset($this->sizes);
    }
}


class Round extends FlatFigure {
	private $radius;
    public $sizes;
	
	function __construct($radius = 0){
		$this->radius = $radius[0];
	}

	function perimeter(){
		return $this->radius * 2 * M_PI;
	}
 }

class Polygon_right extends FlatFigure {

	public $size;
	public $sizes;
 
	function __construct($sizes = []){
		$this->sizes = $sizes;
	}
    function perimeter(){
		return array_sum($this->sizes);
	}
 }

class Rectangle extends Polygon_right {
	function perimeter(){
		return 2*($this->sizes[ 0 ] + $this->sizes[ 1 ]);
	}
}

class Square extends Polygon_right {
	function perimeter(){
		return 4*($this->sizes[ 0 ]);
	}
}

class Polygon_not_right extends Polygon_right {
	function perimeter(){
		return array_sum($this->sizes);
	}
}
class Trapeze_right extends Polygon_right {
	function perimeter(){
		return 2*($this->sizes[ 0 ] ) + $this->sizes[ 1 ] + $this->sizes[ 3 ];
	}
}
class Triangle extends Polygon_right {
	function perimeter(){
		return ($this->sizes[ 0 ] + $this->sizes[ 1 ] + $this->sizes[ 2 ]);
	}
}
class Some_figure extends Polygon_right {
	function perimeter(){
		return "it's not a figure";
	}
}
class Wrong_quadrangle extends Polygon_right {
	function perimeter(){
		return array_sum($this->sizes);
	}
}

function createFigure($sizes) {
	$ob1 = '';
	
	if(count($sizes) > 4){
		$right = 1;
		for ( $i=0; $i < count( $sizes ) - 1 ; $i++ ){
			if ( $sizes[ $i ] != $sizes[ $i + 1 ] ) 
			$right = 0;
		}
	}
  
	if(count($sizes) == 1) {
		$ob1 =  new Round($sizes);//2131
	} elseif( $right ){
		$ob1 =  new Polygon_right($sizes);
	} elseif ( ( !$right )&& (count($sizes) > 4 ) ) {
		$ob1 =  new Polygon_not_right($sizes);
	} elseif( ( $sizes [ 0 ] == $sizes [ 1 ] ) && ( $sizes[ 2 ] == $sizes[ 3 ] ) && ( $sizes[ 1 ] == $sizes[ 2 ] ) ) {
		$ob1 =  new Square($sizes);
	} elseif ( ( $sizes [ 0 ] == $sizes [ 2 ] ) && ( $sizes[ 1 ] == $sizes[3] )  ){
		$ob1 =  new Rectangle($sizes);
	} elseif ( ( $sizes [ 0 ] == $sizes [ 2 ] ) && ( $sizes[ 1 ] != $sizes[3] )  ){
		$ob1 =  new Trapeze_right($sizes);
	}elseif (count($sizes)==3) {
		$ob1 =  new Triangle($sizes);
	}elseif (count($sizes)==2) {
		$ob1 =  new Some_figure($sizes);
	}else {
		$ob1 =  new Wrong_quadrangle($sizes);
	}
	
	return $ob1; 
}
	$count_mas = rand(4,8);
	  for ( $i=0; $i < $count_mas  ; $i++ ){
		$emount =  rand(1,5);
		for ( $j=0; $j < $emount  ; $j++ ){
			$mas_elem[$j]=rand(1,5);
		}
		//$p = (createFigure($mas_elem));
		$mas_obj[$i] = (createFigure($mas_elem));;
		unset($mas_elem);
	  }
	 
	echo"what is in the array of objects: \n";
	foreach ( $mas_obj as $object ){
		echo $object."\n";
	}
	echo"what are in the arrays: \n";
	foreach ( $mas_obj as $obj ){
		print_r($obj->sizes);//."\n";
		//echo"11111111111111111111111111111111";
	}
	echo"check if isset \n";
	foreach ( $mas_obj as $objec ){
		print( isset($objec->sizes)."\n");
		//echo"\n";
	}
	echo"unset mass \n";
	foreach ( $mas_obj as $ob ){
		unset($ob->sizes);//."\n";
	}
	
	echo"result of isset after unset \n";
	foreach ( $mas_obj as $objek ){
		echo((int) isset($objek->sizes) ."\n");
		//echo"\n";
	}
	
?>