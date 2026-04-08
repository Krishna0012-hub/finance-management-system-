<?php

namespace App\Controllers;

class Calculator extends BaseController
{
    public function index(): string
    {
		 return view('header')
				. view('calculator_home_view')
				. view('footer');
	}	
       
	
	public function my_function(): string
    {
		/*$a = 5;
	$b = 6;
	$c = $a+$b;
	
	$res = array('sum'=>$c);  
	return view('add_view',$res);*/
		
		    }
			
	public function add(): string
    {
		$a = 5;
		$b = 6;
		$c = $a+$b;
	
		$res = array('sum'=>$c); 
		//$data['res'] = $res	
		//view('header',$res)	
		//view('add_view',$res);
		//view('footer',$res);
		
		 return view('header')
				. view('add_view', $res)
				. view('footer');
	}	
	//
      	public function sub(): string
    {
		
    $a = 15;
	$b = 6;
	$c = $a-$b;
	
	$res = array('sub'=>$c);    
	 return view('header')
				. view('sub_view', $res)
				. view('footer');
		
	}	 
	//
		public function mul(): string
    {
		
    $a = 15;
	$b = 6;
	$c = $a*$b;
	
	$res = array('mul'=>$c);    
	return view('mul_view',$res);
		
	}	 
	//
		public function div(): string
    {
		
    $a = 15;
	$b = 6;
	$c = $a/$b;
	
	$res = array('div'=>$c);    
	return view('div_view',$res);
		
	}	 
		
}
