<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel">
            
            <div class="panel-body">
                <?php echo form_open_multipart('room_facilities/room_companidetails/create') ?>
                <?php echo form_hidden('companyid', (!empty($intinfo->companyid)?$intinfo->companyid:null)) ?>
                <!--div class="form-group row">
                    <label for="facilititypeyname" class="col-sm-4 col-form-label"><?php echo display('add_facility_type') ?> <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <?php echo form_dropdown('facilititypeyname',$facilitytype,$facilitytype=$intinfo->facilitytypeid, 'class="selectpicker form-control" data-live-search="true" id="facilititypeyname"') ?>
                    </div>
                </div-->
                <div class="form-group row">
                    <label for="name" class="col-sm-4 col-form-label"><?php echo display('company_name') ?> <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input name="name" autocomplete="off" class="form-control" type="text" placeholder="<?php echo display('company_name') ?>" id="name" value="<?php echo $intinfo->name; ?>" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="address"
                        class="col-sm-4 col-form-label"><?php echo display('address') ?>
                        <!-- <span class="text-danger">*</span> --></label>
                    <div class="col-sm-8">
                        <textarea name="address" cols="35" rows="3" class="form-control"
                            placeholder="<?php echo display('address') ?>"><?php echo $intinfo->address; ?></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="contact_person" class="col-sm-4 col-form-label"><?php echo display('company_contactperson') ?> <!-- <span class="text-danger">*</span> --></label>
                    <div class="col-sm-8">
                        <input name="contact_person" autocomplete="off" class="form-control" type="text" placeholder="<?php echo display('company_contactperson') ?>" id="contact_person" value="<?php echo $intinfo->contact_person; ?>" >
                    </div>
                </div>

                <div class="form-group row">
                    <label for="contact" class="col-sm-4 col-form-label"><?php echo display('contact') ?> <!-- <span class="text-danger">*</span> --></label>
                    <div class="col-sm-8">
                        <input name="contact" autocomplete="off" class="form-control" type="text" placeholder="<?php echo display('contact') ?>" id="contact_person" value="<?php echo $intinfo->contact; ?>" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" >
                    </div>
                </div>
                <!--div class="form-group row">
                    <label for="firstname" class="col-sm-4 col-form-label"><?php echo display('image') ?></label>
                    <div class="col-sm-8">
                        <input type="file" accept="image/*" name="facilitypicture" onchange="loadFile(event)"><a class="cattooltipsimg" data-toggle="tooltip" data-placement="top" title="Use only .jpg,.jpeg,.gif and .png Images"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                        <small id="fileHelp" class="text-muted"><img src="<?php echo html_escape(base_url(!empty($intinfo->image)?$intinfo->image:'assets/img/room-setting/room_images.png')); ?>" id="output" class="img-thumbnail height_150_width_200px"/>
                        </small>
                        <input type="hidden" name="old_image" value="<?php echo html_escape(base_url(!empty($intinfo->image)?$intinfo->image:'assets/img/room-setting/room_images.png')); ?>">
                    </div>
                </div-->
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('update') ?></button>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>