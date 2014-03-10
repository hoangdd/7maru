<?php
$this->Paginator->options(array(
    'update' => '#user_list',
    'evalScripts' => true
)); 
?>
<?php //$paginator = $this->Paginator; var_dump($data);die;  ?>
<!-- table -->
<div id="user_list">
    <h3 style="text-align:center">
        VIOLATION REPORT
    </h3>
    <div class="">
        <?php if (!empty($data)) { ?> 
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>

                        <th class='text-center' style="width:10%">
                            No.
                        </th>

                        <th class='' style="width:25%">
                            Name
                        </th>

                        <th class='text-center' style="width:20%">
                            Username
                        </th>
                        <th class='text-center' style="width:15%">
                            Comment
                        </th>
                        <th class='text-center' style="width:15%">
                            Block
                        </th>
                        <th class='text-center' style="width:15%">
                            Destroy
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($data as $key => $value) { //echo "<pre>";var_dump($value); die; 
                        ?>
                        <tr>
                            <td class='text-center'>
                                <?php echo $i; ?>
                            </td>
                            <td class=''>
                                <?php echo $value['User']['firstname'] . " " . $value['User']['firstname']; ?>
                            </td>

                            <td class='text-center'>
                                <?php echo $value['User']['username']; ?>
                            </td>
                            <td class='text-center'>
                                <input class="comment" type='checkbox' <?php if ($value['User']['comment']) echo 'checked="checked"'; ?>>
                            </td>
                            <td class='text-center'>
                                <a href='#'stt="<?php echo (int) $value['User']['block']; ?>" ><?php echo $this->element('user', array('statuts' => $value['User']['block'])) ?></a>
                            </td>

                            <td class='text-center'>
                                <a href='#'>Destroy</a>
                            </td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
        <?php }; ?>    
    </div>

<!-- paginate -->
<div class='text-center'>	
    <ul class="pagination">
        <?php
        echo $this->Paginator->prev('< ', array('tag' => 'li'), null, array('class' => 'disabled', 'tag' => 'li', 'disabledTag' => 'a'));
        echo $this->Paginator->numbers(array('tag' => 'li', 'separator' => '', 'currentClass' => 'active', 'currentTag' => 'a'));
        echo $this->Paginator->next(' >', array('tag' => 'li'), null, array('class' => 'disabled', 'tag' => 'li', 'disabledTag' => 'a',));
        ?>	 
    </ul>
    <?php
    ?>
</div>
<?php //echo $this->Js->writeBuffer(); ?>
</div>    
<script>
    jQuery(document).on("click", "td a[stt]", function() {
        var stt = $(this).attr('stt');
        var that = $(this);
        var username = $(this).parent().prev().prev().text().trim();
        if (stt != "") {
            var checkstr = confirm('Are you sure you want to update this?');
            if (checkstr == true) {
                $.ajax({
                    url: "blockUser",
                    type: 'post',
                    data: {
                        stt: stt.trim(),
                        username: username.trim(),
                        type: 1
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.msg == 'success') {
                            //alert("Tài khoản " + username + " đã được " + data.stt);
                            that.html(data.stt);
                            that.attr('stt', data.value);
                        }
                        if (data.msg == 'error') {
                            alert("Cập nhật thất bại");
                        }
                    },
                    error: function() {
                        alert("Có điều gì đó không ổn với mạng nhà bạn");
                    }
                });
                return false;
            } 
            else {
                return false;
            }
        }
    });

    jQuery(document).on("click", "td input.comment", function() {
        var cmt = $(this).is(':checked');
        var thats = $(this);
        var username = $(this).parent().prev().text().trim();
        $.ajax({
            url: "blockUser",
            type: 'post',
            data: {
                cmt: cmt,
                username: username.trim(),
                type: 1
            },
            dataType: 'json',
            success: function(data) {
                if (data.stt == 1)
                {
                    thats.prop('checked', true);
                }
                else
                    thats.prop('checked', false);

            },
            error: function() {
                alert("Có điều gì đó không ổn với mạng nhà bạn");
            }
        });
        return false;
    });

</script>