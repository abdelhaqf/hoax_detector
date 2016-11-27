<html>
	<head>
		<?php echo $style;?>
	</head>
	<body>
		<?php 
			echo $navbar;
		//  	echo $header;
		?>
		<!-- Begin Body -->
    <!-- modal login -->
    
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×</button>
                <h4 class="modal-title" id="myModalLabel">
                    Login/Registration - <a href="http://www.kurio.co.id">Kurio</a></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8" style="border-right: 1px dotted #C2C2C2;padding-right: 30px;">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#Login" data-toggle="tab">Login</a></li>
                            <li><a href="#Registration" data-toggle="tab">Registration</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <br>
                        <div class="tab-content">
                            <div class="tab-pane active" id="Login">
                                <form method="post" action="<?php echo base_url();?>index.php/Home/login" role="form" class="form-horizontal">
                                <div class="form-group">
                                    <label for="email" class="col-sm-2 control-label">
                                        Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="user" placeholder="Username" required/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1" class="col-sm-2 control-label">
                                        Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" name="pass" placeholder="Email" required/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2">
                                    </div>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            Submit</button>
                                        <a href="#">Forgot your password?</a>
                                    </div>
                                </div>
                                <br>
                                </form>
                            </div>
                            <div class="tab-pane" id="Registration">
                                <form role="form" method="post" class="form-horizontal" action="<?php echo base_url();?>index.php/Home/insert">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">
                                        Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="usernameRegister" placeholder="Username" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">
                                        Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" name="passwordRegister" placeholder="Password" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-2 control-label">
                                        First Name</label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <select class="form-control">
                                                    <option>Mr.</option>
                                                    <option>Ms.</option>
                                                    <option>Mrs.</option>
                                                </select>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Lirstname" name="firstnameRegister" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">
                                        Last Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="lastnameRegister" placeholder="Lastname" required/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">
                                        Job</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="jobRegister" placeholder="Job" required/>
                                    </div>
                                </div>
                               
                                <div class="row">
                                    <div class="col-sm-2">
                                    </div>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            Save & Continue</button>
                                        <button type="button" class="btn btn-default btn-sm">
                                            Cancel</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                      <!--
                        <div class="row text-center sign-with">
                            <div class="col-md-12">
                                <h3>
                                    Sign in with</h3>
                            </div>
                            <div class="col-md-12">
                                <div class="btn-group btn-group-justified">
                                    <a href="#" class="btn btn-primary">Facebook</a> <a href="#" class="btn btn-danger">
                                        Google</a>
                                </div>
                            </div>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- end modal login -->


<div class="container">
	<div class="no-gutter row">
      		<!-- left side column -->
  			<div class="col-md-2">
          <div class="panel panel-default" id="sidebar">
              <div class="panel-heading" style="background-color:#888;color:#fff;">Category</div> 
              <div class="panel-body">
      			      <ul class="nav nav-stacked">
                    <?php
                      for($i = 0 ; $i<count($TopicName) , $i<count($TopicId); $i++)
                      {
                        echo'
                          <li><a href="'.base_url().'index.php/Home/getDetails/'.$TopicId[$i].'">'.$TopicName[$i].'</a></li>
                        ';
                      }
                    ?>
                    
				          </ul>
                  <!--
                <div class="accordion" id="accordion2">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                                Accordion
                            </a>
                        </div>
                        <div id="collapseOne" class="accordion-body collapse in">
                            <div class="accordion-inner">
                                Content here for links, ads, etc.. 
                            </div>
                        </div>
                    </div>
                    <div class="accordion-group">
                            <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                                    Accordion
                                </a>
                            </div>
                            <div id="collapseTwo" class="accordion-body collapse">
                                <div class="accordion-inner">
                                    Another collapse panel. Content here for links, ads, etc.. 
                                </div>
                            </div>
                        </div>
               	</div><!--/acc
                  -->
                  <hr>
                  
                <div class="col col-span-12">
                  <i class="icon-2x icon-facebook"></i>&nbsp;
                  <i class="icon-2x icon-twitter"></i>&nbsp;
                  <i class="icon-2x icon-linkedin"></i>&nbsp;
                  <i class="icon-2x icon-pinterest"></i>
                </div>
                
                </div><!--/panel body-->
              </div><!--/panel-->
      		</div><!--/end left column-->
      			
      		<!--mid column-->
      		<div class="col-md-3">
              <div class="panel" id="midCol">
                <div class="panel-heading" style="background-color:#555;color:#eee;">Top Stories</div> 
                <div class="panel-body">
                  <?php
                      for($i = 0 ; $i<count($topTopicTitle) , $i<count($topTopicId); $i++)
                      {
                        // echo'
                        //   <li><a href="'.base_url().'index.php/Home/getDetails/'.$topTopicId[$i].'">'.$topTopicTitle[$i].'</a></li>
                        // ';
                        echo '
                        <div class="media">
                          <a class="pull-left" href="'.base_url().'index.php/Home/getDetails/'.$topTopicId[$i].'">
                            <img class="media-object" width=100px src='.$topTopicImg[$i].'>
                          </a>
                          <p>'.$topTopicCompare[$i].'</p>
                          <div class="media-body">
                          
                            <h5 class="media-heading"><a href="/tagged/modal" target="ext" class="pull-right"></i></a> <a href="'.base_url().'index.php/Home/article/'.$topTopicId[$i].'"><strong>'.$topTopicTitle[$i].'</strong></a></h5>
                            <small>'.$topTopicExcerpt[$i].'</small><br><br>';
                            $sess = $this->session->userdata('logged_in');
                            if($this->session->userdata('logged_in') && !in_array($topTopicId[$i], $sess['votes']))
                            {
                              echo'
                              <div id="'.$topTopicId[$i].'">
                                <a href=""><button class="btn btn-success vote" value="Y"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></button></a>
                                <a href=""><button class="btn btn-danger pull-right vote" value="N"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></button></a>
                              </div>';
                            }
                          echo'<p id="abiTop'.$topTopicId[$i].'">'.$topPersentage[$i].'</p>
                                <hr>
                          </div>
                        </div>
                          ';
                      }
                    ?>

               </div> 
               </div><!--/panel-->
      		</div><!--/end mid column-->
      		
      		<!-- right content column-->
      		<div class="col-md-7" id="content">
            	<div class="panel">
    			      <div class="panel-heading" style="background-color:#111;color:#fff;">Feed</div>   
              	<div class="panel-body">
                  <?php
                    for($i = 0 ; $i<count($this->session->flashdata('feedId')) ; $i++)
                    {
                      echo'
                        <div class="row">
                          <div class="col-md-12">
                            <img src="'.$this->session->flashdata('feedImg')[$i].'" class="img-responsive">
                      
                          </div> 
                            
                        </div>
                        
                        <hr>
                      
                        <h2><a href="'.base_url().'index.php/Home/article/'.$this->session->flashdata('feedId')[$i].'">'.$this->session->flashdata('feedTitle')[$i].'</a></h2>
                        <p>'.$this->session->flashdata('feedExcerpt')[$i].'</p>
                        <p id="abi'.$this->session->flashdata('feedId')[$i].'">'.$this->session->flashdata('feedPersentage')[$i].'</p>
                        <h5><a href="'.$this->session->flashdata('feedUrl')[$i].'">'.$this->session->flashdata('feedUrl')[$i].'</a></h5>
                        ';
                        $sess = $this->session->userdata('logged_in');

                        if($this->session->userdata('logged_in') && !in_array($this->session->flashdata('feedId')[$i], $sess['votes'])){
                        echo '
                        <div id="'.$this->session->flashdata('feedId')[$i].'">
                          <a href=""><button class="btn btn-success vote" value="Y"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></button></a>
                          <a href=""><button class="btn btn-danger pull-right vote" value="N"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></button></a>
                        </div>
                        <hr>
                      ';
                      }
                    }
                  ?>
                   
                  </div><!--/panel-body-->
                </div><!--/panel-->
              	<!--/end right column-->
      	</div> 
  	</div>
</div>
<?php 
  echo $footer;
  echo $script;
?>
  <script>
    $(document).ready(function(){
      $(".vote").click(function(event){
          event.preventDefault();
          var id = $(this).closest('div').attr('id');
          var voteType = $(this).attr('value');

          $.get("http://[::1]/hoax_detector/CI/index.php/Home/vote/"+id+"/"+voteType,function(data){
              alert('Vote anda berhasil dimasukan');
              $("#abi"+id).html(data);
              $("#abiTop"+id).html(data);
          });
          $(this).closest('div').remove();
          
      });
    })
</script>
	</body>

</html>