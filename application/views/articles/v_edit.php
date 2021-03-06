<?php
$this->load->view('template/header');
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
  <link href="<?php echo base_url('assets/plugins/treeview/treeview_styles.css') ?>" rel="stylesheet" type="text/css" />
  <!-- wa-mediabox -->
  <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/wa-mediabox/wa-mediabox.min.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/wa-mediabox/wa-mediabox.min.css" />

  <style type="text/css">
    .warning {
      background:#fff8c4;
      border:1px solid #f2c779;
      padding: 24px;
    }

    ul.enlarge{
    list-style-type:none; /*remove the bullet point*/
    margin-left:0;
    white-space: nowrap;
    overflow-x: auto;
    overflow-y: hidden;
    }

    ul.enlarge li {
    position: relative;
    display: inline-block;
    margin-right: 15px;
    margin-left: 15px;

    }
    ul.enlarge li img{
    background-color:#eae9d4;
    padding: 6px;
    -webkit-box-shadow: 0 0 6px rgba(132, 132, 132, .75);
    -moz-box-shadow: 0 0 6px rgba(132, 132, 132, .75);
    box-shadow: 0 0 6px rgba(132, 132, 132, .75);
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    }
    /**IE Hacks - see http://css3pie.com/ for more info on how to use CS3Pie and to download the latest version**/
    ul.enlarge img{
    behavior: url(pie/PIE.htc);
    }
    ul.enlarge a i{
      position:absolute; top:0; right:0; 
    }
  </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $page_title;?>
        <small><?php echo $page_subtitle?></small>
      </h1>
      <ol class="breadcrumb">
        <?php //$this->load->view('template/breadcrumb');?>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <!-- <h3 class="box-title">Bootstrap WYSIHTML5 <small>Simple and fast</small></h3> -->
              <!-- tools box -->
              <div class="pull-right box-tools">
                <a href="<?php echo base_url().'article';?>"><button class="btn btn-default btn-sm" title="Cancel"><i class="fa fa-times"></i>&nbsp;Cancel</button></a>
              </div><!-- /. tools -->
            </div><!-- /.box-header -->
            <div class="box-body pad">
              <?php foreach($article_list as $row){ ?>
              <form id="fileupload" action="<?php echo base_url().'article/update_article';?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
                <input type="hidden" name="articleId" value="<?php echo $row['_id'];?>" />
                <div class="form-group">
                  <label for="video" class="col-sm-2 control-label">Title</label>
                  <div class="col-md-6">
                    <input name="articleTitle" id="articleTitle" onkeyup="check();" class="form-control" required value="<?php echo $row['title'];?>" />
                    <input name="articleTitleOld" type="hidden" id="articleTitleOld" class="form-control" value="<?php echo $row['title'];?>" />
                    <span id="titleAvailResult"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="video" class="col-sm-2 control-label">Article</label>
                  <div class="col-md-10">
                    <textarea class="textarea" placeholder="Place some text here" required style="width: 100%; height: 100%; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="articleText"><?php echo $row['content'];?></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label for="video" class="col-sm-2 control-label">Category</label>
                  <div class="col-md-6">
                    <select name="articleCategory" class="form-control" required>
                      <option value="">--Select--</option>
                      <option value="otomotif" <?php if($row['category'] == 'otomotif'){ echo "selected";};?>>Otomotif</option>
                      <option value="sport" <?php if($row['category'] == 'sport'){ echo "selected";};?> >Sport</option>
                      <option value="tekno" <?php if($row['category'] == 'tekno'){ echo "selected";};?> >Tekno</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="video" class="col-sm-2 control-label">Pictures</label>
                  <div class="col-md-4">
                    <span class="btn btn-success" style="float:left;">
                        <input type="file" id="articlePic" name="articlePic[]" multiple>
                    </span>
                  </div>
                </div>

                <div class="form-group" id="picDiv" style="display:none;">
                  <label for="video" class="col-sm-2 control-label"></label>
                  <div class="col-md-10">
                    <ul class="enlarge" id="selUl">
                    </ul>
                  </div>
                </div>

                <div class="form-group">
                  <label for="video" class="col-sm-2 control-label">Uploaded Pictures</label>
                  <div class="col-md-10">
                    <ul class="enlarge">
                      
                    </ul>
                  </div>
                </div>

                <div id="catDiv">
                  <div class="form-group">
                    <label for="video" class="col-sm-2 control-label">Category</label>
                    <div class="col-md-8">
                      <ol class="tree">
                        <?php //getDataTree();?>
                      </ol>
                    </div>
                  </div>
                </div>
                <div id="vidDiv">
                  <div class="form-group">
                    <label for="video" class="col-sm-2 control-label">Video URL</label>
                    <div class="col-md-6">
                      <button type="button" id="btn_add" class="btn btn-primary" style="padding:3px 6px 3px 6px;margin-top:-2px;" action="javascript;;"><i class="fa fa-plus"></i> Add</button>
                      <input type="hidden" id="hide_count" value="1"/>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-12">
                    <button type="submit" class="btn btn-primary" id="button_save" style="float:right;">Save</button>
                  </div>
                </div>
              </form>
              <?php }?>
            </div>
          </div>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

<?php $this->load->view('template/footer');?>
<?php $this->load->view('template/script');?>
<!-- DataTables -->
<script src="<?php echo base_url().'assets/plugins/datatables/jquery.dataTables.min.js';?>"></script>
<script src="<?php echo base_url().'assets/plugins/datatables/dataTables.bootstrap.min.js';?>"></script>

<script type="text/javascript">
  //iCheck for checkbox and radio inputs
  $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass: 'iradio_minimal-blue'
  });

  $(function(){
    $(".textarea").wysihtml5({
        "image": false
      });  
  });

  var selDiv = "";

  document.addEventListener("DOMContentLoaded", init, false);

  function init() {
      document.querySelector('#articlePic').addEventListener('change', handleFileSelect, false);
      selDiv = document.querySelector("#selUl");
  }
      
  function handleFileSelect(e) {
    if(!e.target.files || !window.FileReader) return;

    $('#picDiv').css('display','block');
    selDiv.innerHTML = "";
    
    var files = e.target.files;
    var filesArr = Array.prototype.slice.call(files);
    var i=0;
    filesArr.forEach(function(f) {
        var file = files[i];
        if(!file.type.match("image.*")) {
            return;
        }

        var reader = new FileReader();
        reader.onload = function (e) {
            var html = "<li><a href=\"" + e.target.result + "\" target=\"_blank\" data-mediabox=\"Selected Pictures\" data-title=\""+file.name+"\"><img src=\"" + e.target.result + "\" alt=\""+file.name+"\" style=\"max-height:200px\" /></a><li>";
            selDiv.innerHTML += html;               
        }
        reader.readAsDataURL(file); 
        i++;
    });
      
  }
  
  function isNumberKey(evt)
    {
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))
      return false;
      return true;
    };
  $('#btn_add').click(function() {
    var count = 1;
    var limit = $('#hide_count').val();
    limit = parseInt(limit);
    limit++;
    count = count+1;
    var vardel = "'vid"+count+"'";
    $('#hide_count').val(count);
    var html = '<div class="form-group" id="vid'+count+'"><label for="video" class="col-sm-2 control-label"></label><div class="col-md-6"><input name="articleVidNew[]" type="url" class="form-control" placeholder="Input video url here" required /></div><a href="#" onclick="remInput('+vardel+');"><i class="fa fa-times-circle fa-2x"></i></a></div>';
    $(html).appendTo('#vidDiv');
  });

  function remInput(data){
    $('#'+data).remove();
  };

  

  function deletepicture(rowdata)
      {
        var okcancel = confirm("Are you sure to delete the picture?");

        if (okcancel) {
          $.ajax({
            type: "post",
            url: "<?php echo base_url().'articles/delete_image/'; ?>"+rowdata,
            success: function(response) {
              if (response) { 
                $(".rowdata_"+rowdata).fadeOut("fast");
                alert("Success delete data");
              } else {
                alert("Sory, failed delete your data.");
              };
            }
          });
        };
      };

      function remVid(rowdata)
      {
        var okcancel = confirm("Are you sure to delete the video URL?");

        if (okcancel) {
          $.ajax({
            type: "post",
            url: "<?php echo base_url().'articles/delete_video/'; ?>"+rowdata,
            success: function(response) {
              if (response) { 
                $(".id_"+rowdata).fadeOut("fast");
                alert("Success delete data");
              } else {
                alert("Sory, failed delete your data.");
              };
            }
          });
        };
      };
</script>