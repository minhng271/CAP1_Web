<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/style-home.css') }}">
    <title>HOME</title>
  </head>
  <body>
    <div class="container">
      <img src="{{ asset('img/mtac-system.png') }}" alt="" />
      <div class="menu">
        <div class="Vaccine">
          <a href="{{ url('vaccine') }}">
            <img src="{{ asset('img/iconVac.png') }}" alt="" /> <br />
            <span>Tiêm Vaccine</span>
          </a>
        </div>
        <div class="Test">
          <a href="{{ url('test') }}">
            <img src="{{ asset('img/iconTest.png') }}" alt="" /> <br />
            <span>Xét nghiệm</span>
          </a>
        </div>
      </div>
    </div>
  </body>
</html>
