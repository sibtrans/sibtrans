var req;
function arr2string(arr) {
    var str="";
    for(var key in arr){
        var val=arr[key];
        str+="\&"+key+"="+val;
    }
    str=str.substring(1);
    return str;
}
function openWindow(type,params){
    addr="./print.php?type="+type+"&"+arr2string(params);
    var w = window.open(addr, "Печать документов", "menubar=no,toolbar=no,location=no,status=no,resizable=no,scrollbars=no");
}
$( document ).ready(function() {
    $('body').on('click', '.requests .result .data-row td[class != replaceForm]', function(){
        var un = $('#requests_filter input[name=un]').val();
        var ss_code = $('#requests_filter input[name=ss_code]').val();
        var code_1c = $(this).parent().find('td').eq(0).data('1c');
        var doc_num = $(this).parent().find('td').eq(1).text();

        openWindow("request",{'un':un, 'ss_code':ss_code, 'code_1c':code_1c});
    });
});
function updateDataShow(){
    $('#content_cal').css("display","none");


    // console.log(val_from);
    //console.log(val_to);

    $('#max_calc [data-show]').each(function(){
        if($(this).is(':checked')){
            $($(this).nextAll(".data-show-content")[0]).css("display","block");
        }
    });


    $('#max_calc [data-show]').unbind("change").bind("change",function(d){
        console.log('#max_calc [data-show]');
        if($(this).is(':checked')){
            $($(this).nextAll(".data-show-content")[0]).css("display","block");

            $($(this).nextAll(".data-show-content-yourself")[0]).css("display","none");
            $($(this).nextAll(".data-show-content-yourself")[0]).find('input').val("");

            console.log($(this).nextAll(".data-show-content"));


        } else {
            $($(this).nextAll(".data-show-content")[0]).css("display","none");

            // очистка input при снятии флажка
            $($(this).nextAll(".data-show-content")[0]).find('input').val("");

            // снятие флажка у дочерних элементов
            if($(this).attr("id") == "chBoxAddServiseDelivIn_Id")
            {
                $(this).parent().find('input[type="checkbox"]').each(function(){

                    //console.log(this);
                    $(this).prop('checked', false);
                });

                $(this).parent().find('div.data-show-content.mla').each(function(){
                    $(this).css("display","none");
                });
            }
            else if($(this).attr("id") == "chBoxAddServiseDelivOut_Id")
            {
                $(this).parent().find('input[type="checkbox"]').each(function(){

                    $(this).prop('checked', false);
                });

                $(this).parent().find('div.data-show-content.mla').each(function(){
                    $(this).css("display","none");
                });
            }


            console.log($(this).nextAll(".data-show-content"));
        }
    });

    // переключатель в заявке: "забрать груз",  "доставлю самостоятельно"
    $('#yourself_BOXDeliveryOut_Id').unbind("change").bind("change",function(){

        if($(this).is(':checked')){

            $($(this).nextAll(".data-show-content-yourself")[0]).css("display","block");

            $($(this).nextAll(".data-show-content")[0]).css("display","none");
            $($(this).nextAll(".data-show-content")[0]).find('input').val("");
            //console.log($(this).nextAll(".data-show-content"));
        }
    });






    $('#typeClientSend_fis_id').unbind("change").bind("change",function(d){
        //	console.log(this);
        if($(this).is(':checked')){

            $('.data-show-send-content-fis').css("display","block");
            $('.data-show-send-content-ur').css("display","none");
            $('.data-show-send-content-ur').find('input').each(function(){ $(this).val("");})


            $("#sender_ur_Zapolnit_lc_Id").prop('checked', false); // снимаем галочку с Юрика  при переключ на  Физика

        }

        //console.log($(this).nextAll(".data-show-content"));
    });


    $('#typeClientSend_ur_id').unbind("change").bind("change",function(d){
        //	console.log(this);
        if($(this).is(':checked')){

            $('.data-show-send-content-fis').css("display","none");
            $('.data-show-send-content-fis').find('input').each(function(){ $(this).val("");})

            $('.data-show-send-content-ur').css("display","block");

            $( "#sender_fis_Zapolnit_lc_Id" ).prop('checked', false); // снимаем галочку с Физика при переключ на Юрика

        }
    });




    $('#typeClientResiv_fis_id').unbind("change").bind("change",function(d){
        //	console.log(this);
        if($(this).is(':checked')){

            $('.data-show-resiv-content-fis').css("display","block");
            $('.data-show-resiv-content-ur').css("display","none");
            $('.data-show-resiv-content-ur').find('input').each(function(){ $(this).val("");})

            $("#resiv_ur_Zapolnit_lc_Id").prop('checked', false); // снимаем галочку с Юрика  при переключ на  Физика
        }

        //console.log($(this).nextAll(".data-show-content"));
    });


    $('#typeClientResiv_ur_id').unbind("change").bind("change",function(d){
        //	console.log(this);
        if($(this).is(':checked')){

            $('.data-show-resiv-content-fis').css("display","none");
            $('.data-show-resiv-content-fis').find('input').each(function(){ $(this).val("");})


            $('.data-show-resiv-content-ur').css("display","block");

            $( "#resiv_fis_Zapolnit_lc_Id" ).prop('checked', false); // снимаем галочку с Физика при переключ на Юрика
        }
    });




    $('#typeClientPay_fis_id').unbind("change").bind("change",function(d){
        //	console.log(this);
        if($(this).is(':checked')){

            $('.data-show-pay-content-fis').css("display","block");

            $('.data-show-pay-content-ur').css("display","none");
            $('.data-show-pay-content-ur').find('input').each(function(){ $(this).val("");})

            $("#pay_ur_Zapolnit_lc_Id").prop('checked', false); // снимаем галочку с Юрика  при переключ на  Физика
        }

        //console.log($(this).nextAll(".data-show-content"));
    });


    $('#typeClientPay_ur_id').unbind("change").bind("change",function(d){
        //	console.log(this);
        if($(this).is(':checked')){

            $('.data-show-pay-content-fis').css("display","none");
            $('.data-show-pay-content-fis').find('input').each(function(){ $(this).val("");})

            $('.data-show-pay-content-ur').css("display","block");

            $( "#pay_fis_Zapolnit_lc_Id" ).prop('checked', false); // снимаем галочку с Физика при переключ на Юрика
        }
    });




}
function doMiniCalcReqList(){
    if(!parseInt($('#city_from_List input, #city_from_List_cc input').attr("selectedid"))>0)return false;
    if(!parseInt($('#city_to_List input').attr("selectedid"))>0)return false;
    if(!parseInt($('#weight_List input').val())>0)return false;
    if(!parseFloat($('#vol_List input').val())>0)return false;
    if(req !== undefined){
        req.abort();
        $('#miniCalcLoader').fadeOut(200);
    }

    //function GetUrl(){
    //  if(window.location.href.toLowerCase().indexOf("/rates/sbornye-avto-zhd-perevozki.php") >= 0) {
    //  return "/rates/sbornye-avto-zhd-perevozki_Ajax.php"; }
    //  else{ return "/cost-calculation/cost-calculation_Ajax.php"; }
    // }

    console.log(window.location.href.replace(".php","_Ajax.php"), 'main.js');

    req=$.ajax({
        url: window.location.href.replace(".php","_Ajax.php"),
        method:"POST",
        data:{
            "from":$('#city_from_List input').attr("selectedid"),
            "to":$('#city_to_List input').attr("selectedid"),
            "GorodFrom_Id": $('#GorodFrom_Id').is(':checked'),
            "GorodTo_Id": $('#GorodTo_Id').is(':checked'),
            "DopServiceFrom_Id": $('#DopServiceFrom_Id').is(':checked'),
            "DopServiceTo_Id": $('#DopServiceTo_Id').is(':checked'),

            "weight": $('#weight').val(),
            "volume": $('#volume').val(),
            "place": $('#place').val(),

        },
        dataType:"text",
        async:true,

        success: function(html){
            $('#content_p').html(html);

            updateDataShow();

            $(".numbers").keydown(function (e) {
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                    // Allow: Ctrl+A, Command+A
                    ((e.keyCode == 65 || e.keyCode == 86 || e.keyCode == 67 || e.keyCode == 88) && (e.ctrlKey || e.metaKey )) ||
                    // Allow: home, end, left, right, down, up
                    (e.keyCode >= 35 && e.keyCode <= 40)) {

                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });


            $('.numbers_comma').keypress(function(event) {
                var $this = $(this);


                if ((event.which != 46 || $this.val().indexOf('.') != -1) &&
                    ((event.which < 48 || event.which > 57) &&
                        (event.which != 0 && event.which != 8)) && event.ctrlKey !== true) {
                    event.preventDefault();
                }

                var text = $(this).val();

                if ((event.which == 46) && (text.indexOf('.') == -1)) {
                    setTimeout(function() {
                        if ($this.val().substring($this.val().indexOf('.')).length > 3) {
                            $this.val($this.val().substring(0, $this.val().indexOf('.') + 3));
                        }
                    }, 1);
                }

                if ((text.indexOf('.') != -1) &&
                    (text.substring(text.indexOf('.')).length > 2) &&
                    (event.which != 0 && event.which != 8) &&
                    ($(this)[0].selectionStart >= text.length - 2)) {
                    event.preventDefault();
                }
            });




            $('.Russian-letters').off('keypress').on('keypress', function() {
                var that = this;
                setTimeout(function() {
                    var res = /[^а-яА-Я -]/g.exec(that.value);
                    console.log(res);
                    that.value = that.value.replace(res, '');
                }, 0);
            });



            $('.Russian-letters').off('keypress').keypress(function() {
                var dInput = this.value;

                $(this).attr("selectedid","244");
            });


            $('#form-calk-order').submit();

            $('#form-calk-order input').on('change',function(){
                $('#form-calk-order').submit();
                console.log('change');
            });


            $(function(){
                $('.hintModal').hintModal({

                    overflowContent : true

                });
            });


        }

    });









}
function showList(sel,full){
    if(sel === undefined)return;
    if(full === undefined)full=true;
    if(full=='')full=true;
    var list=sel.find('.city_list_List');
    var inp=sel.find('input');
    list.find('.city_item_List').each(function(){
        if(full==true){
            $(this).removeClass('disabled');
            $(this).html($(this).text());
        } else {
            //var txt=inp.val();
            //var itm=$(this).text();

            var txt = inp.val();
            var itm=$(this).text();

            if(itm.toLowerCase().indexOf(txt.toLowerCase())!==-1){

                $(this).removeClass('disabled');
                $(this).html(itm.replace(txt,'<b>'+txt+'</b>'));
            } else {
                $(this).addClass('disabled');
            }
        }
        $(this).unbind('click').bind('click',function(){
            inp.val($(this).text());
            inp.attr("selectedID",$(this).attr("id").replace('city',''));

            //console.log('change_selectedID');

            if(list.parent().attr('id') == "city_from_List_cc") // что бы при выборе характера груза не перегружалась страница
            {
                list.parent().find('input').trigger('click'); // при коорректном заполнении поля input характер груза нужно снять, убрать класс error, плагин так настроен что делает это по клику в поле,
                // а снять нужно у div, для этого вызывается click
            }
            else{doMiniCalcReqList();
            }

            list.fadeOut(100);
        });
        if(!$(this).hasClass('disabled')){
            $(this).html(fl2Upper($(this).html()));
        }
    });
    list.fadeIn(200);
}
function cityListReload(){
    if($('.city-select_List').length>0){



        $('.city-select_List').each(function(){
            var btn=$(this).find('.btn_down_List');

            var list=$(this).find('.city_list_List');
            var par=$(this);
            var input=$('<input type="text" class="Russian-letters" maxlength="50" style="max-width:350px;"/>');
            var attrCC = $(this).attr('data-CharacterCargo');



            if (typeof attrCC !== typeof undefined && attrCC !== false) {
                input.attr('placeholder', 'Выбрать характер груза');
                input.attr('name', 'input_Charakter_Cargo');
                input.css('color', 'black');
                input.attr('maxlength', '150');
            }
            else{
                input.attr('placeholder', 'Выбрать город');

            }

            input.unbind('click').bind('click',function(){
                $(this).trigger('keyup');
            });
            input.unbind('keyup').bind('keyup',function(e){

                var show=list.find('.city_item_List').not('.disabled');

                var code = e.keyCode || e.which;
                if(code==13){

                    if(show.length>0){
                        $(show[0]).trigger('click');
                    }

                }else if(show.length==1 && input.val().toLowerCase() == $(show[0]).text().toLowerCase() ){

                    $(show[0]).trigger('click');


                }else {
                    showList(par,$(this).val());

                }
            });
            par.append(input);

            // проверка параметров в url
            var paramsGet = window
                .location
                .search
                .replace('?','')
                .split('&')
                .reduce(
                    function(p,e){
                        var a = e.split('=');
                        p[ decodeURIComponent(a[0])] = decodeURIComponent(a[1]);
                        return p;
                    },
                    {}
                );
            //******
            if(paramsGet['ccargo'] !== undefined) // выставляем хараетер груза из калькулятора в заявке
            {
                list.find('.city_item_List').each(function(){
                    var t=$(this).text();
                    var ii=$(this).attr("id").replace("city","");

                    if((t==paramsGet['ccargo'])&&(par.attr("id")=="city_from_List_cc")){
                        input.attr("selectedid",ii);
                        input.val($(this).text());
                    }

                });
            }

            if(paramsGet['from'] !== "undefined" &&  paramsGet['to'] !== "undefined" && paramsGet['from']!== undefined && paramsGet['to'] !== undefined)
            {

                console.log(paramsGet['from'] + ' ' +  paramsGet['to']);

                list.find('.city_item_List').each(function(){
                    var t=$(this).text();
                    var ii=$(this).attr("id").replace("city","");
                    if((t==paramsGet['from'])&&(par.attr("id")=="city_from_List")){
                        input.attr("selectedid",ii);
                        input.val($(this).text());
                    }
                    if((t==paramsGet['to'])&&(par.attr("id")=="city_to_List")){
                        input.attr("selectedid",ii);
                        input.val($(this).text());
                    }
                });



            }else{

                list.find('.city_item_List').each(function(){
                    var t=$(this).text();
                    var ii=$(this).attr("id").replace("city","");
                    if((t=='Новосибирск')&&(par.attr("id")=="city_from_List")){
                        input.attr("selectedid",ii);
                        input.val($(this).text());
                    }
                    if((t=='Москва')&&(par.attr("id")=="city_to_List")){
                        input.attr("selectedid",ii);
                        input.val($(this).text());
                    }
                });
            }
            btn.off('click').click(function(){
                if(par.find('.city_list_List').css("display")=="none"){
                    showList(par,true);
                } else {
                    input.trigger("blur");
                }
            });
        });

    }
}
function showMessage(title,text,icon){
    var wrapper=$('<div></div>');
    var alert0=$('<div></div>');
    var caption=$('<div></div>');
    var txt=$('<div></div>');
    var btn=$('<div>OK</div>');
    var icn=$('<div></div>');
    wrapper.click(function(){
        wrapper.fadeOut(300);
        alert0.fadeOut(300);
    });
    alert0.click(function(e){
        e.preventDefault();
        e.stopPropagation();
    });
    btn.click(function(){
        wrapper.trigger('click');
    });
    if(typeof icon !="undefined"){
        icn.addClass("alert-icon");
        icn.addClass(icon);
        txt.addClass("vi");
    }
    caption.addClass("alert-caption");
    txt.addClass("alert-text");
    btn.addClass("alert-button");
    alert0.addClass("alert-wnd");
    wrapper.addClass("black-wrapper");
    wrapper.append(alert0);
    alert0.append(caption);
    alert0.append(icn);
    alert0.append(txt);
    alert0.append('<div class="clear"></div>');
    alert0.append(btn);
    txt.html(text);
    caption.html(title);
    $('body').append(wrapper);

}
function fl2Upper(str){
    var fc=str.substring(0,1).toUpperCase();
    var ex="";
    if(fc=='<'){
        fc='<b>'+str.substring(3,4).toUpperCase();
        ex=str.substring(4,str.length);
    } else {
        ex=str.substring(1,str.length);
    }
    return fc+ex;
}
$(document).ready(function(){
    if($('#lc-sendmsg').length>0){
        $('#lc-sendmsg').click(function(){
            var form=$('#frmLCFeedback');
            var dta=form.serialize()+"&action=lc-msg";
            $.ajax({
                type: "POST",
                url: "/formsSender.php",
                data: dta,
                dataType:"json",
                success: function(result){
                    console.log(result);
                    if(result.state=="success")
                        $('#lc-feedback-popup').dialogModal({
                            topOffset: 0,
                            top: '12%',
                            onDocumentClickClose: false,
                            onOkBut: function (event, el, current) { $('#id_callback_popup').popModal('hide'); },
                            onLoad: function (el, current) { },
                            onClose: function (el, current) { $('#id_callback_popup').popModal('hide'); },
                            onCancelBut: function (event, el, current) { $('#id_callback_popup').popModal('hide'); }
                        });
                },
                complete: function(a,b){
                    console.log(a,b);
                }
            });
        });

    }
    if($('#btnRegisterUser').length>0){
        $('#btnRegisterUser').click(function(){
            var res_div=$('#registerResult');
            var uid=$('input[name=uid]').val();

            //console.log(uid);

            $.ajax({
                type: "POST",
                url: "/register.request.php",
                data: {"un":uid},
                dataType:"json",
                beforeSend: function(){
                    res_div.html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>');
                },
                success: function(result){



                    var cnt=$('#dlgRegister').find('.dialogModal_content');
                    cnt.html("");
                    if(result.result=="error"){
                        if(result.msg=="unique failed"){
                            cnt.html("Не указан уникальный идентификатор");
                        }
                        if(result.msg=="unique length"){
                            cnt.html("Уникальный идентификатор должен быть 8 символов длиной");
                        }
                        if(result.msg=="user exists"){
                            cnt.html("Пользователь уже существует. Попробуйте воспользоваться функцией <a href=\"/lc/?forgot_password=yes\">восстановление пароля</a>");
                        }
                        if(result.msg=="unknown uid"){
                            cnt.html("Уникальный идентификатор не найден. Проверьте правильность написания, либо свяжитесь с нами!");
                        }

                    }
                    if(result.result=="ok"){
                        cnt.html("<b>Вы были успешно зарегистрированы!<br/>Ваш логин: <b>"+result.login+"</b><br/>Ваш пароль: <b>"+result.psw+"</b>");
                    }
                    if(cnt.html().length>0){
                        $('#dlgRegister').dialogModal({
                            topOffset: 0,
                            top: '12%',
                            onDocumentClickClose: false,
                            onOkBut: function (event, el, current) { if(result.result=="ok"){window.location.href = "/lc/";}  },
                            onLoad: function (el, current) { },
                            onClose: function (el, current) { if(result.result=="ok"){window.location.href = "/lc/";} },
                            onCancelBut: function (event, el, current) {  if(result.result=="ok"){window.location.href = "/lc/";} }
                        })
                    }
                },
                complete: function(a,b){
                    res_div.html("");
                    console.log(a,b);
                }
            });
        });
    }
    if($('.act_s').length>0){
        $('.act_s').click(function(){
            var now = new Date();
            var year=now.getFullYear();
            var fr="01.01."+year.toString();
            var to=now.getDate()+"."+(now.getMonth()+1)+"."+year;
            if(($('input[name=date_from]').length>0)&&($('input[name=date_from]').val()!=""))fr=$('input[name=date_from]').val();
            if(($('input[name=date_to]').length>0)&&($('input[name=date_to]').val()!=""))to=$('input[name=date_to]').val();
            openWindow("act_sverki",{'ds':fr,'de':to,'un':$(this).attr('data-un')});
            return false;
        });
    }
    // закрывание выпадающего списка
    $('body').click(function(){
        $('.btn_down, .btn_down_List').click(function(e){
            return false;
        });

        if($('input:focus').length == 0)
        {
            $('.city_list, .city_list_List').css('display','none');
        }

    });




    $('.numbers_comma').keypress(function(event) {
        var $this = $(this);

        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(event.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
            // Allow: Ctrl+A, Command+A
            ((event.keyCode == 65 || event.keyCode == 86 || event.keyCode == 67 || event.keyCode == 88) && (event.ctrlKey || event.metaKey )) ||
            // Allow: home, end, left, right, down, up
            (event.keyCode >= 35 && event.keyCode <= 40)) {

            return;
        }




        if ((event.which != 46 || $this.val().indexOf('.') != -1) &&
            ((event.which < 48 || event.which > 57) &&
                (event.which != 0 && event.which != 8) ) && event.ctrlKey !== true) {

            console.log('event.preventDefault', event.which, $this.val().indexOf('.'), event.ctrlKey);
            event.preventDefault();
        }


        var text = $(this).val();

        if ((event.which == 46) && (text.indexOf('.') == -1)) {
            setTimeout(function() {
                if ($this.val().substring($this.val().indexOf('.')).length > 3) {
                    $this.val($this.val().substring(0, $this.val().indexOf('.') + 3));
                }
            }, 1);
        }

        if ((text.indexOf('.') != -1) &&
            (text.substring(text.indexOf('.')).length > 2) &&
            (event.which != 0 && event.which != 8) &&
            ($(this)[0].selectionStart >= text.length - 2)) {
            event.preventDefault();
        }
    });




    var curRequest; //Запросы личного кабинета
    function gv(o){
        if( (typeof o === "object") || (typeof o === "undefined") || (o===null) )
        {
            return "";
        } else {
            return o;
        }
    }
    if($('div').hasClass('spec_symvols')){
        var spec_y = $('.spec_yeas').text();
        var spec_n = $('.spec_no').text();
        var replaceForm = $('.replaceRequest').text();
		var un_url = $('#requests_filter input[name=un]').val();
    }
    function generateTable(data,type){
        var t="";
        sline=1;
        page=1;
        for(var idx in data){
            var row=data[idx];
            t+="<tr class=\"data-row p"+page.toString()+"\">";
            if(type=="transport"){
                t+="<td>"+sline.toString()+"</td>";
                t+="<td>"+gv(row.pot)+"<br/>"+gv(row.pnaz)+"</td>";
                t+="<td>"+gv(row.firmo)+"<br/>"+gv(row.firmp)+"<br/>"+"<label class='table_payer'>"+gv(row.firpl)+"</label>"+"</td>";
                t+="<td>"+gv(row.q)+"<br/>"+gv(row.v)+"<br/>"+gv(row.p)+"</td>";
                t+="<td>"+gv(row.vagr)+"</td>";
                t+="<td>"+gv(row.data)+"</td>";
                t+="<td>"+gv(row.datr)+"</td>";
                t+="<td>"+gv(row.status)+"</td>";
                t+="<td>"+gv(row.datagive)+"</td>";
                t+="<td nowrap>";
                if((typeof row.vagr !== "object") && (row.vagr !== null))t+="<span onclick=\"openWindow('ttn',{'ttn':'"+row.nreco+"','un':''}); \"class='docc'>ТТН</span><br/>";
                if((typeof row.nschet !== "object") && (row.nschet !== null)!="")t+="<span  onclick=\"openWindow('schet',{'sch':'"+row.nreco+"'});\"class='docc'>Счет</span><br/>";
                if((typeof row.nakt !== "object") && (row.nakt !== null)!="")t+="<span  onclick=\"openWindow('schetf',{'schf':'"+row.nreco+"'});\"class='docc'>Счет-фактура</span>";
                t+="</td>";

            }else if(type=="payments"){
                t+="<td>"+sline.toString()+"</td>";
                t+="<td>"+gv(row.infop)+"</td>";
                t+="<td>"+gv(row.dfopl)+"</td>";
                t+="<td>"+gv(row.soplb)+"</td>";
            }else if(type=="requests"){
				//console.log(row);
                t+="<td data-1c='"+gv(row.link_1C)+"'>"+sline.toString()+"</td>";
                t+="<td>"+gv(row.doc_num)+"</td>";
                t+="<td>"+gv(row.doc_date)+"</td>";
                t+="<td>"+gv(row.doc_status)+"</td>";
                t+="<td>"+gv(row.doc_departure)+" - "+gv(row.doc_destination
                )+"</td>";
                t+="<td>"+gv(row.doc_payer)+"</td>";
                t+="<td>"+gv(row.doc_shipper)+"</td>";
                t+="<td>"+gv(row.doc_consignee)+"</td>";
                if(row.doc_is_expedition != 0){
                    t+="<td>"+spec_y+"</td>";
                }else{
                    t+="<td>"+spec_n+"</td>";
                }
                t+="<td>"+gv(row.doc_time_delivery_client)+"</td>";
				if(gv(row.amount_ZT) == 1 && gv(row.amount_transportation) == 1){
					    t+="<td class='replaceForm'><a href='/cost-calculation/order.php?link_1C="+gv(row.link_1C)+"&un="+un_url+"'>"+replaceForm+"</a></td>";
				}else{
					t+="<td></td>";
				}
               
            }
            t+="</tr>";
            sline++;
            if(page*30<sline)page++;
        }
        return t;
    }




    function reloadResult(formid,url,res_table,type){
        var form = $('#'+formid).serialize();
        console.log(form);

        var num_coll_pagination = 10;
        if(type == 'requests'){
            num_coll_pagination = 11;
        }

        if(curRequest !== undefined){
            curRequest.abort();
        }
        curRequest=$.ajax({
            type: "POST",
            url: url,
            data: form,
            dataType:"json",
            beforeSend: function(){
                res_table.find('tr').not(":first").remove();
                res_table.addClass('loading').append('<tr><td colspan="10"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><br/>загрузка данных...</td></tr>');
            },
            success: function(data){

                var firstProp;
                console.log('------------------------');
                console.log(data);
                console.log('------------------------');
                for(var key in data) {
                    if(data.hasOwnProperty(key)) {
                        firstProp = data[key];
                        break;
                    }
                }
                for(var key in firstProp) {
                    if(firstProp.hasOwnProperty(key)) {
                        if(key!=0){
                            firstProp=[firstProp];
                        }
                        break;
                    }
                }
                res_table.find('tr').not(":first").remove();
                res_table.removeClass('loading').append(generateTable(firstProp,type));
                var rowcount=res_table.find('tr.data-row').length;
                if(rowcount>30){
                    var pagination="<tr class=\"pagination\"><td colspan="+num_coll_pagination+" style=\"text-align:center;\">";
                    var pageCount=Math.ceil(rowcount/30);
                    for(var i=1;i<=pageCount;i++){
                        pagination+="<span>"+i.toString()+"</span>";
                    }
                    pagination+="</td></tr>";
                    res_table.append(pagination);
                    res_table.find('.data-row').css('display','none');
                    res_table.find('.data-row.p1').css('display','table-row');
                    res_table.find('.pagination').find('span').each(function(){
                        $(this).click(function(){
                            res_table.find('.data-row').css('display','none');
                            res_table.find('.data-row.p'+$(this).html()).css('display','table-row');
                            res_table.find('.pagination').find('span').removeClass("active");
                            $(this).addClass("active");
                        });
                    });
                };

            },
            error: function (error) {
                res_table.find('tr').not(":first").remove();
                res_table.append('<tr><td colspan="10">'+$('.no_data').text()+'</td></tr>');
            }
        });
    }
    //console.log(window.location);
    var dragg=false;
    var dragitem=null;
    var startDragY=null;
    var startDragYD=null;
    var startDragTop=null;
    $(document).mouseup(function(){
        dragg=false;
        dragitem=null;
    }).mousemove(function(data){
        if(dragg){
            var delta=data.clientY-startDragY;
            var nt=startDragTop+delta;
            var par=dragitem.parent();
            var txt=par.parent().find('.popup-window-container');
            var parHeight=par.outerHeight();
            var scrollHeight=dragitem.outerHeight();
            var textHeight=txt.outerHeight();
            var popupHeight=txt.parent().height();
            //console.log();
            if(nt<0)nt=0;
            if(nt+scrollHeight>=parHeight)nt=parHeight-scrollHeight;
            var percent=nt/(parHeight-scrollHeight);
            var txtT=(popupHeight-textHeight)*percent;
            //console.log(popupHeight,textHeight,percent,txtT);
            dragitem.css("top",nt);
            txt.css("top",txtT);

        }
    });
    if($('.city-select').length>0){
        function showList(sel,full){
            if(sel === undefined)return;
            if(full === undefined)full=true;
            if(full=='')full=true;
            var list=sel.find('.city_list');
            var inp=sel.find('input');
            list.find('.city_item').each(function(){
                if(full==true){
                    $(this).removeClass('disabled');
                    $(this).html($(this).text());
                } else {
                    var txt=inp.val(); //.toLowerCase();
                    var itm=$(this).text();//.toLowerCase();

                    if(itm.toLowerCase().indexOf(txt.toLowerCase())!==-1){
                        $(this).removeClass('disabled');

                        $(this).html(itm.replace(txt,'<b>'+txt+'</b>'));
                    } else {
                        $(this).addClass('disabled');
                    }
                }
                $(this).unbind('click').bind('click',function(){
                    inp.val($(this).text());
                    inp.attr("selectedID",$(this).attr("id").replace('city',''));
                    doMiniCalcReq();
                    list.fadeOut(100);
                });
                if(!$(this).hasClass('disabled')){
                    $(this).html(fl2Upper($(this).html()));
                }
            });
            list.fadeIn(200);
        }
        $('.city-select').each(function(){
            var btn=$(this).find('.btn_down');
            var list=$(this).find('.city_list');
            var par=$(this);
            var input=$('<input type="text" maxlength="50"/>');
            input.unbind('click').bind('click',function(){
                $(this).trigger('keyup');
            });
            input.unbind('keyup').bind('keyup',function(e){

                var show=list.find('.city_item').not('.disabled');
                var code = e.keyCode || e.which;
                if(code==13){

                    if(show.length>0){
                        $(show[0]).trigger('click');
                    }

                }else if(show.length==1 && input.val().toLowerCase() == $(show[0]).text().toLowerCase() ){

                    $(show[0]).trigger('click');


                }else {
                    showList(par,$(this).val());
                }
            });
            par.append(input);
            list.find('.city_item').each(function(){
                var t=$(this).text();
                var ii=$(this).attr("id").replace("city","");
                if((t=='Новосибирск')&&(par.attr("id")=="city_from")){
                    input.attr("selectedid",ii);
                    input.val($(this).text());
                }
                if((t=='Москва')&&(par.attr("id")=="city_to")){
                    input.attr("selectedid",ii);
                    input.val($(this).text());
                }
            });
            btn.click(function(e){
                if(par.find('.city_list').css('display')=="none"){
                    showList(par,true);
                } else {
                    input.trigger("blur");
                }
                e.preventDefault();
            });
        });
    }
    if($('#mini-calc').length>0){
        $('.btn_reverse').unbind("click").bind("click",function(){
            var t1=$('#city_from input').clone();
            $('#city_from input').val($('#city_to input').val());
            $('#city_from input').attr("selectedid",$('#city_to input').attr("selectedid"));
            $('#city_to input').val(t1.val());
            $('#city_to input').attr("selectedid",t1.attr("selectedid"));
            doMiniCalcReq();
        });
        $('#mini-calc').find('input').blur(function(){

            var list = $(this).parents('.city-select').find('.city_list');
            var show=list.find('.city_item').not('.disabled');
            if(show.length==1){
                $(show[0]).trigger('click');
            }
            list.fadeOut(100);

        })
            .change(function(){
                $(this).trigger('keyup');
            })
            .bind("keyup",function(){
                doMiniCalcReq();
            });
        function doMiniCalcReq(){

            //console.log($('#city_from input').attr("selectedid"));

            if(!parseInt($('#city_from input').attr("selectedid"))>0)return false;
            if(!parseInt($('#city_to input').attr("selectedid"))>0)return false;
            if(!parseInt($('#weight input').val())>0)return false;
            if(!parseFloat($('#vol input').val())>0)return false;
            if(req !== undefined){
                req.abort();
                $('#miniCalcLoader').fadeOut(200);
            }
            req=$.ajax({
                url:"/ajax.php",
                method:"POST",
                data:{
                    "proc":"miniCalc",
                    "from":$('#city_from input').attr("selectedid"),
                    "to":$('#city_to input').attr("selectedid"),
                    "w":$('#weight input').val(),
                    "v":$('#vol input').val()
                },
                dataType:"json",
                async:true,
                beforeSend:function(){
                    $('#miniCalcLoader').fadeIn(100);
                },

                complete:function(a,b){

                    //console.log(a,b);
                },

                success:function(data){

                    //console.log(data);

                    if (typeof data !== 'undefined') {
                        if(data!=null){
                            //console.log(data);
                            var days=data.DeliveryTime;
                            var daysTo = data.DeliveryTimeTo;
                            var s='дней';
                            if(daysTo==1)s='день';
                            if((daysTo>=2)&&(daysTo<=4))s='дня';
                            $('#result_summ').html(data.Cost);
                            $('#result_days').find('p').html(days+'-'+daysTo+' '+s );



                        } else {
                            $('#result_summ').html('---');
                            $('#result_days').find('p').html('---');
                        }
                        $('#miniCalcLoader').fadeOut(200);
                    }
                }
            });
        }
        doMiniCalcReq();



    }

    cityListReload();
    if($('.btn-city-select_List').length>0){

        $('.btn-city-select_List').click(function(){
            doMiniCalcReqList();



        });
    }




    if($('#mini-calc_List').length>0){ // выпадающий список городов

        console.log('это mini-calc_List');

        $('.btn_reverse_List').unbind("click").bind("click",function(){
            var t1=$('#city_from_List input').clone();
            $('#city_from_List input, #city_from_List_cc input').val($('#city_to_List input').val());
            $('#city_from_List input, #city_from_List_cc input').attr("selectedid",$('#city_to_List input').attr("selectedid"));
            $('#city_to_List input').val(t1.val());
            $('#city_to_List input').attr("selectedid",t1.attr("selectedid"));
            doMiniCalcReqList();

        });
        $('#mini-calc_List').find('input').blur(function(){

            // console.log('это blur');
            var list = $(this).parents('.city-select_List').find('.city_list_List');
            var show=list.find('.city_item_List').not('.disabled');
            if(show.length==1){
                $(show[0]).trigger('click');
            }
            list.fadeOut(100);
        })
            .change(function(){
                $(this).trigger('keyup');
            })
            .bind("keyup",function(){
                //doMiniCalcReqList();
            });

        doMiniCalcReqList();
    }






    $(".numbers").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
            // Allow: Ctrl+A, Command+A
            ((e.keyCode == 65 || e.keyCode == 86 || e.keyCode == 67 || e.keyCode == 88) && (e.ctrlKey || e.metaKey )) ||
            // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
            // let it happen, don't do anything


            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });










    if($('#faq').length>0){
        $('#faq .questions .q-item').click(function(){
            $('#faq .questions .q-item').removeClass('active');
            $(this).addClass("active");
            $('#faq .answers .answer-item').removeClass('active');
            $('#faq .answers #i'+$(this).attr("id").replace("h","")).addClass("active");
        });
    }
    if($('.slider').length>0){
        $('.slider').each(function(){
            var slider=$(this);
            //var itemWidth=parseInt(slider.find('.slide').css('width').replace('px',''))+parseInt(slider.find('.slide').css('margin-right').replace('px',''))+parseInt(slider.find('.slide').css('padding').replace('px','')*2);
            var itemWidth=487;
            //console.log(itemWidth);
            var container=$(this).find('.container');
            var slideCount=slider.find('.slide').length;
            var slidesShow=parseInt(slider.attr("spp"));
            var btnL=$(this).find('.ar-left');
            var btnR=$(this).find('.ar-right');
            var currentSlide=0;
            $(this).find('.slide-btn').click(function(){
                if($(this).hasClass('ar-right'))currentSlide++;
                if($(this).hasClass('ar-left'))currentSlide--;
                if(currentSlide<0)currentSlide=slideCount-slidesShow;
                if(currentSlide>slideCount-slidesShow)currentSlide=0;
                container.css('left',-currentSlide*itemWidth);
            });
        });
    };
    if($('#status-form').length>0){
        var form=$('#status-form');
        var txt=form.find('input');
        var btn = form.find('.btn-search');
        btn.click(function(){
            //ПРЕДВАРИТЕЛЬНАЯ ПРОВЕРКА ЗНАЧЕНИЯ
            //ПРЕДВАРИТЕЛЬНАЯ ПРОВЕРКА ЗНАЧЕНИЯ
            //ПРЕДВАРИТЕЛЬНАЯ ПРОВЕРКА ЗНАЧЕНИЯ
            //ПРЕДВАРИТЕЛЬНАЯ ПРОВЕРКА ЗНАЧЕНИЯ
            //ПРЕДВАРИТЕЛЬНАЯ ПРОВЕРКА ЗНАЧЕНИЯ


            document.location.href="/status/"+"?n="+txt.val();
        });
        txt.keyup(function(data){
            if(data.keyCode==13)btn.trigger('click');
        });
    }
    //Всплывающие окна
    $('[data-popup]').each(function(){
        var item=$(this);
        var bdy=$("<div></div>");
        var div=$("<div></div>");
        var container=$("<div></div>");
        var btnClose=$("<div>x</div>");
        div.addClass("popup-window-box");
        bdy.addClass("popup-window-box-body");
        btnClose.addClass("popup-window-close");
        if(item.hasClass("noscroll"))div.addClass("noscroll");
        container.addClass("popup-window-container");
        var data="";
        $.get("/popups/"+item.attr("data-popup"),function(result){
            container.html(result);
            bdy.append(div);
            div.append(container);
            $('body').append(bdy);
            bdy.css("top",item.offset().top+item.outerHeight()+10);
            bdy.css("left",item.offset().left+item.width()/2-bdy.width()/2);
            var y1=div.outerHeight();
            var y2=container.outerHeight();
            if((y1>=270)&&(y2>y1)){
                //рисуем скролл
                var scroll_cnt=$("<div></div>");
                var scroll=$("<div></div>");
                scroll_cnt.addClass('scroll-cnt');
                scroll.addClass('scroll');
                scroll_cnt.append(scroll);
                div.prepend(scroll_cnt);
                var y3=scroll_cnt.outerHeight();
                var scrollHeight=Math.round(y3*y1/y2);
                scroll.css("height",scrollHeight);
                scroll.mousedown(function(data){
                    data.preventDefault();
                    if(data.button==0){
                        dragg=true;
                        startDragY=data.clientY;
                        startDragYD=scroll.offset().top;
                        dragitem=scroll;
                        startDragTop=parseInt(dragitem.css('top'));
                    }
                });
            }
            bdy.css("opacity",1);
            bdy.css("display","none");
            bdy.append(btnClose);
            btnClose.click(function(){
                bdy.removeClass("showed");
                bdy.fadeOut(300);
            });
            $(item).click(function(){
                bdy.toggleClass("showed");
                if(!bdy.hasClass("showed")){
                    bdy.fadeOut(300);
                } else {
                    $('.popup-window-box-body').removeClass('showed');
                    $('.popup-window-box-body').fadeOut(300);
                    bdy.addClass('showed');
                    bdy.fadeIn(300);
                }
            });
            container.find('input[type=submit]').click(function(e){
                e.preventDefault();
                var tt=item.text();
                if(tt.length<=0){
                    tt="Сообщение сайта";
                }
                $(this).closest('form').find("input[type=text], textarea").val("");
                showMessage(tt,"Ваша заявка отправлена, ожидайте ответа!");
                btnClose.trigger('click');
            });
            reloadTextFilters();
        });
    });
    function reloadTextFilters(){
        $(".digits").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                // Allow: Ctrl+A, Command+A
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {


                e.preventDefault();
            }
        });
    }
    reloadTextFilters();
    if($('#max_calc').length>0){
        updateDataShow();
        updateAddNewPlaceButtons();
        function updateAddNewPlaceButtons(){
            $('.add-new-place').click(function(){
                newid=$('.place').length;
                temp=$(this).parents('.place').clone();
                temp.attr("id","place_"+newid);
                temp.find('.place_num').html((newid+1)+' место');
                temp.find('[id]').each(function(){
                    var str=$(this).attr("id");
                    if(str.indexOf("_")>0){
                        $(this).attr("id",str.substring(0,str.indexOf("_")+1)+newid);
                    }
                });
                temp.find('[name]').each(function(){
                    var str=$(this).attr("name");
                    if(str.indexOf("_")>0){
                        $(this).attr("name",str.substring(0,str.indexOf("_")+1)+newid);
                    }
                });
                temp.find('[for]').each(function(){
                    var str=$(this).attr("for");
                    if(str.indexOf("_")>0){
                        $(this).attr("for",str.substring(0,str.indexOf("_")+1)+newid);
                    }
                });
                temp.find('input[type!=button]').val('');
                temp.find('input[type=checkbox]').prop("checked",false);
                temp.find('textarea').text('');
                temp.find('.data-show-content').css('display','none');
                temp.insertAfter($(this).parents('.place'));
                $(this).attr("disabled",true);
                //updateAddNewPlaceButtons();
                updateDataShow();
                console.log();
            });
        }

    }
    if($('.lc.transport').length>0){
        $("input[name=date_from],input[name=date_to]").datepicker({
            dateFormat: "dd.mm.yy",
            changeMonth: true
        }).datepicker($.datepicker.regional["ru"]);
        var now=new Date();
        $("input[name=date_to]").datepicker("setDate", "+0d");
        $("input[name=date_from]").datepicker("setDate", new Date(now.getFullYear(),now.getMonth(),1));
        $('input[type=radio][name=type]').bind("change",function(){
            if(this.value=='current'){
                $('div.flt_archieve').css('display','none');
                reloadResult("transport_filter","./transportations.request.php",$('.lc.transport .result'),"transport");
            } else {
                $('div.flt_archieve').css('display','block');
            }
        });
        $('#transport_filter').find('input[type=button]').click(function(){
            reloadResult("transport_filter","./transportations.request.php",$('.lc.transport .result'),"transport");
        });
        $('#type_current').prop('checked',true).trigger("change");
    };
    if($('.lc.requests').length>0){

        var getPerioStartRequest = function(){

            var un = $('#requests_filter input[name=un]').val();
            var ss_code = $('#requests_filter input[name=ss_code]').val();
            var data_1 = '01.01.2002';
            var dateNow = new Date();
            var month = dateNow.getMonth()+1;
            /*if(month.length == 1){
                month = '0'+month;
            }*/
            var date = dateNow.getDate();
            if(String(date).length == 1){
                date = '0'+date;
            }
            
            var data_2 = date+'.0'+month+'.'+dateNow.getFullYear();
			console.log('un='+un+'&ss_code='+ss_code+'&data_1='+data_1+'&data_2='+data_2);
			
            $.ajax({
                type: "POST",
                url: './requests.request.php',
                data: 'un='+un+'&ss_code='+ss_code+'&data_1='+data_1+'&data_2='+data_2,
                dataType:"json",
                beforeSend: function(){
                    res_table = $('.lc.requests .result');
                    res_table.find('tr').not(":first").remove();
                    res_table.addClass('loading').append('<tr><td colspan="10"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><br/>загрузка данных...</td></tr>');
                },
                success: function(data){

                    var first_element_date = '';
                    var last_element_date = '';
                    var all_elements = data.requests.length;
                    for(var i=0; i < data.requests.length; i++) {

                        if(i==0){
                            first_element_date = data.requests[i].doc_date;
                        }
                        var plusI = i+1;
                        if(all_elements == plusI){
                            last_element_date = data.requests[i].doc_date;
                        }
                    }

                    var arr_data_first = first_element_date.split('.');
					
                    if(String(arr_data_first[0]).length == 1){
                        arr_data_first[0] = '0'+arr_data_first[0];
                    }
					console.log(arr_data_first);
                    if(String(arr_data_first[1]).length == 1){
                        arr_data_first[1] = '0'+arr_data_first[1];
                    }
                    var data_first = arr_data_first[0]+'.'+arr_data_first[1]+'.'+arr_data_first[2];

                    

                    var arr_data_last = last_element_date.split('.');
					
                    if(String(arr_data_last[0]).length == 1){
                        arr_data_last[0] = '0'+arr_data_last[0];
                    }
                    if(String(arr_data_last[1]).length == 1){
                        arr_data_last[1] = '0'+arr_data_last[1];
                    }
                    var data_last = arr_data_last[0]+'.'+arr_data_last[1]+'.'+arr_data_last[2];
					
					$("input[name=data_2]").datepicker("setDate", data_last);

                    $("input[name=data_1]").datepicker("setDate", data_first);

                    reloadResult("requests_filter","./requests.request.php",$('.lc.requests .result'),"requests");

                },
                error: function(error){
                    console.log(error);
                }
            });
        }

        $("input[name=data_2],input[name=data_1]").datepicker({
            dateFormat: "dd.mm.yy",
            changeMonth: true
        }).datepicker($.datepicker.regional["ru"]);

        getPerioStartRequest();

        $('#requests_filter').find('input[type=button]').click(function(){
            reloadResult("requests_filter","./requests.request.php",$('.lc.requests .result'),"requests");
        });
    };
	function findGetParameter(parameterName) {
		var result = null,
        tmp = [];
		location.search
			.substr(1)
			.split("&")
			.forEach(function (item) {
			  tmp = item.split("=");
			  if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
			});
		return result;
	}
	var url = location.href.split('/');
	
	
	
	if($('#form-calk-order').length>0 && url[3] == 'cost-calculation'){
		
		var formatPhone1 = function(data){
			var arrphone = data.split('');
			var strphone = '';
			if(arrphone.length <= 9){
				return data;
			}else{
				for(var qq=0; qq<arrphone.length; qq++){

					if(qq == 0){
						arrphone[qq] = arrphone[qq]+'(';
					}
					if(qq == 3){
						arrphone[qq] = arrphone[qq]+')';
					}
					if(qq == 6){
						arrphone[qq] = arrphone[qq]+'-';
					}
					if(qq == 8){
						arrphone[qq] = arrphone[qq]+'-';
					}
					strphone += String(arrphone[qq]);
				}
				return '+'+strphone;
			}
		}
		
		var link_C1 = findGetParameter('link_1C');
		
		if(link_C1 != null){
			
			$('#form-calk-order').css('opacity', '0.2');
			$('.loadingProcess').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><br/>загрузка данных...');
			$('.loadingProcess').css('display', 'block');
			
			var un = findGetParameter('un');
			
			$.ajax({
				url :'/cost-calculation/get-request.php',
				type: "POST",
				data: 'un='+un+'&code_1c='+link_C1,
				dataType: 'json',
				success:function(data){
					console.log('-------------------------');
					console.log(data);
					
					var stopRunCalrAuto = false;
					for(var i=0; i<data.shipings.length; i++){
						
						/*for(var j=0; j<data.shipings[i].cargos.length; j++){}*/
						if(data.shipings[i].cargos.length > 1){
							stopRunCalrAuto = true;
						}
					}
					
					if(stopRunCalrAuto){
						$('#form-calk-order').css('pointerEvents', 'none');
						$('#form-calk-order').css('opacity', '0');
						$('.loadingProcess').html('Данная заявка не соотвествует требования шаблона!');
						return false;
					}
					
					$('#customer-Contact_Id').val(data.countragent.contacts[0].fio);
					$('#customer_Email_Id').val(data.countragent.contacts[0].email);
					
					var phoneMain = data.countragent.contacts[0].phone_1;
					phoneMain = phoneMain.replace(/\s/g, '');
					
					phoneMain = formatPhone1(phoneMain);
					$('#customer-Phone_Id').inputmask('remove');
					document.getElementById('customer-Phone_Id').value = phoneMain;
					
					
					//departure
					
					var fullIdCity = '';
					var idCity = 0;
					
					$('#mini-calc_List .d2l #city_from_List .city_list_List div').each(function(){
						if($(this).text() == data.shipings[0].departure){
							fullIdCity = $(this).attr('id');
							var arrCity = $(this).attr('id').split('city');
							idCity = arrCity[1];
						}
					});
					
					$('body #mini-calc_List .d2l #city_from_List input').val($('#form-calk-order #mini-calc_List .d2l #city_from_List .city_list_List .city_item_List[id='+fullIdCity+']').text());
					
					$('body #mini-calc_List .d2l #city_from_List input').attr('selectedid', idCity);
					
					
					//destination
					
					var fullIdCity2 = '';
					var idCity2 = 0;
					
					$('#mini-calc_List .d2r #city_to_List .city_list_List div').each(function(){
						
						if($(this).text() == data.shipings[0].destination){
							
							fullIdCity2 = $(this).attr('id');
							var arrCity = $(this).attr('id').split('city');
							idCity2 = arrCity[1];
						}
					});
					
					$('body #mini-calc_List .d2r #city_to_List input').val($('#form-calk-order #mini-calc_List .d2r #city_to_List .city_list_List .city_item_List[id='+fullIdCity2+']').text());
					
					$('body #mini-calc_List .d2r #city_to_List input').attr('selectedid', idCity2);
					
					// params
					
					var teploChecked = false;
					var xrupkyiChecked = false;
					var negabaritChecked = false;
					
					var places = 0;
					var weight = 0;
					var amount = 0;
					
					var services_added = false;
					var arrServices = [];
					
					
					
					for(var i=0; i<data.shipings.length; i++){
						
						if(data.shipings[i].expedition.length > 0){
							//Экспедирование в пункте отправления
							if(data.shipings[i].expedition[0].type_expedition == 1){
								$('#BOXDeliveryOut_Id').prop('checked', true);
								
								$('#AddressBOXDeliveryOut_Id').val(data.shipings[i].expedition[0].address);
								
								$('#ContactBOXDeliveryOut_Id').val(data.shipings[i].expedition[0].contacts[0].fio);
								var phone_1 = data.shipings[i].expedition[0].contacts[0].phone_1;
								phone_1 = phone_1.replace(/\s/g, '');
								phone_1 = formatPhone1(phone_1);
								$('#PhoneBOXDeliveryOut_Id').inputmask('remove');
								document.getElementById('PhoneBOXDeliveryOut_Id').value = phone_1;
								$('#PhoneBOXDeliveryOut_Id').inputmask("getemptymask");
								
								//$('#PhoneBOXDeliveryOut_Id').val('89(501)362-1596');
								//$('#PhoneBOXDeliveryOut_Id').inputmask('setvalue', '');
								//$('#PhoneBOXDeliveryOut_Id').inputmask('setvalue', '89501362159');
								
									
								var datExpedition = data.shipings[i].expedition[0].data_expedition.split('.');
								if(String(datExpedition[0]).length == 1){
									datExpedition[0] = '0'+datExpedition[0];
								}
								datExpedition = datExpedition[0]+'-'+datExpedition[1]+'-'+datExpedition[2]
								$('#DateBOXDeliveryOut_Id').val(datExpedition);

								var timeExpedition = data.shipings[i].expedition[0].time_expedition.split(' ');
								$('#Hour1BOXDeliveryOut_Id').val(timeExpedition[1]);
								if(timeExpedition[3].indexOf('.') + 1) {
									var arrChile = timeExpedition[3].split('.');
									timeExpedition[3] = arrChile[0];
								}
								$('#Hour2BOXDeliveryOut_Id').val(timeExpedition[3]);
							}
							   
							//Экспедирование в пункте назначения
							if(data.shipings[i].expedition[1].type_expedition == 2){
								$('#BOXDeliveryIn_Id').prop('checked', true);
								
								$('#AddressBOXDeliveryIn_Id').val(data.shipings[i].expedition[1].address);
								
								$('#ContactBOXDeliveryIn_Id').val(data.shipings[i].expedition[1].contacts[0].fio);
								var phone_1 = data.shipings[i].expedition[0].contacts[0].phone_1;
								phone_1 = phone_1.replace(/\s/g, '');
								
								phone_1 = formatPhone1(phone_1);
								$('#PhoneBOXDeliveryIn_Id').inputmask('remove');
								document.getElementById('PhoneBOXDeliveryIn_Id').value = phone_1;
								
								var datExpedition = data.shipings[i].expedition[1].data_expedition.split('.');
								if(String(datExpedition[0]).length == 1){
									datExpedition[0] = '0'+datExpedition[0];
								}
								datExpedition = datExpedition[0]+'-'+datExpedition[1]+'-'+datExpedition[2]
								$('#DateBOXDeliveryIn_Id').val(datExpedition);
								
								var timeExpedition = data.shipings[i].expedition[1].time_expedition.split(' ');
								$('#Hour1BOXDeliveryIn_Id').val(timeExpedition[1]);
								if(timeExpedition[3].indexOf('.') + 1) {
									var arrChile = timeExpedition[3].split('.');
									timeExpedition[3] = arrChile[0];
								}
								$('#Hour2BOXDeliveryIn_Id').val(timeExpedition[3]);
								
							}
							
						}
						
						var dataClient     = data.shipings[i].doc_date_delivery_client.split('.');
						if(String(dataClient[0]).length == 1){
							 dataClient[0] = '0'+dataClient[0];
						}
						dataClient = dataClient[0]+'-'+dataClient[1]+'-'+dataClient[2];
						$('#DateDeliveryCust_Id').val(dataClient);
						
						var dateTimeClient      = data.shipings[i].doc_time_delivery_client;
						var arrDateTimeClient   = dateTimeClient.split(' ');
						var dateTimeClientFirst = arrDateTimeClient[1];
						var dateTimeClientTwo   = arrDateTimeClient[3];
						$('#Hour1DeliveryCust_Id').val(dateTimeClientFirst);
						$('#Hour2DeliveryCust_Id').val(dateTimeClientTwo);
						
						var cargosName = data.shipings[i].cargos[0].character;
						var cargosID   = 0;
						
						$('#city_from_List_cc .city_list_List .city_item_List').each(function(){
							if($(this).text() == cargosName){
								cargosID = $(this).attr('id');
							}
						});

						$('#city_from_List_cc input[name=input_Charakter_Cargo]').val(cargosName);
						$('#city_from_List_cc input[name=input_Charakter_Cargo]').attr('selectedid', cargosID);
						
						//Отправитель
						
						if(data.shipings[i].countragents[1].type == 1){
							
							//ur
							
							$('#sender-ur-Name_Id').val(data.shipings[i].countragents[1].short_Name);
							var type_str   = data.shipings[i].countragents[1].type_str;
							if(type_str == 'Юридическое лицо'){
								$('#sender-ur-OrgPravForm_Id').val('OOO');
							}
							$('#sender-ur-INN_Id').val(data.shipings[i].countragents[1].inn);
							$('#sender-ur-KPP_Id').val(data.shipings[i].countragents[1].kpp);
							$('#sender-ur-Contact_Id').val(data.shipings[i].countragents[1].contacts[0].fio);
							
							var phone_1 = data.shipings[i].countragents[1].contacts[0].phone_1;
							phone_1 = phone_1.replace(/\s/g, '');
							
							phone_1 = formatPhone1(phone_1);
							$('#sender-ur-Phone_Id').inputmask('remove');
							document.getElementById('sender-ur-Phone_Id').value = phone_1;
							
						}else{
							
							//fis
							$('#tab1-send .left-menu-order #typeClientSend_fis_id').attr('checked', 'checked');
							$('#tab1-send .data-show-send-content-fis').css('display', 'block');
							$('#tab1-send .data-show-send-content-ur').css('display', 'none');
							
							$('#sender-fis-Contact_Id').val(data.shipings[i].countragents[1].fio);
							
							var phone_1 = data.shipings[i].countragents[1].contacts[0].phone_1;
							phone_1 = phone_1.replace(/\s/g, '');
							
							phone_1 = formatPhone1(phone_1);
							$('#sender-fis-Phone_Id').inputmask('remove');
							document.getElementById('sender-fis-Phone_Id').value = phone_1;
							
							$('#sender-fis-SDoc_Id').val(data.shipings[i].countragents[1].series_doc);
							$('#sender-fis-NDoc_Id').val(data.shipings[i].countragents[1].number_doc);
						}
						
						//Получатель
						
						if(data.shipings[i].countragents[2].type == 1){
						
							$('#resiv-ur-Name_Id').val(data.shipings[i].countragents[2].short_Name);
							var type_str   = data.shipings[i].countragents[2].type_str;
							if(type_str == 'Юридическое лицо'){
								$('#resiv-ur-OrgPravForm_Id').val('OOO');
							}
							$('#resiv-ur-INN_Id').val(data.shipings[i].countragents[2].inn);
							$('#resiv-ur-KPP_Id').val(data.shipings[i].countragents[2].kpp);
							$('#resiv-ur-Contact_Id').val(data.shipings[i].countragents[2].contacts[0].fio);

							var phone_1 = data.shipings[i].countragents[2].contacts[0].phone_1;
							phone_1 = phone_1.replace(/\s/g, '');
							
							phone_1 = formatPhone1(phone_1);
							$('#resiv-ur-Phone_Id').inputmask('remove');
							document.getElementById('resiv-ur-Phone_Id').value = phone_1;

							if(data.shipings[i].countragents[1].short_Name == data.shipings[i].countragents[2].short_Name){
								$('#resiv_ur_IsSenderIsPayer option:first').prop('selected', true);
							}
							
						}else{
							
							$('#tab2-resiv.left-menu-order #typeClientResiv_fis_id').attr('checked', 'checked');
							$('#tab2-resiv .data-show-resiv-content-fis').css('display', 'block');
							$('#tab2-resiv .data-show-resiv-content-ur').css('display', 'none');
							
							$('#resiv-fis-Contact_Id').val(data.shipings[i].countragents[2].fio);
							
							var phone_1 = data.shipings[i].countragents[2].contacts[0].phone_1;
							phone_1 = phone_1.replace(/\s/g, '');
							
							phone_1 = formatPhone1(phone_1);
							$('#resiv-fis-Phone_Id').inputmask('remove');
							document.getElementById('resiv-fis-Phone_Id').value = phone_1;
							
							$('#resiv-fis-SDoc_Id').val(data.shipings[i].countragents[2].series_doc);
							$('#resiv-fis-NDoc_Id').val(data.shipings[i].countragents[2].number_doc);
							
						}
						
						//Плательщик
						if(data.shipings[i].countragents[0].type == 1){
						
							$('#pay-ur-Name_Id').val(data.shipings[i].countragents[0].short_Name);
							var type_str   = data.shipings[i].countragents[0].type_str;
							if(type_str == 'Юридическое лицо'){
								$('#pay-ur-OrgPravForm_Id').val('OOO');
							}

							$('#pay-ur-INN_Id').val(data.shipings[i].countragents[0].inn);
							$('#pay-ur-KPP_Id').val(data.shipings[i].countragents[0].kpp);
							$('#pay-ur-Contact_Id').val(data.shipings[i].countragents[0].contacts[0].fio);
							var phone_1 = data.shipings[i].countragents[0].contacts[0].phone_1;
							phone_1 = phone_1.replace(/\s/g, '');
							
							phone_1 = formatPhone1(phone_1);
							$('#pay-ur-Phone_Id').inputmask('remove');
							document.getElementById('pay-ur-Phone_Id').value = phone_1;

							if(data.shipings[i].countragents[1].short_Name == data.shipings[i].countragents[0].short_Name){
								$('#pay_ur_IsSenderIsResiver option:first').prop('selected', true);
							}
							
						}else{
							
							$('#tab3-pay .left-menu-order #typeClientPay_fis_id').attr('checked', 'checked');
							$('#tab3-pay .data-show-pay-content-fis').css('display', 'block');
							$('#tab3-pay .data-show-pay-content-ur').css('display', 'none');
							
							$('#pay-fis-Contact_Id').val(data.shipings[i].countragents[0].fio);
							
							var phone_1 = data.shipings[i].countragents[0].contacts[0].phone_1;
							phone_1 = phone_1.replace(/\s/g, '');
							
							phone_1 = formatPhone1(phone_1);
							$('#pay-fis-Phone_Id').inputmask('remove');
							document.getElementById('pay-fis-Phone_Id').value = phone_1;
							
							$('#pay-fis-SDoc_Id').val(data.shipings[i].countragents[0].series_doc);
							$('#pay-fis-NDoc_Id').val(data.shipings[i].countragents[0].number_doc);
							
						}
						
						
						for(var j=0; j<data.shipings[i].cargos.length; j++){
							
							places += Number(data.shipings[i].cargos[j].places);
							weight += Number(data.shipings[i].cargos[j].weight);
							amount += Number(data.shipings[i].cargos[j].amount);
							
							var teplo     = data.shipings[i].cargos[j].mark_ups[0].pwa;
							var xrupkyi   = data.shipings[i].cargos[j].mark_ups[1].pwa;
							var negabarit = data.shipings[i].cargos[j].mark_ups[2].pwa;
							var mest      = data.shipings[i].cargos[j].mark_ups[3].pwa;
							
							if(teplo.places != ''){
								teploChecked = true;
							}
							if(xrupkyi.places != ''){
								xrupkyiChecked = true;
							}
							if(negabarit.places != ''){
								negabaritChecked = true;
							}
							
							places += Number(teplo.places);
							places += Number(xrupkyi.places);
							places += Number(negabarit.places);
							
							weight += Number(teplo.weight);
							weight += Number(xrupkyi.weight);
							weight += Number(negabarit.weight);
							
							amount += Number(teplo.amount);
							amount += Number(xrupkyi.amount);
							amount += Number(negabarit.amount);
							 
						}
						
						//Услуги в пункте отправления
						console.log('-------------------');
						console.log(data.shipings[i].services[0]);
						if(data.shipings[i].services[0] != undefined){
							
							var services = data.shipings[i].services[0].service_in;

							var lenSFirst = services.length;
							for(var q=0; q<lenSFirst; q++){

								if(services[q].unit == 'шт'){
									places += Number(services[q].quantity);
									services_added = true;
								}else{
									amount += Number(services[q].quantity);
									services_added = true;
								}

								arrServices.push(services[q]);
							}
						}
						/*for(var j=0; j<data.shipings[i].services.length; j++){
							
							var lenS = Number(data.shipings[i].services[j].service_in.length);
							//console.log(data.shipings[i].services[j].service_in.length+' - LLL');
							
							for(var q=0; q<lenS; q++){
								
								if(data.shipings[i].services[j].service_in[q].unit == 'шт'){
									places += Number(data.shipings[i].services[j].service_in[q].quantity);
									services_added = true;
								}else{
									amount += Number(data.shipings[i].services[j].service_in[q].quantity);
									services_added = true;
								}
								
								arrServices.push(data.shipings[i].services[j].service_in[q]);
							}
						}*/
					}
					
					$('#div_params_gruz input[id=place]').val(Math.ceil(places));
					$('#div_params_gruz input[id=weight]').val(Math.ceil(weight));
					$('#div_params_gruz input[id=volume]').val(Math.ceil(amount));
					
					doMiniCalcReqList();
					
					var proverka_result_price = setInterval(function(){
						if($('#max_calc_result #result #content_cal tr').length > 0){
							
							if(teploChecked){
								$('.preiskurant1 #MarkUp1').prop('checked', true);
								$('.preiskurant1 #MarkUp1').trigger('change');
							}
							if(xrupkyiChecked){
								$('.preiskurant1 #MarkUp4').prop('checked', true);
								$('.preiskurant1 #MarkUp4').trigger('change');
							}
							if(negabaritChecked){
								$('.preiskurant1 #MarkUp2').prop('checked', true);
								$('.preiskurant1 #MarkUp2').trigger('change');
							}
							
							if(services_added){
								$('#chBoxAddServiseDelivOut_Id').prop('checked', true);
								$('#div_input_ServiseDeliv_Out__d2l .data-show-content').css('display', 'block');
							}
							
							var unit = $('.spec_symvols .unit').text();
							
							console.log('54rtrey7y543fdfe');
							//console.log(arrServices);
							for(var i=0; i<arrServices.length; i++){
								
								if($('#div_input_ServiseDeliv_Out__d2l .data-show-content input[data-id='+arrServices[i].service_ID+']')){
									$('#div_input_ServiseDeliv_Out__d2l .data-show-content input[data-id='+arrServices[i].service_ID+']').prop('checked', true);
									if(arrServices[i].unit == 'шт'){
										$('#div_input_ServiseDeliv_Out__d2l .data-show-content input[data-id='+arrServices[i].service_ID+']').next().next().next().find('input').val(arrServices[i].quantity);
										//console.log(arrServices[i].service_ID);
									}
								}
							}
							
							clearInterval(proverka_result_price);
							$('#form-calk-order').trigger('submit');
						}
						
					}, 100);
					
					
					/*if(data.shipings[0].countragents[0].type == 1){
						$('#tab1-send .left-menu-order #typeClientSend_ur_id').attr('checked', 'checked');
						$('.tabcontent .data-show-send-content-fis').css('display', 'none');
						$('.tabcontent .data-show-send-content-ur').css('display', 'block');
						//$('#sender_ur_Zapolnit_lc_Id').attr('checked', 'checked');
					}else{
						
						$('#tab1-send .left-menu-order #typeClientSend_fis_id').attr('checked', 'checked');
						$('.tabcontent .data-show-send-content-fis').css('display', 'block');
						$('.tabcontent .data-show-send-content-ur').css('display', 'none');
						//$('#sender_fis_Zapolnit_lc_Id').attr('checked', 'checked');
					}*/
					
					$('.loadingProcess').html('');
					$('.loadingProcess').css('display', 'none');
					$('#form-calk-order').css('opacity', '1');
					
					//doMiniCalcReqList();
					SubmitFormValidator(true);
				}
			});
			
		}
	}
    if($('.lc.payments').length>0){
        $("input[name=date_from],input[name=date_to]").datepicker({
            dateFormat: "dd.mm.yy",
            changeMonth: true
        }).datepicker($.datepicker.regional["ru"]);
        var now=new Date();
        $("input[name=date_to]").datepicker("setDate", "+0d");
        $("input[name=date_from]").datepicker("setDate", new Date(now.getFullYear(),now.getMonth(),1));
        $('#payments_filter').find('input[type=button]').click(function(){
            reloadResult("payments_filter","./payments.request.php",$('.lc.payments .result'),"payments");
        });
        $('#payments_filter').find('input[type=button]').trigger('click');
    }
});

function printDiv(){
    var contents = document.getElementById("printableArea").innerHTML;
    var frame1 = document.createElement('iframe');
    frame1.name = "frame1";
    frame1.style.position = "absolute";
    frame1.style.top = "-1000000px";
    document.body.appendChild(frame1);
    var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
    frameDoc.document.open();
    frameDoc.document.write('<ht ml><head><title>Прейскурант</title><style> table{ border:1px solid black; border-collapse: collapse;} </style>');
    frameDoc.document.write('</head><body>');
    frameDoc.document.write(contents);
    frameDoc.document.write('</body></html>');
    frameDoc.document.close();
    setTimeout(function () {
        window.frames["frame1"].focus();
        window.frames["frame1"].print();
        document.body.removeChild(frame1);
    }, 500);
    return false;
}


function AddParamsUrlCalkToOrder(element){

    var from_id = $('#city_from').find('input').val();
    var to_id =	$('#city_to').find('input').val();

    var weight = $('#weight').find('input').val();
    var volume = $('#vol').find('input').val();

    $(element).attr("href", '/cost-calculation/order.php' + '?from=' + from_id + '&to=' + to_id  + '&weight=' + weight + '&volume=' + volume);

}


function AddParamsUrlCalkToMaxCalk(element){

    var from_id = $('#city_from').find('input').val();
    var to_id =	$('#city_to').find('input').val();

    var weight = $('#weight').find('input').val();
    var volume = $('#vol').find('input').val();

    $(element).attr("href", '../cost-calculation/cost-calculation.php' + '?from=' + from_id + '&to=' + to_id  + '&weight=' + weight + '&volume=' + volume);

}

function getPhoneNumberCityFromSession(handleData, PhoneCity) {

    var selected = [];
    selected.push({ PhoneCity: PhoneCity});

    $.ajax({
        url:'../maps/GetPhoneNumberByCityName.php',
        type: "POST",
        dataType: 'text',
        data:{selected: selected},

        success:function(data){
            handleData(data);
        }
    });
}








