</div>
<script src="{{config('domain')}}/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
<script src="{{config('domain')}}/assets/plugins/jquery/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="{{config('domain')}}/assets/plugins/modernizr.custom.js" type="text/javascript"></script>
<script src="{{config('domain')}}/assets/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="{{config('domain')}}/assets/plugins/popper/umd/popper.min.js" type="text/javascript"></script>
<script src="{{config('domain')}}/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="{{config('domain')}}/assets/plugins/jquery/jquery-easy.js" type="text/javascript"></script>
<script src="{{config('domain')}}/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
<script src="{{config('domain')}}/assets/plugins/jquery-ios-list/jquery.ioslist.min.js" type="text/javascript"></script>
<script src="{{config('domain')}}/assets/plugins/jquery-actual/jquery.actual.min.js"></script>
<script src="{{config('domain')}}/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(e){
        //var base_url = 'http://localhost:8000/';
        var base_url = "https://app.germeda.de/public/";
        $(".accept-btn").click(function(){
            $.ajax({
                url : base_url + 'payroll/setStatus',
                type : 'post',
                dataType : 'json',
                data: {status: 'Accepted', id: $(this).attr('payroll-id')},
                success: function(data){
                    setTimeout(function() {
                        $(".card-title").html("You just accepted right now!");
                    }, 1000);
                }
            });
        });
        $(".ask-btn").click(function(){
            $.ajax({
                url : base_url + 'payroll/setStatus',
                type : 'post',
                dataType : 'json',
                data: {status: 'Ask for change', id: $(this).attr('payroll-id')},
                success: function(data){
                    setTimeout(function() {
                        $(".card-title").html("You just asked for change to the admin!");
                    }, 1000);
                }
            });
        });

    });
</script>