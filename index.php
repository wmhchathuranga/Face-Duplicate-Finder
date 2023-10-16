<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <!-- topic -->
                <h1 class="text-center text-success mt-3 ">Face Recognition</h1>

                <!-- form one -->
                <form class="d-flex justify-content-center align-items-center mt-3" id="myForm">
                    <div class="card w-75">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label fw-bold">Image URL</label>
                                <input id="urlInput" type="url" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" placeholder="Enter image URL here ...">
                                <!-- hidden imput field -->
                                <input type="hidden" id="actionInput" value="recon">
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success me-auto fw-bold">Recognize
                                Face</button>
                        </div>
                    </div>
                </form>


                <!-- pop up messages area  -->
                <div class="d-flex justify-content-center mt-3">
                    <div class="col-9 mt-2  ">

                        <div id="conditionalContent" class="alert alert-danger alert-dismissible fade" role="alert"
                            id="errorAlert">
                            <strong>Already Upload User!</strong> Record found in database.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                        <div id="alternateContent" class="alert alert-success alert-dismissible fade" role="alert">
                            <strong>Unique User!</strong> This user not found in database.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                    </div>

                </div>

                <table class="table w-50 text-center mx-auto d-none" id="matching-table">
                    <thead>
                        <tr>
                            <th>Uid</th>
                            <th>Matching Percentage</th>
                        </tr>
                    </thead>
                </table>

                <div class="d-flex justify-content-center mt-3">
                    <div class="col-9 mt-2 text-center">

                        <img src="" alt="" id="img-preview" height="400px">

                    </div>

                </div>

                <!-- Form two -->
                <form class="d-none justify-content-center align-items-center mt-3" id="myForm2">
                    <div class="card w-75">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="uid-tag" class="form-label fw-bold">User Id</label>
                                <input type="text" class="form-control" id="uid-tag" aria-describedby="emailHelp"
                                    placeholder="576865 ...">
                                <!-- hidden imput field -->
                                <input type="hidden" id="actionTrain" value="train">
                                <input type="hidden" id="tid" value="">
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success me-auto fw-bold">Save User</button>
                        </div>
                    </div>
                </form>



            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>

        <script src="script.js"></script>
</body>

</html>