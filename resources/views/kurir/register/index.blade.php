<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head><script src="{{asset('./js/color-modes.js')}}"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/Logo Maket Putih.png">
 
    <title>REGISTER KURIR || MAKET</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

<link href="{{asset('./css/bootstrap.min.css')}}" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      .non-editable-box {
        user-select: none; /* Prevent text selection */
        pointer-events: none; /* Prevent any interaction */
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }

      .bd-mode-toggle {
        z-index: 1500;
      }

      .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="{{asset('./css/styleLogin.css')}}" rel="stylesheet">
  </head>
<body class="d-flex align-items-center py-4 bg-dark text-white">

<main class="form-registration w-100 m-auto ">
  <img class="mb-4" src="/img/Logo Maket Putih.png" alt="" width="100" height="100">
  <h1 class="h3 mb-3 fw-normal">Registrasi Khusus Kurir</h1>
  <form action="/kurir/register" method="post">
    @csrf
    <div class="form-floating">
      <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" placeholder="Nama" required>
      <label for="nama">Nama</label>
      @error('nama')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    <div class="form-floating">
      <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password" required>
      <label for="password">Password</label>
      @error('password')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    <div class="form-floating">
      <select class="form-select" name="ekspedisi_id" id="selectOption" aria-label="Default select example">
        <option disable selected>Ekspedisi</option>
        @foreach ($ekspedisis as $ekspedisi)
            <option
              value="{{ $ekspedisi->id }}">{{ $ekspedisi->jenis_ekspedisi }}</option>
        @endforeach
      </select>
      {{-- <div id="inputText" style="display: none;">
        <input type="text" name="textInput" id="textInput" class="form-control" placeholder="ketik ekspedisi lainnya" required>
          <script>
          const selectOption = document.getElementById('selectOption');
          const inputText = document.getElementById('inputText');

          selectOption.addEventListener('change', () => {
              if (selectOption.value === '11') {
                  inputText.style.display = 'block';
              } else {
                  inputText.style.display = 'none';
              }
          });
          </script>
      </div> --}}
    </div>
    
    {{-- <div class="form-floating">
      <div class="form-control non-editable-box" type="text" id="token" aria-label="default input example">{{ $kurirs->api_key }} </div>
      <label for="token">Token</label>
    </div> --}}
    
    <button class="btn btn-primary w-100 py-2 mt-4" type="submit">Daftar</button>
  </form>
  <small>Sudah punya akun? <a href="/kurir/login">Masuk sekarang!</a></small>
  <p class="mt-5 mb-3 text-body-secondary">&copy; Maket-2024</p>
</main>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

    </body>
</html>
