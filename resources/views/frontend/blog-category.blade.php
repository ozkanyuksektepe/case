<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    * {
      box-sizing: border-box;
    }

    /* Add a gray background color with some padding */
    body {
      font-family: Arial;
      padding: 20px;
      background: #f1f1f1;
    }

    /* Header/Blog Title */
    .header {
      padding: 30px;
      font-size: 40px;
      text-align: center;
      background: white;
    }

    /* Create two unequal columns that floats next to each other */
    /* Left column */
    .leftcolumn {
      float: left;
      width: 50%;
    }

    /* Right column */
    .rightcolumn {
      float: left;
      width: 25%;
      padding-left: 20px;
    }

    /* Fake image */
    .fakeimg {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }

    /* Add a card effect for articles */
    .card {
      background-color: white;
      padding: 20px;
      margin-top: 20px;
    }

    /* Clear floats after the columns */
    .row:after {
      content: "";
      display: table;
      clear: both;
    }

    /* Footer */
    .footer {
      padding: 20px;
      text-align: center;
      background: #ddd;
      margin-top: 20px;
    }

    /* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other */
    @media screen and (max-width: 800px) {
      .leftcolumn, .rightcolumn {
        width: 100%;
        padding: 0;
      }
    }
  </style>
</head>
<body>

<div class="header">
  <h2>{{$categories->name}}</h2>
</div>

<div class="row">
@foreach($blogs as $blog)
  <div class="leftcolumn">
    <div class="card">
      <h2>{{$blog->name}}</h2>
      <a href="{{route("frontend.blog.details",$blog->url())}}">
        <img class="fakeimg" src="{{getCover($blog->cover)}}">
      </a>
      <p>{!! Str::limit($blog->description,150)  !!}</p>
      <a href="{{route("frontend.blog.details",$blog->url())}}">Detaya Git</a>
    </div>
  </div>
@endforeach
</div>

<a href="{{route("frontend.index")}}">
<div class="footer">
  <h2>Ana Sayfa'ya Dön</h2>
</div>
</a>
</body>
</html>
