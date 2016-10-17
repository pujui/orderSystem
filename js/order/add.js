$(document).ready(function(){

    function orderAddForm(){
    }
    
    orderAddForm.prototype.init = function(){
        $('.addItem').click($.proxy(this.add, this));
        $(document).on("click", ".delItem", $.proxy(this.delItem, this));
        $(document).on("click", ".addCount", $.proxy(this.calculate, this));
    }

    orderAddForm.prototype.delItem = function(e){
        $(e.target).parent().remove();
        this.calculatePrice();
    }

    orderAddForm.prototype.calculate = function(e){
        var parent = $(e.target).parent();
        var selfCount = parseInt(parent.find('input[name="itemCount[]"]').val());
        selfCount += parseInt($(e.target).val());
        if(selfCount > 0){
            parent.find('input[name="itemCount[]"]').val(selfCount);
        }else{
            //parent.remove();
        }
        this.calculatePrice();
    }

    orderAddForm.prototype.calculatePrice = function(){
        var totalPrice = 0;
        var itemTotalPrice = 0;
        $('input[name="itemCount[]"]').each(function(i, e){
            itemTotalPrice = parseInt($('input[name="itemPrice[]"]').eq(i).val() * $(this).val());
            totalPrice += itemTotalPrice;
            $(this).parent().find('input[name="itemTotal[]"]').val(itemTotalPrice);
        });
        $('#totalPrice').text(totalPrice);
    }

    orderAddForm.prototype.add = function(e){
        var item = '<span>';
        item += '<input type="text" class="inputItem" name="itemId[]" readonly="readonly" value="'
            +$(e.target).data('name')
            +' '
            +$(e.target).data('classname')
            +'" />&nbsp;';
        item += '<input type="text" name="itemPrice[]" class="inputItemPrice" readonly="readonly" value="'+$(e.target).data('price')+'" />';
        item += ' x <input type="text" name="itemCount[]" class="inputItemPrice" readonly="readonly" value="1" />';
        item += ' = <input type="text" name="itemTotal[]" class="inputItemPrice" readonly="readonly" value="'+$(e.target).data('price')+'" /><br/>';
        item += '<br/><input type="button" class="delItem" style="height:30px;" value="X" />';
        item += ' <input type="button" class="addCount" style="height:30px;" value="-5" />';
        item += ' <input type="button" class="addCount" style="height:30px;" value="-2" />';
        item += ' <input type="button" class="addCount" style="height:30px;" value="-1" />';
        item += ' <input type="button" class="addCount" style="height:30px;" value="+1" />';
        item += ' <input type="button" class="addCount" style="height:30px;" value="+2" />';
        item += ' <input type="button" class="addCount" style="height:30px;" value="+5" />';
        item += '<input type="hidden" name="itemId[]" value="'+$(e.target).data('nameid')+'" />';
        item += '<input type="hidden" name="itemName[]" value="'+$(e.target).data('name')+'" />';
        item += '<hr/></span>'
        $('#addItemBlock').append(item);
        this.calculatePrice();
    }
    
    new orderAddForm().init();
});