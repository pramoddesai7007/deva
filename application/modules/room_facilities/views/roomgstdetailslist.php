<div class="card">
    <?php if($this->permission->method('room_gsties','create')->access()): ?>
    <div class="card-header">
        <h4><?php echo display('room_gst_details_list') ?><small class="float-right"><button type="button" class="btn btn-primary btn-md" data-target="#add0" data-toggle="modal"  ><i class="ti-plus" aria-hidden="true"></i>
        <?php echo display('add_gst_details')?></button></small></h4>
    </div>
    <?php endif; ?>
    <div id="add0" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <strong><?php echo display('add_gst_details');?></strong>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="panel">
                                
                                <div class="panel-body">
                                    <?php echo form_open_multipart('room_facilities/room_gstidetails/create');
                                    ?>
                                    <?php echo form_hidden('gstid', (!empty($intinfo->gstid)?$intinfo->gstid:null)) ?>
                                    
                                    <div class="form-group row">
                                        <label for="from" class="col-sm-4 col-form-label">GST Range : <?php echo display('from') ?> <span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <input name="fromgst" autocomplete="off" class="form-control" type="text" placeholder="<?php echo display('from') ?>" id="fromgst" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" value="" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="to" class="col-sm-4 col-form-label"><?php echo display('to') ?> <span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <input name="togst" autocomplete="off" class="form-control" type="text" placeholder="<?php echo display('to') ?>" id="togst" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" value="" required >
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="gst" class="col-sm-4 col-form-label"><?php echo display('gst') ?> <!-- <span class="text-danger">*</span> --></label>
                                        <div class="col-sm-8">
                                            <input name="gst" autocomplete="off" class="form-control" type="text" placeholder="<?php echo display('gst') ?>" id="gst" value="" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" required >
                                        </div>
                                    </div>
                                    
                                    <div class="form-group text-right">
                                        <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                                        <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('ad') ?></button>
                                    </div>
                                    <?php echo form_close() ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                </div>
                
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
    <div id="edit" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <strong><?php echo display('update');?></strong>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body editinfo">
                    
                </div>
                
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
    <div class="row">
        <!--  table area -->
        <div class="col-sm-12">
            <div class="card-body">
                <div class="table-responsive">
                <table id="gstdetails" class="table table-striped table-bordered width_100">
                    <thead>
                        <tr>
                            <th><?php echo display('sl_no') ?></th>
                            <th><?php echo display('from') ?></th>
                            <th><?php echo display('to') ?></th>
                            <th><?php echo display('gst') ?></th>
                            <th><?php echo display('action') ?></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    </table>  <!-- /.table-responsive -->
                </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo MOD_URL.$module;?>/assets/js/roomGstDetail.js"></script>
    