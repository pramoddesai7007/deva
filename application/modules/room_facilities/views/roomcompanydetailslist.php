<div class="card">
    <?php if($this->permission->method('room_companies','create')->access()): ?>
    <div class="card-header">
        <h4><?php echo display('room_company_details_list') ?><small class="float-right"><button type="button" class="btn btn-primary btn-md" data-target="#add0" data-toggle="modal"  ><i class="ti-plus" aria-hidden="true"></i>
        <?php echo display('add_company_details')?></button></small></h4>
    </div>
    <?php endif; ?>
    <div id="add0" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <strong><?php echo display('add_company_details');?></strong>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="panel">
                                
                                <div class="panel-body">
                                    <?php echo form_open_multipart('room_facilities/room_companidetails/create');
                                    ?>
                                    <?php echo form_hidden('companyid', (!empty($intinfo->companyid)?$intinfo->companyid:null)) ?>
                                    <!--div class="form-group row">
                                        <label for="facilititypeyname" class="col-sm-4 col-form-label"><?php echo display('add_facility_type') ?> <span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                        <?php echo form_dropdown('facilititypeyname',$facilitytype,'', 'class="selectpicker form-control" data-live-search="true" id="facilititypeyname"')?>
                                        </div>
                                    </div-->
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-4 col-form-label"><?php echo display('company_name') ?> <span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <input name="name" autocomplete="off" class="form-control" type="text" placeholder="<?php echo display('company_name') ?>" id="name" value="" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="address"
                                            class="col-sm-4 col-form-label"><?php echo display('address') ?>
                                            <!-- <span class="text-danger">*</span> --></label>
                                        <div class="col-sm-8">
                                            <textarea name="address" cols="35" rows="3" class="form-control"
                                                placeholder="<?php echo display('address') ?>"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="contact_person" class="col-sm-4 col-form-label"><?php echo display('company_contactperson') ?> <!-- <span class="text-danger">*</span> --></label>
                                        <div class="col-sm-8">
                                            <input name="contact_person" autocomplete="off" class="form-control" type="text" placeholder="<?php echo display('company_contactperson') ?>" id="contact_person" value="" >
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="contact" class="col-sm-4 col-form-label"><?php echo display('contact') ?> <!-- <span class="text-danger">*</span> --></label>
                                        <div class="col-sm-8">
                                            <input name="contact" autocomplete="off" class="form-control" type="text" placeholder="<?php echo display('contact') ?>" id="contact_person" value="" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" >
                                        </div>
                                    </div>
                                    <!--div class="form-group row">
                                        <label for="firstname" class="col-sm-4 col-form-label"><?php echo display('image') ?></label>
                                        <div class="col-sm-8">
                                            <input type="file" accept="image/*" name="facilitypicture" onchange="loadFile(event)"><a class="cattooltipsimg" data-toggle="tooltip" data-placement="top" title="Use only .jpg,.jpeg,.gif and .png Images"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                            <small id="fileHelp" class="text-muted"><img src="<?php echo html_escape(base_url(!empty($intinfo->image)?$intinfo->image:'assets/img/room-setting/room_images.png')); ?>" id="output" class="img-thumbnail height_150_width_200px jsclrimg"/>
                                            </small>
                                            <input type="hidden" name="old_image" value="<?php echo html_escape((!empty($intinfo->image)?$intinfo->image:null)) ?>">
                                        </div>
                                    </div-->
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
                <table id="companydetails" class="table table-striped table-bordered width_100">
                    <thead>
                        <tr>
                            <th><?php echo display('sl_no') ?></th>
                            <th><?php echo display('company_name') ?></th>
                            <th><?php echo display('address') ?></th>
                            <!-- <th><?php echo display('company_contactperson') ?></th> -->
                            <th><?php echo display('company_contactperson') ?></th>
                            <th><?php echo display('contact') ?></th>
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
    <script src="<?php echo MOD_URL.$module;?>/assets/js/roomCompanyDetail.js"></script>
    