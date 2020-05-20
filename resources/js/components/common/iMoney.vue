<template>
    <input type="text" class="form-control"
        v-model="formatValue"
        @focus="isInputActive = true"
        @blur="isInputActive = false; formatMoneyBlur()"
        maxlength="5"
    >
</template>
<script>
export default {
    props:{
        value:{
            type: [Number, String],
            default: 1,
        }
    },
    data(){
        return{
            isInputActive: false
        }
        
    },
    created(){
    },
    computed:{
        formatValue:{
            set: function(modifiedValue){
                let newValue = modifiedValue.replace(/[^\d\.]/g, "");
                this.$emit('input', newValue)
            },
            get: function(){
                if (this.isInputActive){
                    return this.value;
                }else{
                    return formatDisplayMoney(this.value);
                }
            }
        }
    },
    methods:{
        formatDisplayMoney,
        formatMoneyBlur(){
            let emitValueMoneyChange = '';
            emitValueMoneyChange = this.checkValueMoney(this.value);
            this.$emit('change', emitValueMoneyChange)
        },
        checkValueMoney(value, min = 500, max = 50000){
            if (value <= min){
                return min;
            }else if (value >= max){
                return max;
            }else{
                return value;
            }
        }
    }
}
</script>