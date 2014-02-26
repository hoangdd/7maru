<div class="row">
	<div class="col-md-3">
		<?php
		echo $this->Html->image('resource/ldp.jpg',array(
			'alt'=>'CakePHP',
			'width'=>'180px',
			'class' => 'img-rounded',
			'style' => 'text-align:center;'
			));
        echo "<br><br>";
		echo $this->Html->link('Statistic',
			'Statistic',array(
				'class'=>'btn btn-primary btn-lg',
				'role'=>'button',
				'style'=>'width:180px;height:30px;font-size:14px;text-align:center;padding: 6px;'
			));
		echo "<br><br>";
		echo $this->Html->link('ChangePassword',
			'ChangePassword',array(
				'class'=>'btn btn-primary btn-lg',
				'role'=>'button',
                'style'=>'width:180px;height:30px;font-size:14px;text-align:center;padding: 6px;'
			));
        echo "<br><br>";
        echo $this->Html->link('ChangeSecurity',
            'ChangeSecurity',array(
                'class'=>'btn btn-primary btn-lg',
                'role'=>'button',
                'style'=>'width:180px;height:30px;font-size:14px;text-align:center;padding: 6px;'
            ));
        echo "<br><br>";
        echo $this->Html->link('Destroy',
            'Delete Account',array(
                'class'=>'btn btn-primary btn-lg',
                'role'=>'button',
                'style'=>'width:180px;height:30px;font-size:14px;text-align:center;vertical-align: middle;padding: 6px;'
            ));
		?>

	</div>
	<div class="col-md-9" style="font-size:16px;font-family:”Times New Roman”;border:1px solid #a1a1a1;padding:10px 40px;background:#99FF00;width:600px;border-radius:25px;">
		<h1 style="text-align:center;font-family:”Times New Roman”;">Change Profile</h1>
		<br>
		<form class="form-horizontal" role="form">
             <div class="form-group" style="text-align:center;">
                <label class="col-sm-3 control-label">Email:</label>
                <div class="col-sm-6">
                <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                </div>
             </div>
             <div class="form-group">
                <label class="col-sm-3 control-label">Birthday:</label>
                 <div class="col-md-6">
                        <input type="date" class="form-control" placeholder="Birthday">
                 </div>
             </div>
             <div class="form-group">
                <label class="col-sm-3 control-label">Addresss:</label>
                <div class="col-sm-6">
                <input type="email" class="form-control" placeholder="Address">
                </div>
             </div>
             <div class="form-group">
                <label class="col-sm-3 control-label">Phone Number:</label>
                <div class="col-sm-6">
                <input type="email" class="form-control" placeholder="Phone Number">
                </div>
             </div>
             <div class="form-group">
                <label  class="col-sm-3 control-label">Bank Account:</label>
                <div class="col-sm-6">
                <input type="email" class="form-control"  placeholder="Bank Account">
                </div>
             </div>
             <div class="form-group">
                <label class="col-sm-3 control-label">Registration Day:</label>
                 <div class="col-md-6">
                        <input type="date" class="form-control" placeholder="Registration Day">
                 </div>
             </div>

            <div class="align-right" style="text-align:center;">
                <button type="button" class="btn btn-primary" type="submit">Save</button>
                <button type="button" class="btn btn-primary">Refresh</button>
            </div> 
        </form>     
	</div>
</div>