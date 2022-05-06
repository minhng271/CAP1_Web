<!DOCTYPE html>
<html>
  <head>
    <title>Instascan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script type="text/javascript" src="{{ asset('js/instascan.min.js') }}"></script>
  </head>
  <body>
    <div class="container">
        <div class="row">
        <div class="col-md-6">
            <video id="preview" width="100%"></video>
        </div>
        <div class="col-md-6">
            <label for="text"  class="form-label">Qr-code Values</label>
            <input type="text" name="text" id="text" readonly='' class="form-control">
        </div>
        </div>    
    </div>

    <script type="text/javascript">
      let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
      scanner.addListener('scan', function (content) {
        console.log(content);
      });
      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[0]);
        } else {
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });
    </script>
  </body>
</html>
