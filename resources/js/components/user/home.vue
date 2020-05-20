<template>
    <div class="container-fluid bg__img">
        <div class="form__box">
            <h1 class="row text__header">THỦ TỤC ĐƠN GIẢN</h1>
            <div class="row form__resgiter">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label class="col-sm-4">Tôi muốn vay</label>
                        <div class="col-sm-8 input-group">
                            <input-money
                                v-model="objData.d_money"
                                @change="change"
                            />
                            <div class="input-group-append">
                                <span class="input-group-text icon__append">.000 đ</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="range" class="custom-range" id="rangeMoney" 
                                v-model.number="objData.money" min="1" max="100" @change="changeMoney">
                            <small class="form-text text-muted float-left">500.000 đ</small>
                            <small class="form-text text-muted float-right">50.000.000 đ</small>
                        </div>   
                    </div> 

                    <div class="form-group row">
                        <label class="col-sm-5">Số tiền bằng chữ: </label>
                        <div class="col-sm-7">
                            <span>một triệu hai trăm năm mươi ngàn đồng</span>
                        </div>
                    </div>

                </div>

                <div class="col-sm-6">

                    <div class="form-group row">
                        <label for="phoneInput">Số điện thoại của bạn</label>
                        <input type="text" class="form-control" id="phoneInput" 
                            v-model="objData.phone" maxlength="14"
                            placeholder="(0xx) xxx xxxx" v-mask="'(###) ### ####'">
                        <small v-show="!objData.errors.phone" class="form-text text-muted">Nhập số điện thoại của bạn</small>
                        <small v-show="objData.errors.phone" class="form-text text-muted errors_validator">{{ objData.errors.phone }}</small>
                    </div>

                    <div class="form-group row">
                        <label for="nameInput">Họ và tên của bạn</label>
                        <input type="text" class="form-control" id="nameInput" placeholder="Nguyễn Văn A"
                            v-model="objData.name"
                        >
                        <small v-show="!objData.errors.name" class="form-text text-muted">Nhập họ và tên của bạn</small>
                        <small v-show="objData.errors.name" class="form-text text-muted errors_validator">{{ objData.errors.name }}</small>
                    </div>
                    
                    <div class="form-group row">
                        <label for="CMInput">Chứng minh nhân dân</label>
                        <input type="text" class="form-control" id="CMInput" placeholder="xxx xxx xxx" 
                            v-mask="'### ### ###'" maxlength="11" v-model="objData.indentityCard"
                        >
                        <small v-show="!objData.errors.indentityCard" class="form-text text-muted">Nhập số chứng minh nhân dân của bạn</small>
                        <small v-show="objData.errors.indentityCard" class="form-text text-muted errors_validator">{{ objData.errors.indentityCard }}</small>
                    </div>
                </div>

                <div class="col-sm-6 mx-auto">
                    <div class="text-center">
                        <button type="button" class="btn__resgiter" @click.prevent="clickResgiter">Đăng Ký Vay</button>
                    </div>
                    
                </div>

            </div>
        </div>
    </div>
</template>
<script>
import inputMoney from '../common/iMoney';
export default {
    components:{
        inputMoney
    },
    data(){
        return{
            objData:{
                money: 1,
                d_money: '',
                phone: '',
                name:'',
                indentityCard: '',
                errors:{
                    name:'',
                    phone:'',
                    indentityCard:'',
                }
            },
            minMoney: 500000,
            maxMoney: 50000000,
        }
    },
    created(){
        this.objData.d_money = this.objData.money * 500;
    },
    methods:{
        formatDisplayMoney,
        changeMoney(){
            this.objData.d_money = this.objData.money * 500;
        },
        clickResgiter(){
            let phone = this.objData.phone.replace(/[()\s]/g, '');
            let indentityCard = this.objData.indentityCard.replace(/\s/g,'');
            this.objData.errors.name = '';
            this.objData.errors.phone = '';
            this.objData.errors.indentityCard = '';
            console.log(indentityCard)
            axios.post('registerRequestMoney',{
                name: this.objData.name,
                phone: phone,
                indentityCard: indentityCard,
                money: this.objData.d_money,
            })
            .then(res =>{
                console.log(res)
                if (res.data.errors == true){
                    if (res.data.messages){
                        _.forEach(res.data.messages, (value, key)=>{
                            this.objData.errors[key] = value[0];
                        })
                    }
                }
            })
            .catch(err => {
                console.log(err)
            })
        },
        change(emitValueMoney){
            this.objData.money = parseInt(emitValueMoney/500);
            this.changeMoney();
        }
    }
}
</script>
<style scoped>
.form__box{
    width: 70%;
    margin: 0 auto;
    margin-top: 10px;  
}
.info__item{
    padding: 10px 10px;
}
.bg__img{
    display: block;
    background-image: url('/images/bg.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    position: relative;
    padding: 40px 15px;
    background-position: center;
}
.form__resgiter{
    border: 1px solid white;
    border-radius: 10px;
    background-color: white;
    padding: 20px;
}
.text__header{
    color: #F7F2E0;
    font-weight: bold;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 25px;
    line-height: 48px;
    margin-bottom: 17px;
    text-align: center;
}
.btn__resgiter{
    color: white;
    border-radius: 8px;
    text-align: center;
    height: 60px;
    width: 70%;
    position: absolute;
    bottom: -50px;
    left: 18%;
    font-size: 16.6px;
    font-family: Arial, Helvetica, sans-serif;
    background: linear-gradient(270deg, #AF325A 0%, #D22E57 20%, #E13D5C 40%, #EE4F62 60%, #F8646B 80%, #FF7D7B 100%);
}
label{
    font-family: Arial, Helvetica, sans-serif;
    font-weight: bold;
    color: #000000;
    
}
.icon__append{
    background-color: transparent;
}
input[type=text]{
    font-family: "Josefin Sans", sans-serif;
    font-size: 17px;
    border-radius: 6px;
    border: 2px solid #D5D4D8;
    display: block;
    color: #3C3B3E;
    font-weight: bold;
}
input[type=range] {
  height: 26px;
  -webkit-appearance: none;
  margin: 10px 0;
  width: 100%;
}
input[type=range]:focus {
  outline: none;
}
input[type=range]::-webkit-slider-runnable-track {
  width: 100%;
  height: 13px;
  cursor: pointer;
  box-shadow: 0px 0px 0px #000000;
  background: #AC51B5;
  border-radius: 25px;
  border: 0px solid #000101;
}
input[type=range]::-webkit-slider-thumb {
  box-shadow: 0px 0px 0px #000000;
  border: 0px solid #000000;
  height: 20px;
  width: 39px;
  border-radius: 7px;
  background: #65001C;
  cursor: pointer;
  -webkit-appearance: none;
  margin-top: -3.5px;
}
input[type=range]:focus::-webkit-slider-runnable-track {
  background: #AC51B5;
}
input[type=range]::-moz-range-track {
  width: 100%;
  height: 13px;
  cursor: pointer;
  box-shadow: 0px 0px 0px #000000;
  background: #AC51B5;
  border-radius: 25px;
  border: 0px solid #000101;
}
input[type=range]::-moz-range-thumb {
  box-shadow: 0px 0px 0px #000000;
  border: 0px solid #000000;
  height: 20px;
  width: 39px;
  border-radius: 7px;
  background: #65001C;
  cursor: pointer;
}
input[type=range]::-ms-track {
  width: 100%;
  height: 13px;
  cursor: pointer;
  background: transparent;
  border-color: transparent;
  color: transparent;
}
input[type=range]::-ms-fill-lower {
  background: #AC51B5;
  border: 0px solid #000101;
  border-radius: 50px;
  box-shadow: 0px 0px 0px #000000;
}
input[type=range]::-ms-fill-upper {
  background: #AC51B5;
  border: 0px solid #000101;
  border-radius: 50px;
  box-shadow: 0px 0px 0px #000000;
}
input[type=range]::-ms-thumb {
  margin-top: 1px;
  box-shadow: 0px 0px 0px #000000;
  border: 0px solid #000000;
  height: 20px;
  width: 39px;
  border-radius: 7px;
  background: #65001C;
  cursor: pointer;
}
input[type=range]:focus::-ms-fill-lower {
  background: #AC51B5;
}
input[type=range]:focus::-ms-fill-upper {
  background: #AC51B5;
}
.errors_validator{
    color: red!important;
    font-weight: bold;
}
</style>