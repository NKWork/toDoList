<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
    <style>
    .wrapper {
      width: 100%;
      height: 500px;
      background-color: white;
    }

    .form {
      width: 1000%;
      margin: 0 auto;

      height: 0px;

      background-color: aquamarine;

      transition: height 1s;
      overflow: hidden;
    }

    .form--open {
      height: 200px;
    }
  </style>
</head>
<body>
  <div class="wrapper">
    <button id="button">Create task</button>
    <div class="form">
    <form action="/create" method="post">
	 	 	{{ csrf_field() }}
            <input type='text' name='name'>
            <input type='text' name='description'>
            <select name='status'>
                <option value="1">toDo</option>
                <option value="2">doing</option>
                <option value="3">done</option>
                
            </select> 
            <button>Submit</button>
        </form>
    </div>
  </div>

  <script>
    const button = document.querySelector('#button');
    const form = document.querySelector('.form');

    button.addEventListener('click', (e) => {
        e.stopPropagation();
        e.preventDefault();
      form.classList.toggle('form--open');
    });
  </script>  
</body>
</html>