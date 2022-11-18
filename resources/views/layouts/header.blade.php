<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  @livewireStyles
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">
  <link rel="stylesheet" href="{{ asset('css/ra/main.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('css/admin/main.css') }}">
  <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{ asset('dist/css/BsMultiSelect.css') }}">
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>
  @livewireStyles
  <!-- Bootstrap Multiselect CSS -->
  <link rel="stylesheet" href="{{ asset('css/bootstrap-multiselect.css') }}">

  <!-- Bootstrap Multiselect JS -->
  <script data-main="dist/js/" src="{{ asset('js/require.min.js') }}"></script>
  <style>
    .search-bar {
      min-width: 760px;
    }

    .search-bar2 {
      min-width: 730px;
    }

    .toggle-sidebar2 {
      display: none;
      cursor: pointer;
    }

    @media (min-width:993px) {
      .toggle-sidebar {
        display: none !important;
      }
    }

    @media (max-width:992px) {
      .dash-sidebar {
        display: none !important;
      }

      .toggle-sidebar2 {
        display: revert;
      }
    }

    @media (max-width:429px) {
      .admin-bottom-res {
        display: flex;
        flex-direction: column;
        align-items: center;
      }
    }

    @media (max-width:992px) {
      .profile-sec-center {
        text-align: center;
      }
    }
    @media (max-width:767px) {
      .ra-ser-pro-center {
        text-align: center;
      }
    }
  </style>
  <title>
    @stack('title')
  </title>
</head>