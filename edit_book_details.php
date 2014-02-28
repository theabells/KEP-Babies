<!DOCTYPE html>
<html>
<head>
    <title>Update</title>
</head>
<body>

<div id="#myModal">
    <form name="material_form" class="form-horizontal" role="form" method="post" action="<?php echo base_url();?>index.php/site/update_material_details">
        <input name="accession_number" type="hidden" class="form-control" value="<?php foreach($results as $row){echo $row->accession_number;} ?>">
        <?php print_r($results)?>
        <div class="form-group">
            <label for="inputTitle" class="col-sm-2 control-label">Title</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="inputTitle" name="inputTitle" value="<?php foreach($results as $row){echo $row->title;} ?>">
                <span class="prompt" name="title_prompt"></span>
            </div>
        </div>
        <div class="form-group">
            <label for="inputType" class="col-sm-2 control-label">Type</label>
            <div class="row" id="inputType">
                <div class="col-lg-2">
                    <div class="input-group">
                        <input type="radio" name="type" value="book" id="book">
                        <label for="book">Book</label>
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-8 -->
                <div class="col-lg-2">
                    <div class="input-group">
                        <input type="radio" name="type" value="thesis" id="thesis">
                        <label for="thesis">Thesis</label>
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-8 -->
                <div class="col-lg-2">
                    <div class="input-group">
                        <input type="radio" name="type" value="sp" id="sp">
                        <label for="sp">Special Project</label>
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-8 -->
                <div class="col-lg-2">
                    <div class="input-group">
                        <input type="radio" name="type" value="journal" id="journal">
                        <label for="journal">Journal</label>
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-8 -->
            </div><!-- /.row -->
        </div>
        <div class="form-group">
            <label for="inputPublisher" class="col-sm-2 control-label">Publisher</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="inputPublisher" name="inputPublisher" value="<?php foreach($results as $row){echo $row->publisher;} ?>">
                <span class="prompt" name="publisher_prompt"></span>
            </div>
        </div>
        <div class="form-group">
            <label for="inputYear" class="col-sm-2 control-label">Year</label>
            <div class="col-sm-2">
                <input type="number" class="form-control" id="inputYear" name="inputYear" value="<?php foreach($results as $row){echo $row->copyright_year;} ?>" min="1900">
            </div>
        </div>
        <div class="form-group">
            <label for="inputSubject" class="col-sm-2 control-label">Subject</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="inputSubject" name="inputSubject" value="<?php foreach($results as $row){echo $row->subject;} ?>">
            </div>
        </div>
        
        <div class="col-lg-8">
            <table id="author_table" class="table table-striped table-bordered table-hover">
                <thead>
                <tr class="success">
                    <th>Author</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($results2 as $row): ?>
                    <tr>
                        <td><input type="text" name="inputAuthor[]" value="<?php echo $row->author?>"/></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <input class="add_more" type="button" value="Add More Author" name="add_more" />
        </div>
        <button type="submit" value="<?php foreach($results as $row){echo $row->accession_number;}?>" class="editButton btn btn-primary">Save Changes</button>
    </form>
</div>

<script src="<?php echo base_url();?>/js/jquery-1.9.1.js"></script>
<script src="<?php echo base_url();?>/js/jquery-1.9.1.min.js"></script>
<script src="<?php echo base_url();?>/js/main.js"></script>
<!--Validation from add material-->
<script type="text/javascript">
    window.onload = function(){
      //material_form.subject.onblur = validate_subject;
      material_form.inputTitle.onblur = validate_title;
      material_form.inputAuthor.onblur = validate_author;
      material_form.inputPublisher.onblur = validate_publisher;
    }

    function validate_subject(){
      var prompt = "";
      str = material_form.subject.value;
      if(str == "")
        prompt = "This is a required field.";
      else if(!str.match(/^[a-zA-Z][0-9a-zA-Z]+$/))
        prompt = "Only Letters and Numbers are allowed in this field.";
      document.getElementsByName('subject_prompt')[0].innerHTML = prompt;
      if(prompt == "")
        return true;
    }

    function validate_title(){
      var prompt = "";
      str = material_form.inputTitle.value;
      if(str == "")
        prompt = "This is a required field.";
      else if(!str.match(/^[a-zA-Z][0-9a-zA-Z\-\ \.]+$/))
        prompt = "Only Letters, Numbers, Spaces, Period and Hypen are allowed in this field.";
      document.getElementsByName('title_prompt')[0].innerHTML = prompt;
      if(prompt == "")
        return true;
    }

    /*function validate_author(){
      var prompt = "";
      str = material_form.inputAuthor.value;
      if(str == "")
        prompt = "This is a required field.";
      else if(!str.match(/^[a-zA-Z][0-9a-zA-Z\-\ \.]+$/))
        prompt = "Only Letters, Numbers, Spaces, Period and Hypen are allowed in this field.";
      document.getElementsByName('author_prompt')[0].innerHTML = prompt;
      if(prompt == "")
        return true;
    }*/

    function validate_publisher(){
      var prompt = "";
      str = material_form.inputPublisher.value;
      if(str == "")
        prompt = "This is a required field.";
      else if(!str.match(/^[a-zA-Z][0-9a-zA-Z\-\ \.]+$/))
        prompt = "Only Letters, Numbers, Spaces, Period and Hypen are allowed in this field.";
      document.getElementsByName('publisher_prompt')[0].innerHTML = prompt;
      if(prompt == "")
        return true;
    }

</script>
<script type="text/javascript">
    var str="<?php foreach($results as $row){echo $row->type;}?>";
    document.getElementById("<?php foreach($results as $row){echo $row->type;}?>").checked=true;
    $(function () {
        $('input.add_more').on('click', function () {
            var $table = $('#author_table');
            var $tr = $table.find('tr').eq(1).clone();
            $tr.appendTo($table).find('input').val('');
        });
    });
</script>
<link href="<?php echo base_url();?>css/bootstrap.css" rel="stylesheet">
</body>
</html>
