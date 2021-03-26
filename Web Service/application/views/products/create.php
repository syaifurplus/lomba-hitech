<form method="post" action="<?php echo base_url('productsCreate');?>">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="form-group">
                <label class="col-md-3">RT</label>
                <div class="col-md-9">
                    <input type="text" name="title" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <div class="form-group">
                <label class="col-md-3">RW</label>
                <div class="col-md-9">
                    <input type="text" name="description" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-md-8 col-md-offset-2 pull-right">
            <input type="submit" name="Save" class="btn">
        </div>
    </div>
    
</form>