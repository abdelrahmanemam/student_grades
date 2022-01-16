<!DOCTYPE html>
<html lang="en">
<title>Students</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<style>
    body,h1,h2,h3,h4,h5 {font-family: "Poppins", sans-serif}
    body {font-size:16px;}
    .w3-half img{margin-bottom:-6px;margin-top:16px;opacity:0.8;cursor:pointer}
    .w3-half img:hover{opacity:1}
</style>
<body>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-red w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;" id="mySidebar"><br>
    <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px">Close Menu</a>
    <div class="w3-container">
        <h3 class="w3-padding-64"></h3>
    </div>
    <div class="w3-bar-block">
        <a href="#" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Home</a>
        <a href="#contact" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Contact</a>
    </div>
</nav>

<!-- Top menu on small screens -->
<header class="w3-container w3-top w3-hide-large w3-red w3-xlarge w3-padding">
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:340px;margin-right:40px">

    <!-- Header -->
    <div class="w3-container" style="margin-top:80px">
        <h1 class="w3-jumbo"><b>Students Grades</b></h1>
    </div>

    <div class="w3-row-padding">
        <table class="table table-bordered yajra-datatable">
            <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Course</th>
                <th>Grade</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <!-- Create -->
    <div class="w3-container w3-half" id="contact" style="margin-top:75px">
        <h1 class="w3-xxxlarge w3-text-red"><b>Create Student</b></h1>
        <hr style="width:50px;border:5px solid red" class="w3-round">
        <form action={{route('student-store')}} method="post">
        @csrf <!-- {{ csrf_field() }} -->
            <div class="w3-section">
                <label>First Name</label>
                <input class="w3-input w3-border" type="text" name="first_name" required>
            </div>
            <div class="w3-section">
                <label>Second Name</label>
                <input class="w3-input w3-border" type="text" name="second_name">
            </div>
            <div class="w3-section">
                <label>Third Name</label>
                <input class="w3-input w3-border" type="text" name="third_name">
            </div>
            <div class="w3-section">
                <label>Last Name</label>
                <input class="w3-input w3-border" type="text" name="last_name" required>
            </div>
            <div class="w3-section">
                <label>Email</label>
                <input class="w3-input w3-border" type="text" name="email" required>
            </div>
            <button type="submit" class="w3-button w3-block w3-padding-large w3-red w3-margin-bottom">Create</button>
        </form>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div>{{$error}}</div>
            @endforeach
        @endif
    </div>

    <div class="w3-container w3-half" id="contact" style="margin-top:75px">
    <!-- Upload -->
        <h1 class="w3-xxxlarge w3-text-red"><b>Upload Grades</b></h1>
        <hr style="width:50px;border:5px solid red" class="w3-round">
        <form action={{route('grade-store')}} method="post" enctype="multipart/form-data">
        @csrf <!-- {{ csrf_field() }} -->
            <div class="w3-section">
                <label>File</label>
                <input class="w3-input w3-border" type="file" name="grades" required>
            </div>
            <button type="submit" class="w3-button w3-block w3-padding-large w3-red w3-margin-bottom">Upload</button>
        </form>
    </div>
    <!-- End page content -->
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
function w3_close() {
        document.getElementById("mySidebar").style.display = "none";
        document.getElementById("myOverlay").style.display = "none";
    }

    $(function () {

        var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('student-index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'full_name', name: 'full_name', orderable: true, searchable: true},
                {data: 'email', name: 'email', orderable: true, searchable: true},
                {data: 'course', name: 'course', orderable: true, searchable: true},
                {data: 'grade', name: 'grade'}
            ]
        });

    });
</script>
</body>
</html>
