<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Proceeding...</title>
  <link rel="stylesheet" href="Loading.css">
</head>
<body>
  <div class="center">
  <header>
            <div class="snow"></div>
            <div class="snow2"></div>
    </header>  
    <div class="ring" id="loadbar"></div>
    <span>Proceeding...</span>
  </div>
  <script>
    var loadbar = document.getElementById('loadbar')
    loadbar.addEventListener('animationiteration', () =>{
      window.location.replace("./screens/index.php"); 
    })
  </script>
</body>
</html>