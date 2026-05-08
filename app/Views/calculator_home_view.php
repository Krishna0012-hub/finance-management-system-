<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--<link href="style.css" rel="stylesheet" type="text/css" />
    <link href="utils.css" rel="stylesheet" type="text/css" />-->
    <style>
        div{margin-top: 10px;}
        </style>
</head>
<body>
    <h1 class="text-center">Welcome to Krishna  Calculator!</h1>
    <div class="container flex flex-col items-center mx-auto m-w-20" style="justify-content:center; align-items:center;">
        <div class="row">
            <input class="input" type="text" style="width:290px";>
            </div>
            <div class="row">
                <button class="button">C</button>
                <button class="button">%</button>
                <button class="button">M+</button>
                <button class="button">M-</button>
            </div>
            <div class="row">
            <button class="button">7</button>
            <button class="button">8</button>
            <button class="button">9</button>
            <button class="button">*</button>
        </div>
        <div class="row">
            <button class="button">4</button>
            <button class="button">5</button>
            <button class="button">6</button>
            <button class="button">/</button>
        </div>
        <div class="row">
            <button class="button">1</button>
            <button class="button">2</button>
            <button class="button">3</button>
            <button class="button">+</button>
        </div>
        <div class="row">
            <button class="button">0</button>
            <button class="button">.</button>
            <button class="button">=</button>
            <button class="button">-</button>
        </div>
     </div>
	 
    <script type="text/javascript" src="<?php echo base_url('js/calculator.js'); ?>"></script>
</body>

</html>