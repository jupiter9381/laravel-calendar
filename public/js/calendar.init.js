! function(o) {
    //var base_url = "http://localhost:8000/";
    var base_url = "https://app.germeda.de/public/";

    var month = $("input[name='month']").val();
    var roaster_id = $("input[name='roaster_id']").val(); 

    month = month.split('.')[2] + '-' + month.split('.')[1] + '-' + month.split('.')[0];
    "use strict";

    $("input[name='roaster_type']").attr('checked', false);

    var details = [];
    $.ajax({
        url : base_url + 'roasterdetail/getDetails',
        type : 'post',
        dataType : 'json',
        data: {roaster_id: roaster_id},
        success: function(data){
            var item;
            if($("input[name='auth_type']").val() == 0){
                for(var i = 0; i < data.length; i++){
                    item = {title: data[i]['shift_name'] + " " + data[i]['employee_name'] + " (" + data[i]['hours'] + ")", start: new Date(data[i]['date']), className: data[i]['shift_color'], id: data[i]['id'], employee_id: data[i]['employee_id'], hours: data[i]['hours']};
                    details.push(item);
                }
            } else {
                if(localStorage.getItem('roaster_type') === null){
                    $("#type_all").attr('checked', 'checked');
                    for(var i = 0; i < data.length; i++){
                        item = {title: data[i]['shift_name'] + " " + data[i]['employee_name'] + " (" + data[i]['hours'] + ")", start: new Date(data[i]['date']), className: data[i]['shift_color'], id: data[i]['id'], employee_id: data[i]['employee_id'], hours: data[i]['hours']};
                        details.push(item);
                    }
                } else {
                    if(localStorage.getItem('roaster_type') == 0){
                        $("#type_only").attr('checked', 'checked');
                        $employee_id = $("input[name='user_id']").val();
                        for(var i = 0; i < data.length; i++){
                            if(data[i]['employee_id'] == $employee_id){
                                item = {title: data[i]['shift_name'] + " " + data[i]['employee_name'] + " (" + data[i]['hours'] + ")", start: new Date(data[i]['date']), className: data[i]['shift_color'], id: data[i]['id'], employee_id: data[i]['employee_id'], hours: data[i]['hours']};
                                details.push(item);
                            }
                        }
                    } else {
                        $("#type_all").attr('checked', 'checked');
                        for(var i = 0; i < data.length; i++){
                            item = {title: data[i]['shift_name'] + " " + data[i]['employee_name'] + " (" + data[i]['hours'] + ")", start: new Date(data[i]['date']), className: data[i]['shift_color'], id: data[i]['id'], employee_id: data[i]['employee_id'], hours: data[i]['hours']};
                            details.push(item);
                        }
                    }
                }
            }
            
        }
    })
    var e = function() {
        this.$body = o("body"), this.$modal = o("#event-modal"), this.$event = "#external-events div.external-event", this.$calendar = o("#calendar"), this.$saveCategoryBtn = o(".save-category"), this.$categoryForm = o("#add-category form"), this.$extEvents = o("#external-events"), this.$calendarObj = null
    };
    e.prototype.onDrop = function(e, t) {
        var n = e.data("eventObject"),
            a = e.attr("data-class"),
            l = o.extend({}, n);
        l.start = t, a && (l.className = [a]), this.$calendar.fullCalendar("renderEvent", l, !0), o("#drop-remove").is(":checked") && e.remove()
    }, e.prototype.onEventClick = function(t, e, n) {

        var a = this,
            l = o("<form></form>");
            if($("input[name='auth_type']").val() == '1'){
                if($("input[name='user_id']").val() != t.employee_id){
                    return;
                } 
            }
             a.$modal.modal({
                backdrop: "static"
            }), a.$modal.find(".delete-event").show().end().find(".save-event").hide().end().find(".modal-body").empty().prepend(l).end().find(".delete-event").unbind("click").click(function() {
                var id = t.id;
                $.ajax({
                    url : base_url + 'roasterdetail/delete',
                    type : 'post',
                    dataType : 'json',
                    data: {id: id},
                    success: function(data){
                        
                    }
                })
                a.$calendarObj.fullCalendar("removeEvents", function(e) {
                    return e._id == t._id
                }), a.$modal.modal("hide")
            }), a.$modal.find("form").on("submit", function() {
                return t.title = l.find("input[type=text]").val(), a.$calendarObj.fullCalendar("updateEvent", t), a.$modal.modal("hide"), !1
            })
        
    }, e.prototype.onSelect = function(n, a, e) {
    }, e.prototype.enableDrag = function() {
        o(this.$event).each(function() {
            var e = {
                title: o.trim(o(this).text())
            };
            o(this).data("eventObject", e), o(this).draggable({
                zIndex: 999,
                revert: !0,
                revertDuration: 0
            })
        })
    }, e.prototype.init = function() {
        this.enableDrag();
        var e = new Date,
            t = (e.getDate(), e.getMonth(), e.getFullYear(), new Date(o.now())),
            n = [],
            a = this;
            
        setTimeout(function() {
            a.$calendarObj = a.$calendar.fullCalendar({
                slotDuration: "00:15:00",
                minTime: "08:00:00",
                maxTime: "19:00:00",
                defaultView: "month",
                handleWindowResize: !0,
                height: o(window).height() - 150,
                header: {
                    center: "title",
                    right: "month"
                },
                firstDay: 1,
                events: details,
                editable: !0,
                droppable: !0,
                eventLimit: !0,
                selectable: !0,
                locale: 'de',
                defaultDate: new Date(month),
                drop: function(e) {
                    var date = new Date(e._i);
                    var dd = String(date.getDate()).padStart(2, '0');
                    var mm = String(date.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = date.getFullYear();

                    date = yyyy + '-' + mm + '-' + dd;
                    var shift_id = o(this).attr('shift-id');
                    var employee_id = o(this).attr('employee-id');
                    var $this = o(this);
                    $.ajax({
                        url : base_url + 'roasterdetail/set_shift',
                        type : 'post',
                        dataType : 'json',
                        data: {shift_id: shift_id, employee_id: employee_id, date: date, roaster_id: roaster_id},
                        success: function(data){
                            console.log(data);
                            if(data['result'] == "existed"){

                            } else {
                                a.onDrop($this, e);
                            }
                        }
                    })
                    
                },
                select: function(e, t, n) {
                    a.onSelect(e, t, n)
                },
                eventClick: function(e, t, n) {
                    a.onEventClick(e, t, n)
                },
                eventDrop: function(event, delta, revertFunc) {
                    console.log(event);
                },
                dayRender: function(date, cell){
                    var date = new Date(date);
                    var year = date.getFullYear();
                    var month = date.getMonth() + 1;
                    if(month < 10) month = "0" + month;
                    var day = date.getDate();
                    if(day < 10) day = "0" + day;
                    var cell_date = year + "-" + month + "-" + day;

                    var total_hours = 0;
                    for(var i = 0; i < details.length; i++){
                        date = details[i]['start'];

                        var year = date.getFullYear();
                        var month = date.getMonth() + 1;
                        if(month < 10) month = "0" + month;
                        var day = date.getDate();
                        if(day < 10) day = "0" + day;

                        var detail_date = year + "-" + month + "-" + day;
                        if(cell_date == detail_date){
                            total_hours += details[i]['hours'];
                            
                        }
                    }
                    if(total_hours == 24){
                        cell.css('background-color', '#CFF5F2');
                    } else {
                        cell.css('background-color', '#FDDDDD');
                    }
                },
            })
        }, 2000);
        
    }, o.CalendarApp = new e, o.CalendarApp.Constructor = e
}(window.jQuery),
function(e) {
    "use strict";
    window.jQuery.CalendarApp.init()
}();