<div  id="collapseExample">
    <br>
    <div class="card no-prints">
        <div class="card-body">
            <div class="body">
                <form method="get">
                    <div class="row clearfix">
                        
                        <div class="col-md-3">
                            <div class="form-group  form-float">
                                <select class="form-control show-tick" name="status">
                                    <option value="">User Type</option>
                                    <option value="0">User</option>
                                    <option value="1">Member</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-daterange input-group" id="bs_datepicker_range_container">
                                <div class="form-line">
                                    <input type="text" class="form-control datepicker" id="from_date" name="from_date" placeholder="From Date" autocomplete="off" value="{{request('from_date')}}">
                                </div>
                                <span class="input-group-addon">&nbsp;to&nbsp;</span>
                                <div class="form-line">
                                    <input type="text" class="form-control datepicker" id="to_date" name="to_date" placeholder="To Date" autocomplete="off" value="{{request('to_date')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group form-float">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary mr-2">
                                            <i class="fa fa-search" aria-hidden="true"></i> Search
                                        </button>

                                        <a href="{{request()->url()}}" class="btn btn-danger mr-2">
                                            <i class="fa fa-times" aria-hidden="true"></i>Close
                                        </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>




            </div>


            

            </form>
        </div>
    </div>
</div>