<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $("#attach_file_1").change(function() {
        // var fileInput = document.getElementById('attach_file');
        "use strict";
        // var fileInput = event.srcElement;
        var fileName = $(this).val().split('\\').pop();
        // alert(fileName);
        $('#placeholderAttachFile_1').attr('placeholder', fileName);
    });
</script>

<div class="row attach-item" id="parking">

    <div class="col-md-6 col-sm-12 form-group">
        <label for="exampleInputEmail1">Day</label>
        <input type="text" name="days[]" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
            required placeholder="Mondays to Saturdays">
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 form-group">
        <label for="exampleInputPassword1">Time</label>
        <input type="text" name="times[]" class="form-control" id="exampleInputPassword1" required
            placeholder="8:00am – 4:59 pm">
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12 form-group">
        <label for="exampleInputEmail1">Price</label>
        <input type="text" name="prices[]" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
            required placeholder="S$2.00 for subsequent 30 minutes">
    </div>
    <div class="col-12">
        <hr>
        <hr>
    </div>
</div>





<script>
    var index = 0;

    function parking_add() {
        index = $('.attach-item').length
        addNewPetitioner(index)
    }

    function addNewPetitioner(index) {
        "use strict";
        var add_parking = `
        <div class="row attach-item" id="parking` + index + `">

            <div class="col-md-6 col-sm-12 form-group">
                <label for="exampleInputEmail1">Day</label>
                <input type="text" name="days[]" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    required placeholder="Mondays to Saturdays">
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 form-group">
                <label for="exampleInputPassword1">Time</label>
                <input type="text" name="times[]" class="form-control" id="exampleInputPassword1"
                    required placeholder="8:00am – 4:59 pm">
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 form-group">
                <label for="exampleInputEmail1">Price</label>
                <input type="text" name="prices[]" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    required placeholder="S$2.00 for subsequent 30 minutes">
            </div>
            <div class="col-12">
                <hr>
                <hr>
            </div>
        </div>`

        // $('.attach-item').append(add_parking);

        $('#parking-slot').append(add_parking);
    }


    function remove_petetioner(id) {
        var element = document.getElementById(id);
        element.parentNode.removeChild(element);
    }
</script>
