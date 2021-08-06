<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap-5.0.2-dist\css\bootstrap.min.css">
    <script src="bootstrap-5.0.2-dist\js\bootstrap.bundle.min.js"></script>
</head>
<body>
   {{-- <form action="{{route('')}}"></form> --}}
   <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{route('customer.home')}}">Nama Produk</a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('customer.home')}}"
              >Home</a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('customer.list')}}">Produk</a>
          </li>
            <li class="nav-item">
            <a class="nav-link" href="{{route('customer.keranjang')}}">Keranjang</a>
          </li>
          <li class="navbar-item">
            <a class="nav-link" href="{{route('logout')}}">logout</a>
          </li>
        </ul>
        <form class="d-flex" action="{{route('customer.list')}}">
          <input
            class="form-control me-2"
            type="search"
            placeholder="Search"
            aria-label="Search"
            name="search"
          />
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
      @yield('navbar')
</body>
</html>