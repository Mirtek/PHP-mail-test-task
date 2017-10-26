<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Request form</title>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  <script src="datepicker/js/datepicker.min.js"></script>
  <link rel="stylesheet" href="datepicker/css/datepicker.min.css" />
  <link rel="stylesheet" href="styles.css" />
</head>
<body>
  <div class="container form-container">
    <h2 class="headline">Request form by Denys Toloshnyi</h2>
    <div class="fields-container">    
      <form action="action.php" method="post" enctype="multipart/form-data">
        <input type="text" name="name" class="form-control" placeholder="Your name"/ required>
        <input type="email" name="email" class="form-control" placeholder="Your email address"/ required>
        <input type="text" class="form-control" name="phone" placeholder="Your phone number" / required>
        <div class="form-group form-group-display">
          <label for="date">Your meeting date: </label>
          <input type='text' name="date" placeholder="&#128197;" class="meetingdate-position form-control datepicker-here" required/>
        </div>
        <div class="fileUpload btn btn-default">
          <span>Add an attachment (.doc, .pdf, .png...)</span>
          <input type="file" class="upload" name="fileToUpload" id="fileToUpload" required>
        </div>
        <p id="file-selected"></p>
        <input type="email" class="form-control" name="recipient-email" placeholder="Recipient's email" required />
        <div class="sendRequest btn btn-default">
          <span>Send Request</span>
          <input type="submit" class="upload" id="submit-btn" />
        </div>
      </form> 
    </div><!--fields-container -->   
  </div><!--fields-container -->
  <script type="text/javascript">
    $('INPUT[type="file"]').change(function () {
      var ext = this.value.match(/\.(.+)$/)[1];
      switch (ext) {
        case 'doc':
        case 'png':
        case 'pdf':
        $('#submit-btn').attr('disabled', false);
        break;
        default:
        alert('This is not an allowed file type.');
        this.value = '';
      }
    });

    $(document).ready(function(){
      document.getElementById("fileToUpload").onchange = function () {
        console.log("shit");
        document.getElementById("file-selected").innerHTML = "File selected: " + this.files[0].name;
      };
    });
  </script>
</body>
</html>

