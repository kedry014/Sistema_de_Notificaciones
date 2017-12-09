<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Popup Notification</title>
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <style>
    #alert_popover{
      display: block;
      position: absolute;
      bottom: 50px;
      left: 50px;
    }
    .wapper{
      display: table-cell;
      vertical-align: bottom;
      height: auto;
      width: 200px;
    }
    .alert_default{
      color: #333333;
      background-color: #f2f2f2;
      border-color: #cccccc;
    }
  </style>
</head>
<body>

  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">Sistema de Notifcación</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Notification
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
        </ul>
      </div> -->
    </nav>
  </header>

  <div class="container mt-5">
    <form method="post" id="comment_form">
      <div class="form-group">
        <label for="subject">Asunto</label>
        <input type="text" class="form-control" name="subject" id="subject">
      </div>
      <div class="form-group">
        <label for="comment">Comentario</label>
        <textarea name="comment" id="comment" class="form-control" rows="5"></textarea>
      </div>
      <input type="submit" name="post" id="post" class="btn btn-primary" value="Enviar">
    </form>

  <div id="alert_popover">
    <div class="wapper">
      <div class="content">

      </div>
    </div>
  </div>

  </div>
  
  <script src="../js/jquery-3.2.1.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function(){

      setInterval(function(){
        load_last_notification();
      }, 5000);

      function load_last_notification(){
        $.ajax({
          url:"fetch.php",
          method:"POST",
          success:function(data){
            $('.content').html(data);
          }
        })
      }
    });

    $('#comment_form').on('submit', function(event){
      event.preventDefault();
      if($('#subject').val() != '' && $('#comment').val() != ''){
        var form_data = $(this).serialize();
        $.ajax({
          url:"insert.php",
          method:"POST",
          data:form_data,
          success:function(data){
            $('#comment_form')[0].reset();
          }
        })
      } else{
        alert("Los Campos requidos");
      }
    });
  </script>
</body>
</html>