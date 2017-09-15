/**
searchcustomersort editable input.
Internally value stored as {searchcustomersorter_sort: "按姓名排序", searchcustomersorter_ascordesc: "升序"}

@class searchcustomersort
@extends abstractinput
@final
@example
<a href="#" id="searchcustomersort" data-type="searchcustomersort" data-pk="1">awesome</a>
<script>
$(function(){
    $('#searchcustomersort').editable({
        url: '/post',
        title: 'Enter city, street and building #',
        value: {
            city: "Moscow", 
            street: "Lenina", 
            building: "15"
        }
    });
});
</script>
**/
(function ($) {
    "use strict";
    
    var searchcustomersort = function (options) {
        this.init('searchcustomersort', options, searchcustomersort.defaults);
    };

    //inherit from Abstract input
    $.fn.editableutils.inherit(searchcustomersort, $.fn.editabletypes.abstractinput);

    $.extend(searchcustomersort.prototype, {
        /**
        Renders input from tpl

        @method render() 
        **/        
        render: function() {
           this.$input = this.$tpl.find('input');
        },
        
        /**
        Default method to show value in element. Can be overwritten by display option.
        
        @method value2html(value, element) 
        **/
        value2html: function(value, element) {
            if(!value) {
                $(element).empty();
                return; 
            }
            var html = '<b>' +   $('<div>').text(value.searchcustomersorter_sort).html() + ', ' + $('<div>').text(value.searchcustomersorter_ascordesc).html() + '</b>' ;  
            $(element).html(html); 
        },
        
        /**
        Gets value from element's html
        
        @method html2value(html) 
        **/        
        html2value: function(html) {        
          /*
            you may write parsing method to get value by element's html
            e.g. "Moscow, st. Lenina, bld. 15" => {city: "Moscow", street: "Lenina", building: "15"}
            but for complex structures it's not recommended.
            Better set value directly via javascript, e.g. 
            editable({
                value: {
                    city: "Moscow", 
                    street: "Lenina", 
                    building: "15"
                }
            });
          */ 
          return null;  
        },
      
       /**
        Converts value to string. 
        It is used in internal comparing (not for sending to server).
        
        @method value2str(value)  
       **/
       value2str: function(value) {
           var str = '';
           if(value) {
               for(var k in value) {
                   str = str + k + ':' + value[k] + ';';  
               }
           }
           return str;
       }, 
       
       /*
        Converts string to value. Used for reading value from 'data-value' attribute.
        
        @method str2value(str)  
       */
       str2value: function(str) {
           /*
           this is mainly for parsing value defined in data-value attribute. 
           If you will always set value by javascript, no need to overwrite it
           */
           return str;
       },                
       
       /**
        Sets value of input.
        
        @method value2input(value) 
        @param {mixed} value
       **/         
       value2input: function(value) {
             if(!value) {
                 return;
             }
			 
			 $("#searchcustomersorter_sort").select2();
			 $('#searchcustomersorter_sort').select2("val",value.searchcustomersorter_key);
			 
			 $("#searchcustomersorter_sort").val(value.searchcustomersorter_key);
			 if ( value.searchcustomersorter_ascordesc =='desc') {
				 $("#searchcustomersorter_ascordesc2").attr("checked",true);
			 } else {
				 $("#searchcustomersorter_ascordesc1").attr("checked",true);
			 }
       },       

       /**
        Returns value of input.
        
        @method input2value() 
       **/          
       input2value: function() {
			$("#searchcustomersorter_key").val($("#searchcustomersorter_sort").val()) ;
			$("#searchcustomersorter_txt").val($("#searchcustomersorter_sort").find('option:selected').text());
			$("#searchcustomersorter_ascordesc").val($('input[name="searchcustomersorter_ascordesc"]:checked').val());	
		    return {
				 searchcustomersorter_key:   $("#searchcustomersorter_sort").val(),
				 searchcustomersorter_txt:   $("#searchcustomersorter_sort").find('option:selected').text(),
				 searchcustomersorter_ascordesc: $('input[name="searchcustomersorter_ascordesc"]:checked').val()
			};
       },    
	  
        /**
        Activates input: sets focus on the first field.
        
        @method activate() 
       **/        
       activate: function() {
          //  this.$input.filter('[name="city"]').focus();  $("#searchcustomersorter_option").val() +  
       },  
       
       /**
        Attaches handler to submit form in case of 'showbuttons=false' mode
        
        @method autosubmit() 
       **/       
       autosubmit: function() {
        /*   this.$input.keydown(function (e) {
                if (e.which === 13) {
                    $(this).closest('form').submit();
                }
           });  */
       }       
    });

    searchcustomersort.defaults = $.extend({}, $.fn.editabletypes.abstractinput.defaults, {
        tpl: '<div class="editable-searchcustomersort">  <select id="searchcustomersorter_sort" class="form-control " >   <option  value="name" >按姓名排序</option> <option  value="phone_number" >按电话排序</option> <option  value="address" >按地址排序</option> '+		
		     $("#searchcustomersorter_option").val() +  '<option value="customer_memo">按客户备注排序</option>'+  '<option value="date_registration">按客户注册时间排序</option>'+  '<option value="creat_time">按录入时间排序</option>	</select> </div>'+
             '<div class="editable-searchcustomersort radio-list"> &nbsp;&nbsp; &nbsp;  <label   class="radio-inline" > <input type="radio" name="searchcustomersorter_ascordesc" id="searchcustomersorter_ascordesc1" value="asc"  checked="checked"/> 升序 </label>'+
			 ' <label  class="radio-inline" > <input type="radio" name="searchcustomersorter_ascordesc" id="searchcustomersorter_ascordesc2" value="desc" /> 降序 </label></div>',
             
        inputclass: ''
    });

    $.fn.editabletypes.searchcustomersort = searchcustomersort;

}(window.jQuery));