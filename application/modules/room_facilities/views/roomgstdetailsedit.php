<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel">
            
            <div class="panel-body">
                <?php echo form_open_multipart('room_facilities/room_gstidetails/create') ?>
                <?php echo form_hidden('gstid', (!empty($intinfo->gstid)?$intinfo->gstid:null)) ?>
                
                <div class="form-group row">
                    <label for="from" class="col-sm-4 col-form-label">GST Range : <?php echo display('from') ?> <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input name="fromgst" autocomplete="off" class="form-control" type="text" placeholder="<?php echo display('from') ?>" id="fromgst" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" value="<?php echo $intinfo->fromgst; ?>" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="to" class="col-sm-4 col-form-label"><?php echo display('to') ?> <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input name="togst" autocomplete="off" class="form-control" type="text" placeholder="<?php echo display('to') ?>" id="togst" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" value="<?php echo $intinfo->togst; ?>" required >
                    </div>
                </div>


                <div class="form-group row">
                    <label for="gst" class="col-sm-4 col-form-label"><?php echo display('gst') ?> <!-- <span class="text-danger">*</span> --></label>
                    <div class="col-sm-8">
                        <input name="gst" autocomplete="off" class="form-control" type="text" placeholder="<?php echo display('gst') ?>" id="gst" value="<?php echo $intinfo->gst; ?>" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" required >
                    </div>
                </div>

                <div class="form-group text-right">
                    <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('update') ?></button>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>